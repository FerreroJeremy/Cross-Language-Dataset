<?php

/**
 * Jérémy Ferrero<br/>
 * Compilatio <br/>
 * GETALP - Laboratory of Informatics of Grenoble <br/>
 *
 * This work is licensed under a Creative Commons Attribution-ShareAlike 4.0 International License.
 * For more information, see http://creativecommons.org/licenses/by-sa/4.0/
 */

class TextualEquivalent {
    /*     * *****************************************************************************************
     *                                      VARIABLES
     * **************************************************************************************** */

    var $sourceIDDoc = '';
    var $sourceTextLanguage = '';
    var $sourceTextOffset = '';
    var $sourceTextLength = '';
    var $sourceTextContent = '';
    var $suspiciousIDDoc = '';
    var $suspiciousTextLanguage = '';
    var $suspiciousTextOffset = '';
    var $suspiciousTextLength = '';
    var $suspiciousTextContent = '';
    var $equivalentType = '';
    var $manualObfuscation = false;
    var $automaticNoise = false;

    /*     * *****************************************************************************************
     *                                      CONSTRUCTOR
     * **************************************************************************************** */

    public function __construct($name, $this_lang, $this_offset, $this_lenght, $this_feature_content, $src_ref, $src_lang, $src_offset, $src_lenght, $src_feature_content, $type, $obfuscation, $noise) {
        $this->setSuspiciousIDDoc($name);
        $this->setSuspiciousTextLanguage($this_lang);
        $this->setSuspiciousTextOffset($this_offset);
        $this->setSuspiciousTextLength($this_lenght);
        $this->setSuspiciousTextContent($this_feature_content);

        $this->setSourceIDDoc($src_ref);
        $this->setSourceTextLanguage($src_lang);
        $this->setSourceTextOffset($src_offset);
        $this->setSourceTextLength($src_lenght);
        $this->setSourceTextContent($src_feature_content);

        $this->setEquivalentType($type);
        $this->setManualObfuscation($obfuscation);
        $this->setAutomaticNoise($noise);
    }

    /*     * *****************************************************************************************
     *                                      GETTERS
     * **************************************************************************************** */

    public function getSourceIDDoc() {
        return $this->sourceIDDoc;
    }

    public function getSourceTextContent() {
        return $this->sourceTextContent;
    }

    public function getSourceTextLanguage() {
        return $this->sourceTextLanguage;
    }

    public function getSourceTextOffset() {
        return $this->sourceTextOffset;
    }

    public function getSourceTextLength() {
        return $this->sourceTextLength;
    }

    public function getSuspiciousIDDoc() {
        return $this->suspiciousIDDoc;
    }

    public function getSuspiciousTextContent() {
        return $this->suspiciousTextContent;
    }

    public function getSuspiciousTextLanguage() {
        return $this->suspiciousTextLanguage;
    }

    public function getSuspiciousTextOffset() {
        return $this->suspiciousTextOffset;
    }

    public function getSuspiciousTextLength() {
        return $this->suspiciousTextLength;
    }

    public function getEquivalentType() {
        return $this->equivalentType;
    }

    public function getManualObfuscation() {
        return $this->manualObfuscation;
    }

    public function getAutomaticNoise() {
        return $this->automaticNoise;
    }

    /*     * *****************************************************************************************
     *                                       SETTERS
     * **************************************************************************************** */

    public function setSourceIDDoc($id) {
        $this->sourceIDDoc = $id;
    }

    public function setSourceTextContent($text) {
        $this->sourceTextContent = $text;
    }

    public function setSourceTextLanguage($lang) {
        $this->sourceTextLanguage = $lang;
    }

    public function setSourceTextOffset($offset) {
        $this->sourceTextOffset = $offset;
    }

    public function setSourceTextLength($length) {
        $this->sourceTextLength = $length;
    }

    public function setSuspiciousIDDoc($id) {
        $this->suspiciousIDDoc = $id;
    }

    public function setSuspiciousTextContent($text) {
        $this->suspiciousTextContent = $text;
    }

    public function setSuspiciousTextLanguage($lang) {
        $this->suspiciousTextLanguage = $lang;
    }

    public function setSuspiciousTextOffset($offset) {
        $this->suspiciousTextOffset = $offset;
    }

    public function setSuspiciousTextLength($length) {
        $this->suspiciousTextLength = $length;
    }

    public function setEquivalentType($equivalentType) {
        $this->equivalentType = $equivalentType;
    }

    public function setManualObfuscation($obfuscation) {
        $this->manualObfuscation = $obfuscation;
    }

    public function setAutomaticNoise($noise) {
        $this->automaticNoise = $noise;
    }

}
