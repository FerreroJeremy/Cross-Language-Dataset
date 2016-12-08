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
 * @see https://github.com/FerreroJeremy/DBNary-PHP-Interface
 */
require_once('DBNaryInterface.php');

/**
 * @see https://github.com/neitanod/forceutf8
 */
require_once('Encoding.php');

$db = new DBNaryInterface();
$encode = new Encoding();

$db->setLanguageFrom('french');
$db->setLanguageTo('english');
$db->connect();

$words = extractLinesFromFile('dicos/dico_295065.txt');

foreach ($words as $word) {
    $word = $encode->toUTF8(trim($word));
    $word = getFirstWord(trim($word));
    $db->getTranslations(trim($word));
    $availableTranslations = $db->getResultInList();

    if (!empty($availableTranslations)) {
        foreach ($availableTranslations as $translation) {
            writeInFile('dico_from_dbnary.txt', trim($word) . ' @ ' . trim($translation) . chr(10));
        }
    }
}

/* * ***********************
 *      FUNCTIONS
 * *********************** */

function getFirstWord($text) {
    $words = explode(chr(9), $text);
    return $words[0];
}

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

function writeInFile($name, $content) {
    $temporaryFileHandle = fopen($name, "a");
    fwrite($temporaryFileHandle, $content);
    fclose($temporaryFileHandle);
}
