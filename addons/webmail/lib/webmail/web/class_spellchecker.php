<?php
/**
* Project:     AfterLogic Ajax Spellchecker
* File:        Spell.spellchecker.class.php
*
* @link http://afterlogic.com
* @author  Penkin Vladimir aka wired_mugen
* @package AfterLogic Ajax Spellchecker
* @version 0.2.5
*/

include_once WM_ROOTPATH.'class_spelldictioary.php';


function GetStr($char, $len) {
	$str = '';
	for ($i=0; $i < $len; $i++) {
		$str = $str . $char;
	}
	return $str;
}


class Spellchecker {

	var $spDic;
	var $ignoreAllCapsWords;
	var $ignoreHtml;
	var $ignoreWordsWithDigits;
	var $ignoreList = Array();
	var $maxSuggestions;
	var $replaceList = Array();
	var $replacementWord = '';
	var $suggestions = Array();
	var $text;
	var $wordIndex;
	var $words;
	var $wordEx;
	var $_error = '';

/**
 * Class constructor
 * @param string $fileName
 */
function Spellchecker($dicFileName) {
	$this->ignoreAllCapsWords = false;
	$this->ignoreHtml = false;
	$this->ignoreWordsWithDigits = false;
	
	$this->spDic = new SpellcheckerDictionary($dicFileName);
	if ($this->spDic->_error !== '')
		$this->_error = $this->spDic->_error;
		
	$this->wordEx = '/[' . $this->spDic->tryCharacters . '\']+/u';
}

/**
 * Parse text.
 * @param 
 * @return array
 */
function ParseText() {
global $conv;
global $htmlRegexFull;

	$misspel = array();
	$marker = "|";
	$text = $this->text;	
	if (preg_match_all('/(<.*?\>)|(&nbsp;)/si', $this->text, $tags) != 0) {
		foreach ($tags[0] as $tag) {
			$text = str_replace($tag, GetStr($marker, strlen($tag)), $text);
		}
	}
	if (preg_match_all($this->wordEx, $text, $words, PREG_OFFSET_CAPTURE) != 0) {
		$lastWordPos = -1;
		for ($i=0; $i<count($words[0]); $i++) {
			$wordRec = $words[0][$i];
			$pos = $conv->strpos($text, $wordRec[0], $lastWordPos+1);
			$lastWordPos = $pos + $conv->strlen($wordRec[0]);
			if (!$this->TestWord($wordRec[0])) {
				$misspel[] = array($pos, $conv->StrLen($wordRec[0]));
			}
		}
	}
	return $misspel;
}


/**
 * Resets the public properties
 * @param
 */
function Reset() {
	$this->wordIndex = 0;
	$this->replacementWord = "";
	$this->suggestions = Array();
}

/**
 * swap out each char one by one and try all the tryme
 * chars in its place to see if that makes a good word
 * @param string $tempSuggestion
 */
function BadChar(&$tempSuggestion) {
global $conv;
	$tryme = $this->spDic->tryCharacters;

	$len = $conv->StrLen($this->currentWord);
	for ($i=0; $i <= ($len-1) ; $i++) {
		for ($x=0; $x < $conv->StrLen($tryme); $x++) {
		//	$tmpWord[$i] = $tryme[$x]; 		// do not supported for multibyte strings?
			
			if ($i != 0  && $i != $len && $x >= $conv->StrLen($tryme) / 2) continue; 	// Upper leters in the begining of word only
																						// TryCharacters must be simetric
			
			if ($i >= 1) {
				
				$tmWord = $conv->SubStr($this->currentWord, 0, $i) . $conv->SubStr($tryme, $x, 1) . $conv->SubStr($this->currentWord, $i+1);
			} else {
				$tmWord = $conv->SubStr($tryme, $x, 1) . $conv->SubStr($this->currentWord, $i+1);
			}
		
			if ($this->TestWord($tmWord)) {
				$tempSuggestion[] = $tmWord;
				if (count($tempSuggestion) >= MAX_SUGGEST_WORDS-1) break 2; 
			}	
			
		}
	}

}

/**
 * try omitting one char of word at a time
 * @param string $tempSuggestion
 */
function ExtraChar(&$tempSuggestion) {
global $conv;
	$length = $conv->StrLen($this->currentWord);
	if ($length > 1) {
		for ($i=0; $i < $length; $i++) {
			$tmpWord = substr_replace($this->currentWord, '', $i, 1);
			
			if ($this->TestWord($tmpWord)) {
				$tempSuggestion[] = $tmpWord;
				if (count($tempSuggestion) >= MAX_SUGGEST_WORDS-1) break; 
			}	
		}
	}
}

/**
 * try inserting a tryme character before every letter
 * @param string $tempSuggestion
 */
function ForgotChar(&$tempSuggestion) {
global $conv;
	$tryme = $this->spDic->tryCharacters;
	$len = $conv->StrLen($this->currentWord);
	for ($i=0; $i <= $len; $i++) {
		for($x=0; $x < $conv->StrLen($tryme); $x++) {
			$tmpWord = $this->currentWord;
			if ($i != 0  && $i != $len+1 && $x >= $conv->StrLen($tryme)/2) continue; 	
			// Insert an symbol
			if ($i >= 1) {
				$tmpWord = $conv->SubStr($tmpWord, 0, $i) . $conv->SubStr($tryme, $x, 1) . $conv->SubStr($tmpWord, $i);
			} else {
				$tmpWord = $conv->SubStr($tryme, $x, 1) . $conv->SubStr($tmpWord, $i);
			}
			if ($this->TestWord($tmpWord)) {
				$tempSuggestion[] = $tmpWord;
				if (count($tempSuggestion) >= MAX_SUGGEST_WORDS-1) break 2; 
			}
		}
	}
}

function ReplaceChars(&$tempSuggestion) {
global $conv, $words_count;
	$rep = $this->spDic->replaceCharacters;
	foreach ($rep as $repline) {
		$parts = explode(' ', $repline);
		$key = $parts[0];
		$replace = $parts[1];
		$pos = $conv->StrPos($this->currentWord, $key);
		while ($pos !== false) {
			$tmpWord = $conv->SubStr($this->currentWord, 0, $pos);
			$tmpWord.= $replace;
			$tmpWord.= $conv->SubStr($this->currentWord, $pos + $conv->StrLen($key));
			
			if ($this->TestWord($tmpWord)) {
				$tempSuggestion[] = $tmpWord;
				if (count($tempSuggestion) >= MAX_SUGGEST_WORDS-1) break 2; 
			}
			$pos = $conv->StrPos($this->currentWord, $key, $pos+1);
		}
	}
}

/**
 * try swapping adjacent chars one by one
 * @param string $tempSuggestion
 */
function SwapChar(&$tempSuggestion) {
global $conv;
	for($i=0; $i < ($conv->StrLen($this->currentWord) - 1); $i++) {
		$tmpWord = $this->currentWord;
		$chA = $conv->SubStr($tmpWord, $i, 1);
		$chB = $conv->SubStr($tmpWord, $i+1, 1);
		if ($i >= 1) {
			$tmpWord = $conv->SubStr($tmpWord, 0, $i) . $chB . $chA . $conv->SubStr($tmpWord, $i+2);
		} else {
			$tmpWord = $chB . $chA . $conv->SubStr($tmpWord, $i+2);
		}
		if ($this->TestWord($tmpWord)) {
				$tempSuggestion[] = $tmpWord;
				if (count($tempSuggestion) >= MAX_SUGGEST_WORDS-1) break; 
		}
	}
}

/**
 * split the string into two pieces after every char
 * @param string $tempSuggestion
 */
function TwoWords(&$tempSuggestion) {
global $conv;
	for($i=1; $i < $conv->StrLen($this->currentWord); $i++) {
		$firstWord = $conv->SubStr($this->currentWord, 0, $i);
		$secondWord = $conv->SubStr($this->currentWord, $i);
		$tmpWord = $firstWord . ' ' . $secondWord;
		
		if ($this->TestWord($firstWord) && $this->TestWord($secondWord)) {
			$tempSuggestion[] = $tmpWord;
			if (count($tempSuggestion) >= MAX_SUGGEST_WORDS-1) break; 
		}
	}
}

/**
 * Determines that dictionary contains word
 * @param string $word
 */
function TestWord($word) {
	return $this->spDic->Contains($word);
}

}