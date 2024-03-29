<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));

	include_once(WM_ROOTPATH.'common/class_datetime.php');
	include_once(WM_ROOTPATH.'common/class_i18nstring.php');
	
	define('USE_MBSTRING', false);
	define('USE_ICONV', true);
	define('USE_IMAP8BIT', true);
	
	define('GL_WITHIMG', 'imagesIsReplace');
	
	$mbserror = false;
	
	/**
	 * @static 
	 */
	class ConvertUtils
	{
		/**
		 * @param String $email
		 * @return Array
		 */
		function ParseEmail($email)
		{
			$arr = explode("@", $email);
		
			if(count($arr) == 2 && strlen($arr[0]) && strlen($arr[1]))
			{
				return $arr;
			}
			else 
			{
				return false;
			}
		}
		
		/**
		 * @param string $str
		 * @param string $from_encoding
		 * @param string $to_encoding
		 * @return string
		 */
		function ConvertEncoding($str, $from_encoding, $to_encoding)
		{
			// global $mbserror;
			// $from_encoding = ($from_encoding) ? $from_encoding : $GLOBALS[MailDefaultCharset];
			// $to_encoding = ($to_encoding) ? $to_encoding : $GLOBALS[MailOutputCharset];
			
			$from_encoding = ($from_encoding == 'default') ? $GLOBALS[MailDefaultCharset] : $from_encoding;
			$to_encoding = ($to_encoding == 'default') ? $GLOBALS[MailOutputCharset] : $to_encoding;
			
			$output =& $str;
			
			if (strtolower($from_encoding) == strtolower($to_encoding) || strlen($from_encoding) < 1)
			{
				return $output;
			}
			if (function_exists('mb_convert_encoding') && USE_MBSTRING)
			{
				return ConvertUtils::ClassMb_convert_encoding($from_encoding, $to_encoding, $str);
			}
			
			if (function_exists('iconv') && USE_ICONV)
			{
				return ConvertUtils::ClassIconv($from_encoding, $to_encoding, $str);
			}
			
			require_once(WM_ROOTPATH.'common/class_i18nstring.php');
			$i18Str = &new I18nString($str, $from_encoding);
			return $i18Str->GetText($to_encoding);
		}
		
		/**
		 * @param string $from_encoding
		 * @param string $to_encoding
		 * @param string $str
		 * @return string
		 */
		function ClassIconv($from_encoding, $to_encoding, $str)
		{
			$iconv_encodings_array = array('ascii',
				'iso-8859-1','iso-8859-2','iso-8859-3','iso-8859-4','iso-8859-5','iso-8859-6','iso-8859-7',
				'iso-8859-8','iso-8859-9','iso-8859-10','iso-8859-11','iso-8859-12','iso-8859-13','iso-8859-14',
				'iso-8859-15','iso-8859-16',
				'koi8-r', 'koi8-u', 'koi8-ru',
				'cp1250', 'cp1251', 'cp1252', 'cp1253', 'cp1254', 'cp1257', 'cp949', 'cp1133',
				'cp850', 'cp866', 'cp1255', 'cp1256', 'cp862', 'cp874', 'cp932', 'cp950', 'cp1258', 
				'windows-1250', 'windows-1251','windows-1252','windows-1253','windows-1254','windows-1255',
				'windows-1256', 'windows-1257', 'windows-1258',
				'macroman', 'maccentraleurope', 'maciceland', 'maccroatian', 'macromania', 'maccyrillic', 
				'macukraine', 'macgreek', 'macturkish', 'macintosh', 'machebrew', 'macarabic',
				'euc-jp', 'shift_jis', 'iso-2022-jp', 'iso-2022-jp-2', 'iso-2022-jp-1',
				'euc-cn', 'gb2312', 'hz', 'gbk', 'gb18030', 'euc-tw', 'big5', 'big5-hkscs', 
				'iso-2022-cn', 'iso-2022-cn-ext', 'euc-kr', 'iso-2022-kr', 'johab',
				'armscii-8', 'georgian-academy', 'georgian-ps', 'koi8-t',
				'tis-620', 'macthai', 'mulelao-1', 
				'viscii', 'tcvn', 'hp-roman8', 'nextstep',
				'utf-8', 'ucs-2', 'ucs-2be', 'ucs-2le', 'ucs-4', 'ucs-4be', 'ucs-4le',
				'utf-16', 'utf-16be', 'utf-16le', 'utf-32', 'utf-32be', 'utf-32le', 'utf-7', 
				'c99', 'java', 'ucs-2-internal', 'ucs-4-internal');
				
			if ($from_encoding != CPAGE_UTF7_Imap && ConvertUtils::IsLatin($str)) return $str;
				
			if ($from_encoding == CPAGE_UTF7_Imap || $to_encoding == CPAGE_UTF7_Imap)
			{
				$i18str = &new I18nString($str, $from_encoding);
				return $i18str->GetText($to_encoding);
			}
			
			if (in_array(strtolower($from_encoding), $iconv_encodings_array))
			{
				$result = @iconv($from_encoding, $to_encoding.'//IGNORE', $str);
				return ($result !== false) ? $result : $str;
			}

			return $str;
		}
		
		/**
		 * @param string $from_encoding
		 * @param string $to_encoding
		 * @param string $str
		 * @return string
		 */
		function ClassMb_convert_encoding($from_encoding, $to_encoding, $str)
		{
			global $mbserror;
			
			if ($from_encoding != CPAGE_UTF7_Imap && ConvertUtils::IsLatin($str)) return $str;
			$result = @mb_convert_encoding($str, $to_encoding, $from_encoding);
			if ($result === false) $mbserror = true;
			return ($result !== false) ? $result : $str;
		}
		
		/**
		 * Gets the string length
		 * @param string $str
		 * @param string $encoding
		 * @return int
		 */
		function StrLen($str, $encoding = null)
		{
			if (function_exists('mb_strlen') && USE_MBSTRING)
			{
				return ($encoding != null) ? mb_strlen($str, $encoding) : mb_strlen($str);
			}

			return strlen($str);
		}
		
		/**
		 * Finds position of first occurrence of a string
		 * @param string $haystack
		 * @param string $needle
		 * @param int $offset optional
		 * @param string $encoding optional
		 * @return int
		 */
		function StrPos($haystack, $needle, $offset = 0, $encoding = null)
		{
			if (function_exists('mb_strpos') && USE_MBSTRING)
			{
				return ($encoding != null)?mb_strpos($haystack, $needle, $offset, $encoding):
						mb_strpos($haystack, $needle, $offset);
			}

			return strpos($haystack, $needle, $offset);
		}
		
		/**
		 * Makes a string lowercase
		 * @param string $str
		 * @param string $encoding optional
		 * @return string
		 */
		function StrToLower($str, $encoding = null)
		{
			if (function_exists('mb_strtolower') && USE_MBSTRING)
			{
				return ($encoding != null)?mb_strtolower($str, $encoding):mb_strtolower($str);
			}

			return strtolower($str);
		}
  
		/**
		 * Makes a string uppercase
		 * @param string $str
		 * @param string $encoding optional
		 * @return string
		 */
		function StrToUpper($str, $encoding = null)
		{
			if (function_exists('mb_strtoupper') && USE_MBSTRING)
			{
				return (func_num_args > 1)?mb_strtoupper($str, $encoding):mb_strtoupper($str);
			}
			
			return strtoupper($str);
		}
		
		/**
		 * Gets the part of a string
		 * @param string $str
		 * @param int $start
		 * @param int $length optional
		 * @param string $encoding optional
		 * @return string
		 */
		function SubStr($str, $start, $length = null, $encoding = null)
		{
			if (function_exists('mb_substr') && USE_MBSTRING)
			{
				if ($encoding != null)
				{
					return mb_substr($str, $start, $length, $encoding);
				}
				elseif ($length != null)
				{
					return mb_substr($str, $start, $length);
				}
				
				return mb_substr($str, $start);
			}
			
			return ($length != null)?substr($str, $start, $length):substr($str, $start);
		}
		
		/**
		 * @param string $utf8str
		 * @param int $strlen
		 * @return array
		 */
		function utf8chunk_split($utf8str, $strlen)
		{
			$start = 0;
			$textlen = $strlen;
			$out = array();
			// $startlen = strlen($utf8str);
			while (true)
			{
				$Offset = 6;
				$Kod = @ord($utf8str{$start + $textlen}) >> $Offset;
				while ($Kod == 2)
				{
					$textlen--;
					$Kod = @ord($utf8str{$start + $textlen}) >> $Offset;
				}
				$temp = substr($utf8str,$start,$textlen);
				
				if ($temp == '') break;
				$out[] = $temp;
				$start += $textlen;
			}
			return $out;	
		}
		
		/**
		 * @param string $str
		 * @param int $strlen
		 * @return array
		 */
		function chunk_split($str, $strlen)
		{
			$str = chunk_split($str, $strlen);
			$temp = explode(CRLF, $str);
			if ($temp[count($temp)-1] == '') array_pop($temp);
			return $temp;
		}
		
		/**
		 * @param string $str
		 * @return string
		 */
		function QuotedPrintableEncode($str)
		{
			if (function_exists('imap_8bit') && USE_IMAP)
			{
				return imap_8bit($str);
			}
			
			$hex = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F'); 
			$lines = preg_split("/(?:\r\n|\r|\n)/", $str); 
			$output = ''; 
			
			while (list(, $line) = each($lines))
			{ 
				$linlen = strlen($line); 
				$newline = ''; 
				for($i = 0; $i < $linlen; $i++)
				{ 
					$c = substr($line, $i, 1); 
					$dec = ord($c); 
					if (($dec == 32) && ($i == ($linlen - 1)))
					{ // convert space at eol only 
						$c = '=20'; 
					} elseif ( ($dec == 61) || ($dec < 32 ) || ($dec > 126) )
					{ // always encode "\t", which is *not* required 
						$c = '='.$hex[floor($dec/16)].$hex[floor($dec%16)]; 
					} 
					$newline .= $c; 
				} // end of for 
				$output .= $newline.CRLF; 
			} 
			return trim($output); 

		}
		
		/**
		 * @param string $string
		 * @return string
		 */
		function quotedPrintableWithLinebreak($string, $dontBreake = false) 
		{
			$linelen = 0;
			$breaklen = 0;
			$encodecrlf = false;
			$hex = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F'); 
			$linebreak = ($dontBreake) ? '' : '='.CRLF;
			$len = strlen($string);
			$result = '';
			
			for($i = 0; $i < $len; $i++)
			{
				if ($linelen >= MIMEConst_LineLengthLimit)
				{ // break lines over 76 characters, and put special QP linebreak
					$linelen = $breaklen;
					$result.= $linebreak;
				}
				$c = ord($string{$i});
				if (($c==0x3d) || ($c>=0x80) || ($c<0x20)) 
				{ // in this case, we encode...
					if ((($c==0x0A) || ($c==0x0D)) && (!$encodecrlf))
					{ // but not for linebreaks
						$result.=chr($c);
						$linelen = 0;
						continue;
					}
					//$result.='='.str_pad(strtoupper(dechex($c)), 2, '0');
					$result .= '='.$hex[floor($c/16)].$hex[floor($c%16)]; 
					$linelen += 3;
					continue;
				}
				$result.=chr($c); // normal characters aren't encoded
				$linelen++;
			}
			
			return $result;
		}
		
		/**
		 * @param string $string
		 * @return string
		 */
		function base64WithLinebreak($string)
		{
			return chunk_split(base64_encode($string), MIMEConst_LineLengthLimit);
		}

		/**
		 * @param string $string
		 * @return string
		 */
		function UuEncode($string)
		{
			if (function_exists('convert_uuencode'))
			{
				return convert_uuencode($string);
			}
			
		    $u = 0;
		    $encoded = '';
		    
		    while ($c = count($bytes = unpack('c*', substr($string, $u, 45))))
		    {
		        $u += 45;
		        $encoded .= pack('c', $c + 0x20);
		
		        while ($c % 3)
		        {
		            $bytes[++$c] = 0;
		        }
		
		        foreach (array_chunk($bytes, 3) as $b)
		        {
		            $b0 = ($b[0] & 0xFC) >> 2;
		            $b1 = (($b[0] & 0x03) << 4) + (($b[1] & 0xF0) >> 4);
		            $b2 = (($b[1] & 0x0F) << 2) + (($b[2] & 0xC0) >> 6);
		            $b3 = $b[2] & 0x3F;
		            
		            $b0 = $b0 ? $b0 + 0x20 : 0x60;
		            $b1 = $b1 ? $b1 + 0x20 : 0x60;
		            $b2 = $b2 ? $b2 + 0x20 : 0x60;
		            $b3 = $b3 ? $b3 + 0x20 : 0x60;
		            
		            $encoded .= pack('c*', $b0, $b1, $b2, $b3);
		        }
		
		        $encoded .= CRLF;
		    }
		    
		    // Add termination characters
		    $encoded .= "\x60".CRLF;
		
		    return $encoded;
		}
		
		/**
		 * @param string $string
		 * @return string
		 */
		function UuDecode($string)
		{
			$string = trim($string);
			if (strtolower(substr($string, 0, 5)) == 'begin')
			{
				$string = substr($string, strpos($string, CRLF) + strlen(CRLF));
				$string = substr($string, 0, strlen($string)-3);
				$string = trim($string);
			}
			
			if (function_exists('convert_uudecode'))
			{
				return convert_uudecode($string);
			}
			
			if (strlen($string) < 8)
			{
				return ''; // The given parameter is not a valid uuencoded string
			}
	
			$decoded = '';
			foreach (explode("\n", $string) as $line)
			{
				$c = count($bytes = unpack('c*', substr(trim($line), 1)));
	
				while ($c % 4)
				{
					$bytes[++$c] = 0;
				}
	
				foreach (array_chunk($bytes, 4) as $b)
				 {
					$b0 = $b[0] == 0x60 ? 0 : $b[0] - 0x20;
					$b1 = $b[1] == 0x60 ? 0 : $b[1] - 0x20;
					$b2 = $b[2] == 0x60 ? 0 : $b[2] - 0x20;
					$b3 = $b[3] == 0x60 ? 0 : $b[3] - 0x20;
	                
					$b0 <<= 2;
					$b0 |= ($b1 >> 4) & 0x03;
					$b1 <<= 4;
					$b1 |= ($b2 >> 2) & 0x0F;
					$b2 <<= 6;
					$b2 |= $b3 & 0x3F;
	                
					$decoded .= pack('c*', $b0, $b1, $b2);
				}
			}
	
			return rtrim($decoded, "\0");
		}

		/**
		 * @param string $str
		 * @return string
		 */
		function DecodeHeaderString($str, $fromCharset, $toCharset, $withSpecialParameters = false)
		{
			$bool = false;
			
			$newStr = ($withSpecialParameters) ? ConvertUtils::WordExtensionsDecode($str) : $str;
			$bool = ($newStr != $str);
			
			$str = str_replace("\r", '', str_replace("\t", '', str_replace("\n", '', str_replace(CRLF, "\n", $newStr))));
			$str = str_replace('?= =?', '?==?', $str);
			$str = preg_replace('/\s+/',' ', $str);
			
			$encodeArray = ConvertUtils::SearchEncodedPlaces($str);
			
			$c = count($encodeArray);
			for ($i = 0; $i < $c; $i++)
			{
				$tempArr = ConvertUtils::DecodeString($encodeArray[$i], $fromCharset, $toCharset);
				$str = str_replace($encodeArray[$i], ConvertUtils::ConvertEncoding($tempArr[1], $tempArr[0], $toCharset), $str);
				$bool = true;
			}
			$str = preg_replace('/[;]([a-zA-Z])/', '; $1', $str);
			return ($bool) ? $str : ConvertUtils::ConvertEncoding($str, $fromCharset, $toCharset);
		}
		
		/**
		 * @param string $string
		 * @return array
		 */
		function SearchEncodedPlaces($string)
		{
			$match = array('');
			//preg_match_all('/=\?[^\?]+\?[Q|B]\?[^\?\n\r$]*(\?=|\n|\r|$)/i', $string, $match);
			preg_match_all('/=\?[^\?]+\?[Q|B]\?[^\?]*(\?=)/i', $string, $match);
			
			for ($i = 0, $c = count($match[0]); $i < $c; $i++)
			{
				$pos = @strpos($match[0][$i], '*');
				if ($pos !== false)
				{
					$match[0][$i][0] = substr($match[0][$i][0], 0, $pos);
				}
			}
			return $match[0];
		}

		/**
		 * @param string $str
		 * @return array // array[0] - charset, array[1] - string
		 */
		function DecodeString($str, $fromCharset, $toCharset)
		{
			$out = array('', $str);
			if (substr(trim($str), 0, 2) == '=?')
			{
				$pos = strpos($str, '?', 2);
				$out[0] = substr($str, 2, $pos - 2);
				$encType = strtoupper($str{$pos+1});
				switch ($encType)
				{
					case 'Q':
						$str = str_replace('_', ' ', $str);
						$out[1] = quoted_printable_decode(substr($str, $pos + 3, strlen($str)-$pos-5));
						break;
					case 'B':
						$out[1] = base64_decode(substr($str, $pos + 3, strlen($str)-$pos-5));
						break;
				}
			}
			
//			if (isset($GLOBALS[MailInputCharset]) && $GLOBALS[MailInputCharset] != '')
//			{
//				$out[0] = $GLOBALS[MailInputCharset];
//			}
			
			return $out;
		}
		
		/**
		 * @param string $str
		 * @return string
		 */
		function WordExtensionsDecode($str)
		{
			$match = array('');
			preg_match_all('/([\w]+\*[^=]{0,3})=([^;\t\n]+)[;]?/', $str, $match);
		
			if (count($match[0]) > 0)
			{
				$charArray = array();
				for ($i = 0, $c = count($match[0]); $i < $c; $i++)
				{
					$temp = array('n' => '', 's' => '');
					
					$temp['n'] = substr($match[1][$i], 0, strpos($match[1][$i], '*'));
				
					if ($match[1][$i]{strlen($match[1][$i])-1} == '*')
					{
						$fpos = strpos($match[2][$i], '\'');
						$spos = strpos($match[2][$i], '\'', $fpos+1);
					}
					else 
					{
						$fpos = false;
					}
					if ($fpos !== false)
					{
						$charset = substr($match[2][$i], 0, $fpos);
						$lang = substr($match[2][$i], $fpos+1, $spos-$fpos-1);
						if ($charset) $charArray[$temp['n']]['c'] = $charset;
						if ($lang) $charArray[$temp['n']]['l'] = $lang;
					
						if (isset($charArray[$temp['n']]['c']))
						{
							$temp['s'] = ConvertUtils::ConvertEncoding(urldecode(trim(substr($match[2][$i], $spos+1), '\'"')), $charArray[$temp['n']]['c'], $GLOBALS[MailOutputCharset]);
						}
						else
						{
							$temp['s'] = urldecode(trim(substr($match[2][$i], $spos+1), '\'"'));
						}
					}
					else 
					{
						if (isset($charArray[$temp['n']]['c']))
						{
							$temp['s'] = ConvertUtils::ConvertEncoding(urldecode(trim($match[2][$i],'\'"')), $charArray[$temp['n']]['c'], $GLOBALS[MailOutputCharset]);
						}
						else
						{
							$temp['s'] = urldecode(trim($match[2][$i],'\'"'));
						}						
						//$temp['s'] = urldecode(trim($match[2][$i],'\'"'));
					}
					$newArray[] = $temp;
				}
				
				for ($i = 0, $c = count($match[0]); $i < $c; $i++)
				{
					$str = str_replace($match[0][$i], '', $str);
				}
				
				$newMass = array();
				
				for ($i = 0, $c = count($newArray); $i < $c; $i++)
				{
					if (isset($newMass[$newArray[$i]['n']]))
					{
						$newMass[$newArray[$i]['n']] .= $newArray[$i]['s'];
					}
					else 
					{
						$newMass[$newArray[$i]['n']] = $newArray[$i]['s'];
					}
				}
		
				if (count($newMass) > 0) $str = trim(trim($str), ';');
				foreach ($newMass as $k => $v)
				{
					$str .= '; '.$k.'="'.$v.'"';
				}
				return trim($str);
			}
			else 
			{
				return $str;
			}
		}
		
		/**
		 * @param string $str
		 * @param string $toCharset
		 * @return array
		 */
		function EncodeString($str, $toCharset)
		{
			$outarray = array();
			// $factor = (MIMEConst_DefaultQB == 'Q') ? 0.35 : 0.7;
			
			$outarray = (strtolower($toCharset) == 'utf-8') ? 
					//ConvertUtils::utf8chunk_split($str, floor(MIMEConst_LineLengthLimit * $factor - strlen($toCharset - 7))) :
					ConvertUtils::SmartChunk($str, MIMEConst_DefaultQB, $toCharset, true) :
					ConvertUtils::SmartChunk($str, MIMEConst_DefaultQB, $toCharset, false);
					
			if (!ConvertUtils::IsLatin($str))
			{
				for ($i = 0, $c = count($outarray); $i < $c; $i++)
				{
					if (MIMEConst_DefaultQB == 'Q')
					{
						$outarray[$i] = '=?'.strtolower($toCharset).'?Q?'.str_replace('?', '=3F', str_replace(' ','_', str_replace('_', '=5F', ConvertUtils::quotedPrintableWithLinebreak($outarray[$i], true)))).'?=';
					}
					elseif (MIMEConst_DefaultQB == 'B')
					{
						$outarray[$i] = '=?'.strtolower($toCharset).'?B?'.base64_encode($outarray[$i]).'?=';
					}
				}
			}
			return $outarray;
		}
		
		/**
		 * @param string $str
		 * @param string $transferEncoding
		 * @param string $toCharset
		 * @param unknown_type $isUtf8
		 * @return array
		 */
		function SmartChunk($str, $transferEncoding, $toCharset, $isUtf8 = false)
		{
			$outArray = array();
			if ($isUtf8)
			{
				$count = 5;
				$newstr = '';
				for ($i = 0, $c = strlen($str); $i < $c; $i++)
				{
					$ch = ord($str{$i});
					$count += (($ch >= 0x80) || ($ch < 0x20)) ? ($transferEncoding == MIMEConst_Base64Short) ? 2 : 3 : 1;
					$newstr .= $str{$i};
				
					if ($count >= MIMEConst_LineLengthLimit - strlen($toCharset) - 7)
					{
						$outArray[] = $newstr;
						$count = 0;
						$newstr = '';
					}
				}
				
				if ($newstr) $outArray[] = $newstr;
			}
			else 
			{
				$count = 5;
				$newstr = '';
				for ($i = 0, $c = strlen($str); $i < $c; $i++)
				{
					$ch = ord($str{$i});
					$count += (($ch >= 0x80) || ($ch < 0x20)) ? ($transferEncoding == MIMEConst_Base64Short) ? 2 : 3 : 1;
					$newstr .= $str{$i};
				
					if ($count >= MIMEConst_LineLengthLimit - strlen($toCharset) - 7)
					{
						$outArray[] = $newstr;
						$count = 0;
						$newstr = '';
					}
				}
				
				if ($newstr) $outArray[] = $newstr;
			}
			return $outArray;
		}
		
		/**
		 * @param string $str
		 * @param string $fromCharset
		 * @param string $toCharset
		 * @param bool $changeCharset
		 * @return string
		 */
		function EncodeHeaderString($str, $fromCharset, $toCharset, $changeCharset = true)
		{
			$out = '';
			if ($changeCharset) $str = ConvertUtils::ConvertEncoding($str, $fromCharset, $toCharset);
			$array = ConvertUtils::EncodeString($str, $toCharset);
			for ($i = 0, $c = count($array); $i < $c; $i++)
			{
				$out .= ($c > 1) ? $array[$i].CRLF.' ' : $array[$i];
			}
			return trim($out);
		}
		
		/**
		 * @param string $value
		 * @return bool
		 */
		function IsLatin($value)
		{
			for($i = 0,  $c = strlen($value); $i < $c; $i++)
			{
				$ch = $value{$i};
				$ord = ord($ch);
				if (($ord >= 0x80) || ($ord < 0x20)) 
				{
					if ($ord != 13 && $ord != 10 && $ord != 9) 
					{
						return false;
					}
				}
			}
			return true;
		}
		
		/**
		 * @param int $codePageNum
		 * @return string
		 */
		function GetCodePageName($codePageNum)
		{
			static $mapping = array(
						0 => 'default',
						51936 => 'euc-cn',
						936 => 'gb2312',
						950 => 'big5',
						946 => 'euc-kr',
						50225 => 'iso-2022-kr',
						50220 => 'iso-2022-jp',
						932 => 'shift-jis',
						65000 => 'utf-7',
						65001 => 'utf-8',
						1250 => 'windows-1250',
						1251 => 'windows-1251',
						1252 => 'windows-1252',
						1253 => 'windows-1253',
						1254 => 'windows-1254',
						1255 => 'windows-1255',
						1256 => 'windows-1256',
						1257 => 'windows-1257',
						1258 => 'windows-1258',
						20866 => 'koi8-r',
						28591 => 'iso-8859-1',
						28592 => 'iso-8859-2',
						28593 => 'iso-8859-3',
						28594 => 'iso-8859-4',
						28595 => 'iso-8859-5',
						28596 => 'iso-8859-6',
						28597 => 'iso-8859-7',
						28598 => 'iso-8859-8');

			if (key_exists($codePageNum, $mapping))
			{
				return $mapping[$codePageNum];
			}
			return '';
		}
		
		/**
		 * @param string $codePageName
		 * @return int
		 */
		function GetCodePageNumber($codePageName)
		{
			static $mapping = array(
						'default' => 0,
						'euc-cn' => 51936,
						'gb2312' => 936,
						'big5' => 950,
						'euc-kr' => 949,
						'iso-2022-kr' => 50225,
						'iso-2022-jp' => 50220,
						'shift-jis' => 932,
						'utf-7' => 65000,
						'utf-8' => 65001,
						'windows-1250' => 1250,
						'windows-1251' => 1251,
						'windows-1252' => 1252,
						'windows-1253' => 1253,
						'windows-1254' => 1254,
						'windows-1255' => 1255,
						'windows-1256' => 1256,
						'windows-1257' => 1257,
						'windows-1258' => 1258,
						'koi8-r' => 20866,
						'iso-8859-1' => 28591,
						'iso-8859-2' => 28592,
						'iso-8859-3' => 28593,
						'iso-8859-4' => 28594,
						'iso-8859-5' => 28595,
						'iso-8859-6' => 28596,
						'iso-8859-7' => 28597,
						'iso-8859-8' => 28598);
    
			if (key_exists($codePageName, $mapping))
			{
				return $mapping[$codePageName];
			}
			return 0;
		}
		
		/**
		 * @param string $filename
		 * @return string
		 */
		function GetContentTypeFromFileName($filename)
		{
			$filename = strtolower($filename);
			$pos = strrpos($filename,'.');
			$ex = @substr($filename, $pos+1, strlen($filename)-$pos+1);
			switch ($ex)
			{
				case 'zip':
					return 'application/x-zip-compressed';
					
				case 'jfif':
				case 'jpe':
				case 'jpeg':
				case 'jpg':
					return 'image/jpeg';
					
				case 'aif':
				case 'aifc':
				case 'aiff':
					return 'audio/aiff';

				case 'asp':
					return 'text/asp';
				
				case 'avi':
					return 'video/avi';
				
				case 'mpg':
				case 'mpeg':
					return "video/mpeg";
				
				case 'wmv':
					return 'video/windows-media';
				
				case 'bmp':
					return 'image/bmp';
				
				case "css":
					return 'text/css';
				
				case 'doc':
					return 'application/msword';
				
				case 'exe':
				case 'dll':
				case 'scr':
					return 'application/x-msdownload';
				
				case 'hlp':
					return 'application/windows-help';
					
				case 'htm':
				case 'html':
					return 'text/html';
				
				case 'gif':
					return 'image/gif';
				
				case 'gz':
				case 'tgz':
					return 'application/x-gzip';
					
				case 'p7s':	
					return 'application/pkcs7-signature';
				
				case 'mov':
					return 'video/quicktime';
				
				case 'pdf':
					return 'application/pdf';
				
				case 'php':
				case 'php3':
				case 'php4':
				case 'php5':
				case 'phtml':
					return "application/x-httpd-php";
				
				case 'pl':
					return 'text/perl';
				
				case 'png':
					return 'image/x-png';
				
				case 'psd':
					return "image/psd";
				
				case 'tiff':
				case 'tif':
					return "image/tiff";
				
				case 'ttf':
					return 'application/x-ttf';
				
				case 'txt':
				case 'ini':
				case 'log':
				case 'sql':
				case 'cfg':
				case 'conf':
					return 'text/plain';
				
				case 'swf':
					return 'application/x-shockwave-flash';
				
				case 'wav':
					return 'audio/x-wav';
				
				case 'wma':
					return 'audio/x-ms-wma';
				
				case 'mp3':
					return 'audio/x-mp3';
				
				case 'xml':
					return 'text/xml';
			}
			return 'application/octet-stream';
		}
		
		/**
		 * @param string $str
		 * @return string
		 */
		function WMHtmlSpecialChars($str)
		{
			return str_replace('>', '&gt;', str_replace('<', '&lt;', str_replace('&', '&amp;', $str)));
		}

		/**
		 * @param string $str
		 * @return string
		 */
		function WMBackHtmlSpecialChars($str)
		{
			return str_replace('&amp;', '&', str_replace('&lt;', '<', str_replace('&gt;', '>', $str)));
		}
		
		/**
		 * @param string $str
		 * @return string
		 */
		function WMHtmlNewCode($str)
		{
			return str_replace(']]>','&#93;&#93;&gt;', $str);
		}
		
		/**
		 * @param string $str
		 * @return string
		 */
		function WMBackHtmlNewCode($str)
		{
			return str_replace('&#93;&#93;&gt;', ']]>', $str);
		}
		
		/**
		 * @param string $str
		 * @param bool $isQuote
		 * @return string
		 */
		function AttributeQuote($str, $isQuote = true)
		{
			return ($isQuote) ? str_replace('"', '&quot;', $str) : str_replace('\'', '&#039;', $str);
		}

		/**
		 * @param string $str
		 * @return string
		 */
		function ClearUtf8($str) 
		{
			if (function_exists('iconv') && !ConvertUtils::isAscii($str))
			{
				$str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
			}
			return ConvertUtils::mainClear($str);  
		}
		
		/**
		 * @param string $str
		 * @return string
		 */
		function mainClear($str)
		{
			return preg_replace('/[\x0-\x8\xB-\xC\xE-\x1F]+/', '', $str);
		}
		
		/**
		 * @param string $str
		 * @return string
		 */
		function isAscii($str)
		{
			return !preg_match('/[^\x00-\x7F]/S', $str);
		}
		
		/**
		 * @param string $password
		 * @param Account $account
		 * @return string
		 */
		function EncodePassword($password, &$account)
		{
			if ($password == '')
			{
				return $password;
			}
			
			$plainBytes = ConvertUtils::ConvertEncoding($password, $account->GetUserCharset(), CPAGE_UTF8);
			$encodeByte = $plainBytes{0};
			$result = bin2hex($encodeByte);
			
            for ($i = 1, $icount = strlen($plainBytes); $i < $icount; $i++)
            {
                $plainBytes{$i} = ($plainBytes{$i} ^ $encodeByte);
                $result .= bin2hex($plainBytes{$i});
            }
            
            return $result;
		}
		
		/**
		 * @param string $password
		 * @param Account $account
		 * @return string
		 */
		function DecodePassword($password, &$account)
		{
			$result = '';
			$passwordLen = strlen($password);
		
			if (strlen($password) > 0 && strlen($password) % 2 == 0)
			{
				$decodeByte = chr(hexdec(substr($password, 0, 2)));
				$plainBytes = $decodeByte;
				$startIndex = 2;
				$currentByte = 1;
	
				do
				{
					$hexByte = substr($password, $startIndex, 2);
					$plainBytes .= (chr(hexdec($hexByte)) ^ $decodeByte);
					
					$startIndex += 2;
					$currentByte++;
				}
				while ($startIndex < $passwordLen);

				//$result = $plainBytes;
				$result = ConvertUtils::ConvertEncoding($plainBytes, CPAGE_UTF8, $account->GetUserCharset());

			}
			return $result;
		}
		
		/**
		 * @param int $hour
		 * @param int $minute
		 * @param int $second
		 * @param int $month
		 * @param int $day
		 * @param int $year
		 * @return int
		 */
		function GmtMkTime($hour = -1, $minute = -1, $second = -1, $month = -1, $day = -1, $year = -1)
		{
			if ($hour == -1)
			{
				$hour = date('H');
			}
			
			if ($minute == -1)
			{
				$minute = date('i');
			}

			if ($second == -1)
			{
				$second = date('s');
			}
			
			if ($month == -1)
			{
				$month = date('n');
			}

			if ($day == -1)
			{
				$day = date('j');
			}

			if ($year == -1)
			{
				$year = date('Y');
			}
			
			$dt = mktime($hour, $minute, $second, $month, $day, $year);
			
			//$deltah = (gmdate('H') - date('H'))*60*60;
			//$deltam = (gmdate('i') - date('i'))*60;
			
			//$dt -= $deltah;
			//$dt -= $deltam;
			
			return $dt;
		}
		
		/**
		 * @param string $strDate
		 * @return int
		 */
		function GetTimeFromString($strDate)
		{
			$dt = time();
			$matches = array();
			
			$datePattern = '/^(([a-z]*),[\s]*){0,1}(\d{1,2}).([a-z]*).(\d{2,4})[\s]*(\d{1,2}).(\d{1,2}).(\d{1,2})([\s]+([+-]?\d{1,4}))?([\s]*(\(?(\w+)\)?))?/i';
			
			if (preg_match($datePattern, $strDate, $matches))
			{
				$year = $matches[5];
				$month = ConvertUtils::GetMonthIndex(strtolower($matches[4]));
				if ($month == -1) $month = 1;
				$day = $matches[3];
				$hour = $matches[6];
				$minute = $matches[7];
				$second = $matches[8];
				
				$dt = ConvertUtils::GmtMkTime($hour, $minute, $second, $month, $day, $year);
				
				$zone = null;
				if (isset($matches[13]))
				{
					$zone = strtolower($matches[13]);
				}
				
				$off = null;
				if (isset($matches[10]))
				{
					$off = strtolower($matches[10]);
				}
					
				$dt = ConvertUtils::ApplyOffsetForDate($dt, $off, $zone);
			}
			
			return $dt;
		}
		
		/**
		 * @param string $month
		 * @return short
		 */
		function GetMonthIndex($month)
		{
			if ($month == 'jan')
			{
				return 1;
			} 
			elseif ($month == 'feb') 
			{
				return 2;
			} 
			elseif ($month == 'mar') 
			{
				return 3;
			} 
			elseif ($month == 'apr') 
			{
				return 4;
			} 
			elseif ($month == 'may')
			{
				return 5;
			} 
			elseif ($month == 'jun')
			{
				return 6;
			}
			elseif ($month == 'jul')
			{
				return 7;
			} 
			elseif ($month == 'aug')
			{
				return 8;
			}
			elseif ($month == 'sep') 
			{
				return 9;
			}
			elseif ($month == 'oct')
			{
				return 10;
			}
			elseif ($month == 'nov')
			{
				return 11;
			} 
			elseif ($month == 'dec')
			{
				return 12;
			} 
			else 
			{
				return -1;
			}
		}
		
		/**
		 * @param int $dt
		 * @param int $offset
		 * @param string $zone
		 * @return int
		 */
		function ApplyOffsetForDate($dt, $offset, $zone)
		{
			$result = $dt;
			
			if (($offset != null) && (strlen($offset) != 0))
			{
				$offset = trim($offset);
				$sign = $offset{0};
				$offset = substr($offset, 1);
				
				$nOffset = 0;
				
				if (is_numeric($offset))
				{
					$nOffset = (int) $offset;
				}
				
				$hours = $nOffset / 100;
				$minutes = $nOffset % 100;
				$multiplier = 1;
				if($sign == '-')
				{
					$multiplier = -1;
				}
				
				$result -= $multiplier*$hours*60*60;
				$result -= $multiplier*$minutes*60;
			}
			elseif (($zone != null) && (strlen($zone) != 0))
			{
				$zone = trim($zone, ' ()');
				
				switch($zone)
				{
					case 'ut':
					case 'gmt':
					case 'z':
					{
						break;
					}
					case 'est':
					case 'cdt':
					{
						$dt -= 5*60*60;
						break;
					}
					case 'edt':
					{
						$dt -= 4*60*60;
						break;
					}
					case 'cst':
					case 'mdt':
					{
						$dt -= 6*60*60;
						break;
					}
					case 'mst':
					case 'pdt':
					{
						$dt -= 7*60*60;
						break;
					}
					case 'pst':
					{
						$dt -= 8*60*60;
						break;
					}
				}
			}
			
			return $result;
		}
		
		/**
		 * @param string $string
		 * @return string
		 */
		function ReplaceJSMethod($string)
		{
			/*
			$ToReplaceArray = array (
				"'onActivate'si",
				"'onAfterPrint'si",
				"'onBeforePrint'si",
				"'onAfterUpdate'si",
				"'onBeforeUpdate'si",
				"'onErrorUpdate'si",
				"'onAbort'si",
				"'onBeforeDeactivate'si",
				"'onDeactivate'si",
				"'onBeforeCopy'si",
				"'onBeforeCut'si",
				"'onBeforeEditFocus'si",
				"'onBeforePaste'si",
				"'onBeforeUnload'si",
				"'onBlur'si",
				"'onBounce'si",
				"'onChange'si",
				"'onClick'si",
				"'onControlSelect'si",
				"'onCopy'si",
				"'onCut'si",
				"'onDblClick'si",
				"'onDrag'si",
				"'onDragEnter'si",
				"'onDragLeave'si",
				"'onDragOver'si",
				"'onDragStart'si",
				"'onDrop'si",
				"'onFilterChange'si",
				"'onDragDrop'si",
				"'onError'si",
				"'onFilterChange'si",
				"'onFinish'si",
				"'onFocus'si",
				"'onHelp'si",
				"'onKeyDown'si",
				"'onKeyPress'si",
				"'onKeyUp'si",
				"'onLoad'si",
				"'onLoseCapture'si",
				"'onMouseDown'si",
				"'onMouseEnter'si",
				"'onMouseLeave'si",
				"'onMouseMove'si",
				"'onMouseOut'si",
				"'onMouseOver'si",
				"'onMouseUp'si",
				"'onMove'si",
				"'onPaste'si",
				"'onPropertyChange'si",
				"'onReadyStateChange'si",
				"'onReset'si",
				"'onResize'si",
				"'onResizeEnd'si",
				"'onResizeStart'si",
				"'onScroll'si",
				"'onSelectStart'si",
				"'onSelect'si",
				"'onSelectionChange'si",
				"'onStart'si",
				"'onStop'si",
				"'onSubmit'si",
				"'onUnload'si");
			*/
			$ToReplaceArray = array (
				"'onBlur'si",
				"'onChange'si",
				"'onClick'si",
				"'onDblClick'si",
				"'onError'si",
				"'onFocus'si",
				"'onKeyDown'si",
				"'onKeyPress'si",
				"'onKeyUp'si",
				"'onLoad'si",
				"'onMouseDown'si",
				"'onMouseEnter'si",
				"'onMouseLeave'si",
				"'onMouseMove'si",
				"'onMouseOut'si",
				"'onMouseOver'si",
				"'onMouseUp'si",
				"'onMove'si",
				"'onResize'si",
				"'onResizeEnd'si",
				"'onResizeStart'si",
				"'onScroll'si",
				"'onSelect'si",
				"'onSubmit'si",
				"'onUnload'si");
		
				return preg_replace($ToReplaceArray, "X_\$0", $string);
		
		}
		
		/**
		 * @param string $strFileName
		 * @return string
		 */
		function ClearFileName($strFileName)
		{
			return str_replace(array('"', '/', '\\', '*','?', '<', '>', '|', ':', "\r", "\n", "\t"), '', $strFileName);
		}
		
		/**
		 * @param string $strFileName
		 * @return bool
		 */
		function CheckFileName($strFileName)
		{
			if (strpos($strFileName, '"') !== false)
			{
				return false;
			}
			elseif (strpos($strFileName, '/') !== false)
			{
				return false;
			}
			elseif (strpos($strFileName, '\\') !== false)
			{
				return false;	
			}
			elseif (strpos($strFileName, '*') !== false)
			{
				return false;	
			}
			elseif (strpos($strFileName, '?') !== false)
			{
				return false;		
			}
			elseif (strpos($strFileName, '<') !== false)
			{
				return false;		
			}
			elseif (strpos($strFileName, '>') !== false)
			{
				return false;	
			}
			elseif (strpos($strFileName, '|') !== false)
			{
				return false;	
			}
			elseif (strpos($strFileName, ':') !== false)
			{
				return false;	
			}			
			return true;
		}
		
		/**
		 * @param string $strFileName
		 * @return bool
		 */
		function CheckDefaultWordsFileName($strFileName)
		{
			$words = array('CON', 'AUX', 'COM1', 'COM2', 'COM3', 'COM4', 'LPT1', 'LPT2', 'LPT3', 'PRN', 'NUL');
			foreach ($words as $value)
			{
				if (strtoupper($strFileName) == $value)
				{
					return false;
				}
			}
			return true;
		}
	
		/**
		 * @param string $strHtmlContent
		 * @return string
		 */
		function HtmlBodyWithoutImages($strHtmlContent)
		{
			$strHtmlContent = preg_replace_callback('/<[^>]+(src)/i', 'matches1Replace', $strHtmlContent);
			$strHtmlContent = preg_replace_callback('/<[^>]+(background[ ]?[=:])/i', 'matches2Replace', $strHtmlContent);
			$strHtmlContent = preg_replace_callback('/<[^>]+(background-image)/i', 'matches2Replace', $strHtmlContent);
			return $strHtmlContent;
		}
		
		/**
		 * @param string $strHtmlContent
		 * @return string
		 */
		function BackImagesToHtmlBody($strHtmlContent)
		{
			return str_replace(array('wmx_src', 'wmx_background'), array('src', 'background'), $strHtmlContent);
		}
		
		/**
		 * @param string $strPass
		 * @return string
		 */
		function WmServerCrypt($strPassword)
		{
			$out = '';
			for ($i = 0, $c = strlen($strPassword); $i < $c; $i++)
			{
				$out .= sprintf("%02x", (ord($strPassword{$i}) ^ 101) & 0xff);
			}
			return $out;
		}
		
		/**
		 * @param string $strPass
		 * @return string
		 */
		function WmServerDeCrypt($strPassword)
		{
			$return = '';
			$len = strlen($strPassword);
			
			if ($len > 0 && $len % 2 == 0)
			{
				$startIndex = 0;
				while($startIndex < $len)
				{
					$temp = (int) hexdec(substr($strPassword, $startIndex, 2));
					$return .= chr(($temp & 0xFF) ^ 101);
					$startIndex += 2;
				}
			}
			
			return $return;
		}

		/**
		 * @param string $jsString
		 * @return string
		 */
		function ClearJavaScriptString($jsString, $deq = null)
		{
			$jsString = str_replace('\\', '\\\\', $jsString);
			if ($deq !== null && strlen($deq) == 1)
			{
				$jsString = str_replace($deq, '\\'.$deq, $jsString);
			}
			return str_replace(array("\r", "\n"), ' ', trim($jsString));
		}
		
		/**
		 * @param string $jsString
		 * @return string
		 */
		function ReBuildStringToJavaScript($jsString, $deq = null)
		{
			$jsString = str_replace('\\', '\\\\', $jsString);
			if ($deq !== null && strlen($deq) == 1)
			{
				$jsString = str_replace($deq, '\\'.$deq, $jsString);
			}
			return str_replace(array("\r", "\n", "\t"), array('\r', '\n', '\t'), trim($jsString));
		}
		
		/**
		 * @param string $str
		 * @return string
		 */
		function Utf7to8($str)
		{
			$array = array(-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,62, 63,-1,-1,-1,52,53,54,55,56,57,58,59,60,61,-1,-1,-1,-1,-1,-1,-1,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,-1,-1,-1,-1,-1,-1,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,-1,-1,-1,-1,-1);
		
			$result = '';
			$error = '';
			$strlen = strlen($str);
		
			for ($i = 0; $strlen > 0; $i++, $strlen--)
			{
				$char = $str{$i};
				if ($char == '&')
				{
					$i++;
					$strlen--;
					
					$char = isset($str{$i}) ? $str{$i} : null;
					if ($char === null) break;
					
					if ($strlen && $char == '-')
					{
						$result .= '&';
						continue;
					}
					
					$ch = 0;
					$k = 10;
					for (; $strlen > 0; $i++, $strlen--)
					{
						$char = $str{$i};
						
						if ((ord($char) & 0x80) || ($b = $array[ord($char)]) == -1) break;
						
						if ($k > 0)
						{
							$ch |= $b << $k;
							$k -= 6;
						}
						else
						{
							$ch |= $b >> (-$k);
							if ($ch < 0x80)
							{
								if (0x20 <= $ch && $ch < 0x7f)
								return $error;
								$result .= chr($ch);
							}
							else if ($ch < 0x800)
							{
								$result .= chr(0xc0 | ($ch >> 6));
								$result .= chr(0x80 | ($ch & 0x3f));
							}
							else
							{
								$result .= chr(0xe0 | ($ch >> 12));
								$result .= chr(0x80 | (($ch >> 6) & 0x3f));
								$result .= chr(0x80 | ($ch & 0x3f));
							}
							
							$ch = ($b << (16 + $k)) & 0xffff;
							$k += 10;
						}
					}
					
					if ($ch || $k < 6) return $error;
					if (!$strlen || $char != '-') return $error;
					if ($strlen > 2 && $str{$i+1} == '&' && $str{$i+2} != '-') return $error;
				}
				else if (ord($char) < 0x20 || ord($char) >= 0x7f)
				{
					return $error;
				}
				else
				{
					$result .= $char;
				}
			}
			
			return $result;
		}

		/**
		 * @param string $str
		 * @return string
		 */
		function Utf8to7($str)
		{
			$array = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9','+',',');
		
			$strlen = strlen($str);
			$isB = false;
			$i = 0;
			$return = '';
			$error = '';
			
			while ($strlen)
			{
				$c = ord($str{$i});
				if ($c < 0x80)
				{
					$ch = $c;
					$n = 0;
				}
				else if ($c < 0xc2)
				{
					return $error;
				}
				else if ($c < 0xe0)
				{
					$ch = $c & 0x1f;
					$n = 1;
				}
				else if ($c < 0xf0)
				{
					$ch = $c & 0x0f;
					$n = 2;
				}
				else if ($c < 0xf8)
				{
					$ch = $c & 0x07;
					$n = 3;
				}
				else if ($c < 0xfc)
				{
					$ch = $c & 0x03;
					$n = 4;
				}
				else if ($c < 0xfe)
				{
					$ch = $c & 0x01;
					$n = 5;
				}
				else
				{
					return $error;
				}
				
				$i++;
				$strlen--;
				
				if ($n > $strlen)
				{
					return $error;
				}
				
				for ($j=0; $j < $n; $j++)
				{
					$o = ord($str{$i+$j});
					if (($o & 0xc0) != 0x80)
					{
						return $error;
					}
					$ch = ($ch << 6) | ($o & 0x3f);
				}
				
				if ($n > 1 && !($ch >> ($n * 5 + 1)))
				{
					return $error;
				}
				
				$i += $n;
				$strlen -= $n;
				
				if ($ch < 0x20 || $ch >= 0x7f)
				{
					if (!$isB)
					{
						$return .= '&';
						$isB = true;
						$b = 0;
						$k = 10;
					}
					
					if ($ch & ~0xffff)
					{
						$ch = 0xfffe;
					}
					
					$return .= $array[($b | $ch >> $k)];
					$k -= 6;
					for (; $k >= 0; $k -= 6)
					{
						$return .= $array[(($ch >> $k) & 0x3f)];
					}
					
					$b = ($ch << (-$k)) & 0x3f;
					$k += 16;
				}
				else
				{
					if ($isB)
					{
						if ($k > 10)
						{
							$return .= $array[$b];
						}
						$return .= '-';
						$isB = false;
					}
					
					$return .= chr($ch);
					if (chr($ch) == '&')
					{
						$return .= '-';
					}
				}
			}
			
			if ($isB)
			{
				if ($k > 10)
				{
					$return .= $array[$b];
				}
				$return .= '-';
			}
			
			return $return;
		}	

	}

	/**
	 * @param array $matches
	 * @return array
	 */
	function matches1Replace($matches)
	{
		$GLOBALS[GL_WITHIMG] = true;
		return (count($matches) > 1 ) ? preg_replace('/ src/i', ' wmx_src', $matches[0]) : $matches[0];
	}
	
	/**
	 * @param array $matches
	 * @return array
	 */
	function matches2Replace($matches)
	{
		$GLOBALS[GL_WITHIMG] = true;
		return (count($matches) > 1 ) ? preg_replace('/ background/i', ' wmx_background', $matches[0]) : $matches[0];
	}
