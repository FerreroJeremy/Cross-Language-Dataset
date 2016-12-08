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

$encode = new Encoding();

$inputDir = './input_directory_path/';

$count = 0;
$limit = -1;

$lang1 = 'en';
$lang2 = 'fr';
$lang3 = 'es';

$filesLang1 = glob($inputDir . $lang1 . '/*');
asort($filesLang1);

foreach ($filesLang1 as $key => $fileLang1) {

    $path_parts = pathinfo($fileLang1);
    $fileName = substr($path_parts['filename'], 0, -3);

    $fileLang1 = $inputDir . $lang1 . '/' . $fileName . '-' . $lang1 . '.txt';
    $fileLang2 = $inputDir . $lang2 . '/' . $fileName . '-' . $lang2 . '.txt';
    $fileLang3 = $inputDir . $lang3 . '/' . $fileName . '-' . $lang3 . '.txt';

    $linesOfLang1 = extractLinesFromFile($fileLang1);
    $linesOfLang2 = extractLinesFromFile($fileLang2);
    $linesOfLang3 = extractLinesFromFile($fileLang3);

    foreach ($linesOfLang1 as $key => $element) {
        if (!empty($linesOfLang1[$key]) && !empty($linesOfLang2[$key]) && !empty($linesOfLang3[$key])) {
            $alignment[$count]['filename'] = $fileName;
            $alignment[$count]['en'] = mb_strtolower($linesOfLang1[$key]);
            $alignment[$count]['fr'] = mb_strtolower($linesOfLang2[$key]);
            $alignment[$count]['es'] = mb_strtolower($linesOfLang3[$key]);

            writeFile('verif.txt', $fileName . chr(10));
            writeFile('verif.txt', $alignment[$count]['en'] . chr(10));
            writeFile('verif.txt', $alignment[$count]['fr'] . chr(10));
            writeFile('verif.txt', $alignment[$count]['es'] . chr(10));
            writeFile('verif.txt', chr(10));

            $count++;
        }
    }
}

if ($limit > $count || $limit == -1) {
    $limit = $count;
}

for ($i = 0; $i < $limit; $i++) {
    $random = rand(0, $count);
    echo $alignment[$random]['filename'] . '<br/>';
    echo $alignment[$random]['en'] . '<br/>';
    echo '<font color="blue">' . $alignment[$random]['fr'] . '</font><br/>';
    echo '<font color="red">' . $alignment[$random]['es'] . '</font><br/>';
    echo '<br/>';
}

echo 'A total of <b>' . $count . '</b> elements have been aligned.';
echo '<br/>A total of <b>' . $limit . '</b> elements are displayed for verification.';


/* * ***********************
 *      FUNCTIONS
 * *********************** */

function writeFile($name, $content) {
    $temporaryFileHandle = fopen($name, "a");
    fwrite($temporaryFileHandle, $content);
    fclose($temporaryFileHandle);
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
