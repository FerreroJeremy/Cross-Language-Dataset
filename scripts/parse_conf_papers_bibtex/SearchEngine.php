<?php
    
/**
 * Jérémy Ferrero<br/>
 * Compilatio <br/>
 * GETALP - Laboratory of Informatics of Grenoble <br/>
 *
 * This work is licensed under a Creative Commons Attribution-ShareAlike 4.0 International License.
 * For more information, see http://creativecommons.org/licenses/by-sa/4.0/
 */

class SearchEngine {
    /*     * *****************************************************************************************
     *                                      VARIABLES
     * **************************************************************************************** */

    /**
     * Search language.
     * @var string  $language
     */
    var $language = "fr";

    /**
     * Returned Urls.
     * @var array   $urls
     */
    var $urls = array();

    /**
     * Timeout between two query.
     * @var int   $timeout
     */
    var $timeout = 60;

    /*     * *****************************************************************************************
     *                                      CONSTRUCTOR
     * **************************************************************************************** */

    /**
     * Default constructor of the SearchEngine class.
     * @param   string  $language   Language.
     */
    public function __construct($language = 'fr') {
        $this->language = $language;
    }

    /*     * *****************************************************************************************
     *                                       GETTERS
     * **************************************************************************************** */

    /**
     * Return the urls.
     * @return  array   urls.
     */
    public function getUrls() {
        return $this->urls;
    }

    /*     * *****************************************************************************************
     *                                       SETTERS
     * **************************************************************************************** */

    /**
     * Set the search language.
     * @param   string  $language   New language.
     */
    public function setLanguage($language) {
        $this->language = $language;
    }

    /**
     * Set a timeout.
     * @param   int $timeout    New timeout.
     */
    public function setTimeOut($timeout) {
        $this->timeout = $timeout;
    }

    /*     * *****************************************************************************************
     *                                      METHODES
     * **************************************************************************************** */

    /**
     * Launch a Google query.
     * @param   string  $terms  Query (terms = keywords).
     * @return  string  Returned page content.
     */
    public function launchGoogleRequestAndGetResults($terms) {
        $language = strtolower($this->language);
        // AJAX query on Google API.
        $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=" . rawurlencode($terms) . "&hl=" . $language;
        // Timeout needed between two Google queries to not blacklist our IP address.
        // sleep($this->timeout);
        // Get content page.
        $pageContent = getContentOfWebPage($url);

        return $pageContent;
    }

    /**
     * Return the links extracted from the content page.
     * @param   string  $pageContent    Content page.
     * @return  array   Array of links.
     */
    public function getLinksOfGoogleResult($pageContent) {
        $match = array();
        preg_match_all("/unescapedUrl\":\"([^\"]*)\"/", $pageContent, $match);
        return $match[1];
    }

}
