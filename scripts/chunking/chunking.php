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

$language = 'lang';
$dir = './input_directory_path/';

$fileNumber = 0;

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if (substr($file, 0, 1) != '.') {
                $name = basename($file);

                $content = extractLinesFromFile($dir . $name);
                
                // Pop the last element of the array if necessary (new line for example).
                // array_pop($content);
                
                for ($i = 0, $j = count($content); $i < $j; $i++) {
                    $posTable[$i] = splitStringBySpacesWithCaseRespect($content[$i]);
                }

                $i = 0;
                $treeSize = count($posTable);
                $str = '';
                $tree = array();
                $nominalChunkTags = array('NN', 'NNS', 'NP', 'DT', 'JJ', 'IN', 'TO', 'NC', 'ADJ', 'NOM', 'NAM', 'DET:ART', 'DET:POS', 'PRP', 'PRP:det', 'PREP', 'ART', 'DET');

                while ($i < $treeSize - 1) {
                    $leaf = $posTable[$i];
                    $followingLeaf = $posTable[$i + 1];

                    if (!in_array($leaf[1], $nominalChunkTags) || wordCountAccordingMicrosoftWordApproach($str) >= 10) {
                        array_push($tree, trim($str));
                        $str = '';
                        unset($posTable[$i]);
                    } else {
                        $str .= mb_strtolower($leaf[0]) . ' ';
                    }
                    $i++;
                }

                $deleteFrench = array('à', 'du', 'de', 'des', 'd\'', 'pour', 'la', 'le', 'l\'', 'les', 'et', 'ou', 'mais', 'qui', 'que', 'dont', 'si', 'alors', 'sinon', 'sur', 'sous', 'dessus', 'dessous', 'entre', 'donc', 'or', 'ni', 'car', 'avec', 'sans', 'depuis', 'par', 'au', 'dans', 'un', 'une', 'où', 'quand', 'aux');
                $deleteEnglish = array('a', 'at', 'to', 'of', 'for', 'the', 'and', 'or', 'but', 'who', 'whose', 'which', 'by', 'if', 'else', 'on', 'in', 'into', 'between', 'because', 'cause', 'no', 'with', 'without', 'from', 'in', 'into', 'within', 'an', 'where', 'when', 'shall', 'be', 'is', 'may', 'will', 'not', 'no', 'are', 'might');
                $deleteSpanish = array('a', 'de', 'del', 'por', 'el', 'le', 'la', 'las', 'los', 'y', 'o', 'pero', 'qui', 'quel', 'que', 'si', 'desde', 'sur', 'en', 'bajo', 'porque', 'con', 'sin', 'e', 'un', 'una', 'uno', 'donde', 'quien', 'cuando');
                $languageCodeWords = array('fr', 'en', 'it', 'la', 'gr', 'de', 'fl', 'fi', 'lt', 'ja', 'gl', 'gl', 'lb', 'hu', 'lv', 'mk', 'bs', 'cy', 'jp', 'vi', 'tg', 'qu', 'sq', 'sv', 'ro', 'nl', 'fo', 'eo', 'az', 'fa', 'az', 'io', 'tr', 'ru', 'nn', 'pag', 'vi', 'nrm', 'an', 'pl', 'nds', 'sr', 'sk', 'tl', 'os', 'gd', 'pt', 'es', 'ii', 'id', 'cs', 'bg', 'gn', 'bcl', 'q', 'zh', 'th', 'he', 'eu', 'gd', 'uk', 'zh-yue', 'ca', 'sl', 'vo', 'pt', 'br', 'sw', 'lad', 'ar', 'sdc', 'pms', 'pam', 'ur', 'gv', 'ka', 'ko', 'ta', 'sh', 'uz', 'mn', 'mr', 'oc', 'bn', 'da', 'li', 'uz', 'nah', 'ch', 'vls', 'crh', 'scn', 'category', 'catégorie', 'categoría');

                // Remove the first or the last element of a sentence if it is not relevant in a noun chunck.
                
                foreach ($tree as $key => $chunk) {
                    if (in_array(getLastToken($chunk), $deleteFrench) || in_array(getLastToken($chunk), $deleteEnglish) || in_array(getLastToken($chunk), $deleteSpanish)) {
                        $lastSpaceOffset = strrpos($chunk, ' ');
                        $chunk = substr($chunk, 0, $lastSpaceOffset);
                        $tree[$key] = trim($chunk);

                        if (in_array(getLastToken($chunk), $deleteFrench) || in_array(getLastToken($chunk), $deleteEnglish) || in_array(getLastToken($chunk), $deleteSpanish)) {
                            $lastSpaceOffset = strrpos($chunk, ' ');
                            $chunk = substr($chunk, 0, $lastSpaceOffset);
                            $tree[$key] = trim($chunk);
                        }
                    }
                    if (in_array(getLastToken($chunk), $languageCodeWords)) {
                        $lastSpaceOffset = strrpos($chunk, ' ');
                        $chunk = substr($chunk, 0, $lastSpaceOffset);
                        $tree[$key] = trim($chunk);
                    }
                }

                foreach ($tree as $key => $chunk) {
                    if (in_array(getFirstToken($chunk), $deleteFrench) || in_array(getFirstToken($chunk), $deleteEnglish) || in_array(getFirstToken($chunk), $deleteSpanish)) {
                        $explode = explode(' ', $chunk, 2);
                        $tree[$key] = trim($explode[1]);

                        if (in_array(getFirstToken($chunk), $deleteFrench) || in_array(getFirstToken($chunk), $deleteEnglish) || in_array(getFirstToken($chunk), $deleteSpanish)) {
                            $explode = explode(' ', $chunk, 2);
                            $tree[$key] = trim($explode[1]);
                        }
                    }
                }

                $tree = array_values($tree);

                foreach ($tree as $key => $chunk) {
                    if (!isAlphanumericWords($chunk) || is_numeric($chunk) || wordCountAccordingMicrosoftWordApproach($chunk) <= 3) {
                        unset($tree[$key]);
                    }
                }

                $tree = array_values($tree);

                $content = '';
                foreach ($tree as $chunk) {
                    $content .= $chunk . chr(10);
                }

                writeFile($dir . $name, $content);

                $fileNumber++;
            }
        }
        closedir($dh);
    }
}

