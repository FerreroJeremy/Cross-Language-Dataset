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
    $wordNumber = 0;
    $caracterNumber = 0;
    $lineNumber = 0;
    
    $dir = './Europarl/es/';
    
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(substr($file,0,1) != '.') {
                    $name = basename($file);
                    
                    $lines = extractLinesFromFile($dir . $name);
                    $lineNumber += count($lines) - 1;
                    
                    $content = $encode->toUTF8(loadFile($dir . $name));
                    
                    $words = explode(' ', $content);
                    $wordNumber += count($words);
                    
                    $caracterNumber += strlen($content);
                    
                    $fileNumber++;
                }
            }
            closedir($dh);
        }
    }
    
    echo 'Number of files : ' . $fileNumber . '; ';
    echo 'Number of lines : ' . $lineNumber . '; ';
    echo 'Number of academic words : ' . $wordNumber . '; ';
    echo 'Number of characters : ' . $caracterNumber . '; ';
    

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
            die('UNREADABLE_FILE');
            $content = null;
        }
        return $content;
    }
    
    function loadFile($filename) {
        try {
            if (!file_exists($filename)) {
                die('FILE_NOT_FOUND');
            }
            return file_get_contents($filename);
        } catch (Exception $e) {
            die('UNREADABLE_FILE');
        }
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
    
    function removeUselessSpaces($string) {
        $string = str_replace(CHR(13) . CHR(10), "", $string);
        return preg_replace('~\s+~', ' ', $string);
    }
