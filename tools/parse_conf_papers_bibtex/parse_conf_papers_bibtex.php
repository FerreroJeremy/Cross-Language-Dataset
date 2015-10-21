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

/**
 * @see https://github.com/boudinfl/taln-archives
 */
$path = './input_taln_file.bib';


$encode = new Encoding();

$content = $encode->toUTF8(loadFile($path));
$articles = parseBibTex($content);

foreach ($articles as $article) {
    $authors = parseAuthors($article);
    $url = parseUrl($article);

    $ScholarUrlsResult = getLinksOfScholarResult(googleScholarResearch($authors));
    $SERPUrlsResult = getLinksOfGoogleResult(launchGoogleRequestAndGetResults($authors));
    writeFile(basename($path), $url, $ScholarUrlsResult, $SERPUrlsResult);
}


/* * ***********************
 *      FUNCTIONS
 * *********************** */

function googleScholarResearch($authors) {
    $url = 'https://scholar.google.fr/scholar?hl=fr&q=' . rawurlencode($authors);
    $content = file_get_contents($url);
    sleep(20);

    return $content;
}

function getLinksOfScholarResult($result) {
    $urls = extractUrls($result);
    $urls = array_slice($urls, 12);
    array_splice($urls, -3);

    return $urls;
}

function parseBibTex($bibtexContent) {
    $match = array();
    preg_match_all("/inproceedings{([^\"]*)," . Chr(10) . "}/Ui", $bibtexContent, $match);

    return $match[1];
}

function parseAuthors($articleContent) {
    $match = array();
    preg_match("/author    = {([^\"]*)},/Ui", $articleContent, $match);

    return $match[1];
}

function parseUrl($articleContent) {
    $match = array();
    preg_match("/url       = {([^\"]*)},/Ui", $articleContent, $match);

    return $match[1];
}

function launchGoogleRequestAndGetResults($terms) {
    $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=" . rawurlencode($terms) . "&hl=en";
    sleep(20);
    $pageContent = file_get_contents($url);

    return $pageContent;
}

function getLinksOfGoogleResult($pageContent) {
    $match = array();
    preg_match_all("/unescapedUrl\":\"([^\"]*)\"/", $pageContent, $match);
    return $match[1];
}

function extractUrls($text) {
    $temporaryUrls = array();
    $temptext = str_replace(array(chr(39), chr(34), '<', '>', '&', ',', ';', '!', '(', ')', '[', ']', '{', '}', '\n', "\n"), ' ', $text);
    $result = explode(" ", $temptext);
    for ($increment = 0; $increment < sizeof($result); $increment++) {
        if ((strrpos($result[$increment], 'www') === FALSE) && (strrpos($result[$increment], 'http') === FALSE) && (strrpos($result[$increment], '//') === FALSE) && (strrpos($result[$increment], 'ftp') === FALSE)) {
            
        } else {
            $tempcar = substr($result[$increment], count($result[$increment]) - 2, 1);
            if (strcmp($tempcar, '.') == 0) {
                if (!in_array(substr($result[$increment], 0, count($result[$increment]) - 2), $temporaryUrls)) {
                    array_push($temporaryUrls, substr($result[$increment], 0, count($result[$increment]) - 2));
                }
            } else {
                if (!in_array($result[$increment], $temporaryUrls)) {
                    array_push($temporaryUrls, $result[$increment]);
                }
            }
        }
    }

    return $temporaryUrls;
}

/**
 * Load a file in a string.
 * @param   string  $filename   File path.
 * @return  string  Content.
 */
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

/**
 * Extract the content of a specific balise in a XML string.
 * @param   string  $xmlTag         XML balise.
 * @param   string  $xmlString      XML string.
 * @param   boolean $conserveXMLTag Extraction mode.
 * <br/><br/>Usage :
 * <br/><b>&nbsp;&nbsp;&nbsp;true</b>&nbsp;&nbsp;&nbsp;Conserve the balise. 
 * <br/><b>&nbsp;&nbsp;&nbsp;false</b>&nbsp;&nbsp;&nbsp;Ignore the balise. <br/>
 * <b>false</b> to default.
 * @return  mixed   Array of matches.
 */
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

/**
 * Write in file with xml syntax.
 */
function writeFile($filename, $sourceUrl, $ScholarUrlsResult, $SERPUrlsResult) {
    $fileHandle = fopen($filename . '.xml', "a");

    $targetUrls = '';

    foreach ($ScholarUrlsResult as $url) {
        $targetUrls .= chr(9) . '<scholarUrls> ' . $url . ' </scholarUrls>' . chr(10);
    }

    $targetUrls .= chr(10);

    foreach ($SERPUrlsResult as $url) {
        $targetUrls .= chr(9) . '<SERPUrls> ' . $url . ' </SERPUrls>' . chr(10);
    }

    $content = '<article atalaUrl="' . $sourceUrl . '">' . chr(10) . $targetUrls . '</article>' . chr(10);

    fwrite($fileHandle, $content);
    fclose($fileHandle);
}
