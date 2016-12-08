<?php
    
/**
 * Jérémy Ferrero<br/>
 * Compilatio <br/>
 * GETALP - Laboratory of Informatics of Grenoble <br/>
 *
 * This work is licensed under a Creative Commons Attribution-ShareAlike 4.0 International License.
 * For more information, see http://creativecommons.org/licenses/by-sa/4.0/
 */

mkdir('book_en');
mkdir('book_fr');
mkdir('dvd_en');
mkdir('dvd_fr');
mkdir('music_en');
mkdir('music_fr');


$book_xml_text_en = loadFile('Amazon_product_reviews/books/books.en');
$book_array_xml_text_en = parseXMLString('text', $book_xml_text_en, false);
$iterator = 0;
foreach ($book_array_xml_text_en as $book_en) {
    if (!empty($book_en)) {
        writeFile('book_en/book_en' . $iterator . '.txt', $book_en);
        $iterator++;
    } else {
        writeFile('music_en/book_en' . $iterator . '.txt', 'translation not available');
        $iterator++;
    }
}

$book_xml_text_fr = loadFile('Amazon_product_reviews/books/books.fr');
$book_array_xml_text_fr = parseXMLString('text', $book_xml_text_fr, false);
$iterator = 0;
foreach ($book_array_xml_text_fr as $book_fr) {
    if (!empty($book_fr)) {
        writeFile('book_fr/book_fr' . $iterator . '.txt', $book_fr);
        $iterator++;
    } else {
        writeFile('music_en/book_fr' . $iterator . '.txt', 'translation not available');
        $iterator++;
    }
}

$dvd_xml_text_en = loadFile('Amazon_product_reviews/dvd/dvd.en');
$dvd_array_xml_text_en = parseXMLString('text', $dvd_xml_text_en, false);
$iterator = 0;
foreach ($dvd_array_xml_text_en as $dvd_en) {
    if (!empty($dvd_en)) {
        writeFile('dvd_en/dvd_en' . $iterator . '.txt', $dvd_en);
        $iterator++;
    } else {
        writeFile('music_en/dvd_en' . $iterator . '.txt', 'translation not available');
        $iterator++;
    }
}

$dvd_xml_text_fr = loadFile('Amazon_product_reviews/dvd/dvd.fr');
$dvd_array_xml_text_fr = parseXMLString('text', $dvd_xml_text_fr, false);
$iterator = 0;

foreach ($dvd_array_xml_text_fr as $dvd_fr) {
    if (!empty($dvd_fr)) {
        writeFile('dvd_fr/dvd_fr' . $iterator . '.txt', $dvd_fr);
        $iterator++;
    } else {
        writeFile('music_en/dvd_fr' . $iterator . '.txt', 'translation not available');
        $iterator++;
    }
}

$music_xml_text_en = loadFile('Amazon_product_reviews/music/music.en');
$music_array_xml_text_en = parseXMLString('text', $music_xml_text_en, false);
$iterator = 0;
foreach ($music_array_xml_text_en as $music_en) {
    if (!empty($music_en)) {
        writeFile('music_en/music_en' . $iterator . '.txt', $music_en);
        $iterator++;
    } else {
        writeFile('music_en/music_en' . $iterator . '.txt', 'translation not available');
        $iterator++;
    }
}

$music_xml_text_fr = loadFile('Amazon_product_reviews/music/music.fr');
$music_array_xml_text_fr = parseXMLString('text', $music_xml_text_fr, false);
$iterator = 0;
foreach ($music_array_xml_text_fr as $music_fr) {
    if (!empty($music_fr)) {
        writeFile('music_fr/music_fr' . $iterator . '.txt', $music_fr);
        $iterator++;
    } else {
        writeFile('music_en/music_fr' . $iterator . '.txt', 'translation not available');
        $iterator++;
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
