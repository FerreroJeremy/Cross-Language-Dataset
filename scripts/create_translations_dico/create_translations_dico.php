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

$pathLang1 = 'lex/fr.txt';
$pathLang2 = 'lex/es.txt';

$contentLang1 = extractLinesFromFile($pathLang1);
$contentLang2 = extractLinesFromFile($pathLang2);

$dico = array();
$lex = array();

foreach ($contentLang1 as $keyLang1 => $wordLang1) {
    if (!empty(trim($wordLang1)) && !empty(trim($contentLang2[$keyLang1]))) {
        array_push($dico, trim($wordLang1) . ' @ ' . trim($contentLang2[$keyLang1]));
    }
}
$dico = array_unique($dico);
asort($dico);

$string = '';
foreach ($dico as $entry) {
    $string .= $entry . chr(10);
}
writeFile('dico/dico_fr_es.txt', trim($string));

/* * ***********************
 *      FUNCTIONS
 * *********************** */

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
