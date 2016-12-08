<?php
    
    set_time_limit(100000);
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    /**
     * @see https://github.com/neitanod/forceutf8
     */
    require_once('Encoding.php');
    
    $encode = new Encoding();
    
    
    $fileNumber = 0;
    $sentenceNumber = 0;
    
    $dir = './fr/';
    
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(substr($file,0,1) != '.') {
                    $name = basename($file);
                    $content = $encode->toUTF8(loadFile($dir . $name));
                    $content = preg_replace('~([A-Za-z\-ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ])[.]([A-Za-z\-ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ])~', '$1. $2', $content);
                    $content = preg_replace('~([A-Za-z\-ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ])[!]([A-Za-z\-ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ])~', '$1. $2', $content);
                    $content = preg_replace('~([A-Za-z\-ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ])[?]([A-Za-z\-ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ])~', '$1. $2', $content);
                    $sentences = splitTextInSentencesWithPunctuationConservation(removeUselessSpaces($content));
                    $content = '';
                    foreach($sentences as $sentence){
                        $sentenceNumber++;
                        $content .= trim($sentence) . chr(10);
                    }
                    writeFile($dir . $name, trim($content));
                    $fileNumber++;
                }
            }
            closedir($dh);
        }
    }
    
    echo '<b>TERMINE ! </b> <br/> Nombre de fichiers traités : ' . $fileNumber . ' <br/> Nombre de phrases traitées : ' . $sentenceNumber;

    function loadFile($filename) {
        try {
            if (!file_exists($filename)) {
            }
            return file_get_contents($filename);
        } catch (TALException $e) {
            echo($e);
            return null;
        }
    }
    
    function extractLinesFromFile($filename) {
        try {
            if (!file_exists($filename)) {
                throw new ProcessException('Fichier "' . $filename . '" introuvable.', ProcessException::FILE_NOT_FOUND);
            }
            $file = fopen($filename, "r");
            if (!$file) {
                throw new ProcessException('Fichier "' . $filename . '" existant mais illisible.', ProcessException::UNREADABLE_FILE);
            } else {
                $p = 0;
                while (!feof($file)) {
                    $content[$p++] = fgets($file);
                }
            }
            fclose($file);
        } catch (ProcessException $e) {
            echo($e);
            $content = null;
        }
        return $content;
    }
    
    function isSentencePunctuation($string) {
        return in_array($string, array('.', '?', '!'));
    }
    
    function isConjonction($string) {
        return in_array($string, array('KON', 'CC', 'CCAD', 'CCNEG'));
    }
    
    function wordCount($string) {
        return str_word_count($string, 0, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ0123456789');
    }
    
    function multiexplode($delimiters, $string) {
        $newString = str_replace($delimiters, $delimiters[0], $string);
        $textExploded = preg_split("~" . preg_quote($delimiters[0], '/') . "~", $newString, null, PREG_SPLIT_NO_EMPTY);
        return $textExploded;
    }

    function splitText($text, $sizeOfSegment) {
        $temporarySegments = array();
        $textOfSegment = '';
        $segments = multiexplode(array('. ', '! ', '? '), removeUselessSpaces($text));
        $wordNumber = 0;
        foreach ($segments as $segment) {
            $wordNumber += wordCount($segment);
            $textOfSegment .= ' ' . $segment . '.';
            if ($wordNumber >= $sizeOfSegment) {
                array_push($temporarySegments, trim($textOfSegment));
                $textOfSegment = '';
                $wordNumber = 0;
            }
        }
        return $temporarySegments;
    }

    function splitTextInSentences($string) {
        return preg_split("#([.?!])#", $string, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
    }
    
    function splitTextInSentencesWithPunctuationConservation($string) {
        $sentences = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', removeUselessSpaces($string));
        return $sentences;
    }

    function splitTextInPhrasesWithPunctuationConservation($string) {
        $ponctuation = ".!?;:";
        $matches = array();
        preg_match_all("~([^$ponctuation]*[$ponctuation]*)\\s*~", $string, $matches);
        $resultats = $matches[0];
        array_pop($resultats);
        unset($matches);
        return $resultats;
    }
    
    function splitTextInUnitsOfSensePunctuationConservation($string) {
        return preg_split("#([.!?,;:])#", $string, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
    }
    
    function splitStringBySpacesWithCaseRespect($string) {
        return preg_split("#[\\s]#", $string, null, PREG_SPLIT_NO_EMPTY);
    }
    
    function toLowerString($string) {
        return mb_strtolower($string, 'UTF-8');
    }
    
    function removeUselessSpaces($string) {
        $string = str_replace(CHR(13) . CHR(10), "", $string);
        return preg_replace('~\s+~', ' ', $string);
    }
    
    function writeFile($name, $content) {
        $temporaryFileHandle = fopen($name, "w");
        fwrite($temporaryFileHandle, $content);
        fclose($temporaryFileHandle);
    }
    
    function display($object) {
        echo '<pre>';
        print_r($object);
        echo '</pre>';
    }
