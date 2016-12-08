<?php
    
/**
 * Jérémy Ferrero<br/>
 * Compilatio <br/>
 * GETALP - Laboratory of Informatics of Grenoble <br/>
 *
 * This work is licensed under a Creative Commons Attribution-ShareAlike 4.0 International License.
 * For more information, see http://creativecommons.org/licenses/by-sa/4.0/
 */

set_time_limit(100000);
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * @see https://github.com/neitanod/forceutf8
 */
require_once('Encoding.php');

require_once('TextualEquivalent.php');

mkdir('en');
mkdir('es');

$dir = 'input_directory_path/';
$src_dir = 'src_output_directory_path/';
$susp_dir = 'susp_output_directory_path/';

$encode = new Encoding();

$j = 0;

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if (substr($file, 0, 1) != '.') {
                
                $name = basename($file, '.xml');

                $this_content = loadFile($susp_dir . $name . '.txt');

                $content = loadFile($dir . basename($file));
                $xml_content = simplexml_load_file($dir . basename($file));

                $authors = $xml_content->feature[0]['authors'];
                $title = $xml_content->feature[0]['title'];


                for ($i = 2; $i < count($xml_content); $i++) {
                    $type = (string) $xml_content->feature[$i]['type'];
                    $obfuscation = (string) $xml_content->feature[$i]['manual_obfuscation'];
                    $this_lang = (string) $xml_content->feature[$i]['this_language'];
                    $src_lang = (string) $xml_content->feature[$i]['source_language'];
                    $this_offset = intval($xml_content->feature[$i]['this_offset']);
                    $this_lenght = intval($xml_content->feature[$i]['this_length']);
                    $src_offset = intval($xml_content->feature[$i]['source_offset']);
                    $src_lenght = intval($xml_content->feature[$i]['source_length']);
                    $src_txt = (string) $xml_content->feature[$i]['source_reference'];
                    $src_ref = (string) basename($src_txt, '.txt');

                    $src_content = loadFile($src_dir . $src_txt);

                    $this_feature_content = $encode->toUTF8(substr($encode->toLatin1($this_content), $this_offset, $this_lenght));
                    $src_feature_content = $encode->toUTF8(substr($encode->toLatin1($src_content), $src_offset + 1, $src_lenght + 1));

                    writeFile($this_lang . '/SUSP_' . $j . '_' . ($i - 2) . '.txt', $this_feature_content);
                    writeFile($src_lang . '/SRC_' . $j . '_' . ($i - 2) . '.txt', $src_feature_content);

                    $noiseNumber = substr_count($this_feature_content, ' vna ');
                    $noiseNumber += substr_count($this_feature_content, ' vn ');
                    $noiseNumber += substr_count($this_feature_content, ' i ');

                    $noise = (($noiseNumber >= 5) ? 'true' : 'false');

                    $textualEquivalent = new TextualEquivalent($name, $this_lang, $this_offset, $this_lenght, $this_feature_content, $src_ref, $src_lang, $src_offset, $src_lenght, $src_feature_content, $type, $obfuscation, $noise);


                    $string = '<?xml version="1.0" encoding="UTF-8"?>' . chr(10);
                    $string .= '<info>' . chr(10);
                    $string .= '<sourceIDDoc>' . $src_ref . '</sourceIDDoc>' . chr(10);
                    $string .= '<sourceTextLanguage>' . $src_lang . '</sourceTextLanguage>' . chr(10);
                    $string .= '<sourceTextOffset>' . $src_offset . '</sourceTextOffset>' . chr(10);
                    $string .= '<sourceTextLength>' . $src_lenght . '</sourceTextLength>' . chr(10);
                    $string .= '<sourceTextContent>' . $src_feature_content . '</sourceTextContent>' . chr(10);
                    $string .= '<suspiciousIDDoc>' . $name . '</suspiciousIDDoc>' . chr(10);
                    $string .= '<suspiciousTextLanguage>' . $this_lang . '</suspiciousTextLanguage>' . chr(10);
                    $string .= '<suspiciousTextOffset>' . $this_offset . '</suspiciousTextOffset>' . chr(10);
                    $string .= '<suspiciousTextLength>' . $this_lenght . '</suspiciousTextLength>' . chr(10);
                    $string .= '<suspiciousTextContent>' . $this_feature_content . '</suspiciousTextContent>' . chr(10);
                    $string .= '<equivalentType>' . $type . '</equivalentType>' . chr(10);
                    $string .= '<manualObfuscation>' . $obfuscation . '</manualObfuscation>' . chr(10);
                    $string .= '<automaticNoise>' . $noise . '</automaticNoise>' . chr(10);
                    $string .= '</info>';

                    writeFile('metadata' . '/METADATA_' . $j . '_' . ($i - 2) . '.xml', $string);
                }
                $j++;
            }
        }
        closedir($dh);
    }
}


/* * ***********************
 *      FUNCTIONS
 * *********************** */

function loadFile($filename) {
    try {
        if (!file_exists($filename)) {
            die('FILE_NOT_FOUND');
        }
        return file_get_contents($filename);
    } catch (Exception $e) {
        die('UNREADABLE_FILE:' . $e);
    }
}

function parseXMLString($xmlTag, $xmlString, $conserveXMLTag = false) {
    $matches = array();
    $found = preg_match_all('#<' . $xmlTag . '(?:\s+[^>]+)?>(.*?)' . '</' . $xmlTag . '>#s', $xmlString, $matches);

    if ($xmlString == false) {
        return false;
    }
    if ($found != false) {
        if (!$conserveXMLTag) {
            return $matches[1];
        } else {
            return $matches[0];
        }
    }
    unset($matches);

    return false;
}

function writeFile($name, $content) {
    $temporaryFileHandle = fopen($name, "w");
    fwrite($temporaryFileHandle, $content);
    fclose($temporaryFileHandle);
}
