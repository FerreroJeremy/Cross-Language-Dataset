<?php

mkdir('en');
mkdir('fr');
mkdir('es');
    
    
    $dir = 'Europarl_corpus/en/';
    
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(substr($file,0,1) != '.') {
                    $content = loadFile($dir . basename($file));
                    $content = strip_tags($content);
                    $name = basename($file, '.xml');
                    writeFile('en/' . $name . '.txt', $content);
                }
                
            }
            closedir($dh);
        }
    }
    
    
    $dir = 'Europarl_corpus/fr/';
    
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(substr($file,0,1) != '.') {
                    $content = loadFile($dir . basename($file));
                    $content = strip_tags($content);
                    $name = basename($file, '.xml');
                    writeFile('fr/' . $name . '.txt', $content);
                }
                
            }
            closedir($dh);
        }
    }
    
    $dir = 'Europarl_corpus/es/';
    
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(substr($file,0,1) != '.') {
                    $content = loadFile($dir . basename($file));
                    $content = strip_tags($content);
                    $name = basename($file, '.xml');
                    writeFile('es/' . $name . '.txt', $content);
                }
                
            }
            closedir($dh);
        }
    }
    

echo 'done';

function loadFile($filename) {
    try {
        if (!file_exists($filename)) {
            throw new TALException('Fichier "' . $filename . '" introuvable.', TALException::FILE_NOT_FOUND);
        }
        return file_get_contents($filename);
    } catch (TALException $e) {
        echo($e);
        return null;
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
