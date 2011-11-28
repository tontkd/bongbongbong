<?php
/*
=====================================================
 Cs-Cart 2.0.7 Nulled By KenDesign
-----------------------------------------------------
 www.freeshareall.com - www.freeshareall.net
-----------------------------------------------------
 KenDesign Team
=====================================================
*/


//
// $Id: class.mailer.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

require(DIR_LIB . 'phpmailer/class.phpmailer.php');

class Mailer extends PHPMailer
{
    function SetLanguage($lang_type, $lang_path = "language/") 
	{
		$lang_path = DIR_LIB . 'phpmailer/' . $lang_path;

		if (file_exists($lang_path . 'phpmailer.lang-' . $lang_type . '.php')) {
            include($lang_path . 'phpmailer.lang-' . $lang_type . '.php');
		} elseif (file_exists($lang_path . 'phpmailer.lang-en.php')) {
            include($lang_path . 'phpmailer.lang-en.php');
        } else {
            $this->SetError("Could not load language file");
            return false;
        }

        $this->language = $PHPMAILER_LANG;
    
        return true;
    }

    function AddImageStringAttachment($string, $filename, $encoding = "base64", $type = "application/octet-stream") 
	{
        // Append to $attachment array
        $cur = count($this->attachment);
        $this->attachment[$cur][0] = $string;
        $this->attachment[$cur][1] = $filename;
        $this->attachment[$cur][2] = $filename;
        $this->attachment[$cur][3] = $encoding;
        $this->attachment[$cur][4] = $type;
        $this->attachment[$cur][5] = true; // isString
        $this->attachment[$cur][6] = "inline";
        $this->attachment[$cur][7] = $filename;
    }

	function RFCDate()
	{
		return date('r');
	}
}

?>