/* * ***********************
 *      FUNCTIONS
 * *********************** */

function wordCountAccordingMicrosoftWordApproach($text) {
    return count(explode(" ", $text));
}

function getLastToken($string) {
    $splitedString = explode(" ", $string);
    return $splitedString[count($splitedString) - 1];
}

function getFirstToken($string) {
    $splitedString = explode(" ", $string);
    return $splitedString[0];
}

function isAlphanumericWords($string) {
    $result = "";
    preg_match("~([^A-Za-z\-ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ0123456789 '])~", $string, $result);
    //On cherche tous les caractères autre que alphabétique
    //si on en trouve on retourne false
    if (!empty($result)) {
        return false;
    } else {
        return true;
    }
}

function splitStringBySpacesWithCaseRespect($string) {
    return preg_split("#[\\s]#", $string, null, PREG_SPLIT_NO_EMPTY);
}

/**
 * Load a file line by line.
 * @param   string  $filename   File path.
 * @return  array   Extracted lines in a array.
 */
function extractLinesFromFile($filename) {
    try {
        if (!file_exists($filename)) {
            die('FILE_NOT_FOUND');
        }
        $file = fopen($filename, "r");
        if (!$file) {
            die('UNREADABLE_FILE');
        } else {
            $p = 0;
            while (!feof($file)) {
                $content[$p++] = trim(fgets($file));
            }
        }
        fclose($file);
    } catch (Exception $e) {
        die('UNREADABLE_FILE:' . $e);
        $content = null;
    }
    return $content;
}

/**
 * Write a file.
 * @param   string  $name       Name of file.
 * @param   string  $content    Content of file.
 */
function writeFile($name, $content) {
    $temporaryFileHandle = fopen($name, "w");
    fwrite($temporaryFileHandle, $content);
    fclose($temporaryFileHandle);
}
