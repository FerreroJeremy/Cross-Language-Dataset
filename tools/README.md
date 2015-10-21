# A multilingual, multi-style and multi-granularity dataset for cross-language textual similarity detection

* In the <i>chunking/</i> directory, you can find a script to constitute noun chunks from a <i>TreeTagger'</i>s output<sup>1</sup>.<br/>
* In the <i>create_translations_dico/</i> directory, you can find a script to create an unigram translation dictionary for the use of <i>HunAlign<sup>2</sup></i>.<br/>
* In the <i>create_verif_align/</i> directory, you can find a script to print and save the alignments to allow a manual verification.<br/>
* In the <i>enrich_dico_with_dbnary/</i> directory, you can find a script to enrich an unigram translation dictionary with the <i>DBNary</i><sup>3</sup> entries.<br/>
* In the <i>parse_APR_collection/</i> directory, you can find a script to parse the <i>Webis-CLS-10<sup>4</sup></i> corpus and extract the English-French pairs.<br/>
* In the <i>parse_PAN_collection/</i> directory, you can find a script to parse the <i>PAN-PC-11<sup>5</sup></i> corpus and extract the English-Spanish pairs with metadata.<br/>
* In the <i>parse_conf_papers_bibtex/</i> directory, you can find a script to parse the <i>TALN BibTeX<sup>6</sup></i>, crawl the web and thus allow the construction of French-English conference paper pairs.<br/>

To manage the encoding of the files, I use the ForceUTF8<sup>7</sup> class coded by Sebastián Grignoli.<br/>
To detect the language of a text, I use the PHP implementation<sup>8</sup> by Nicholas Pisarro of the Cavnar and Trenkle (1994)<sup>9</sup> classification algorithm.<br/>
To query DBNary<sup>3</sup>, I use my own PHP classes<sup>10</sup>.

Sorry for the no commented dirty scripts. <br/> 
If you have a question, please send it to me by email at jeremyf@compilatio.net or jeremy.ferrero@imag.fr.<br/>

### References, tools used and existing collections

1.	Helmut Schmid (1994). <br/>
	Probabilistic Part-of-Speech Tagging Using Decision Trees. <br/>
	<i>In Proceedings of the International Conference on New Methods in Language Processing. <br/>
	url: http://www.cis.uni-muenchen.de/~schmid/tools/TreeTagger/ </i> 

2.	Dániel Varga, Péter Hálacsy, Viktor Nagy, Lázló Németh, András Kornai, and Viktor Trón (2005). <br/>
	Parallel corpora for medium density languages. <br/>
	<i>In Recent Advances in Natural Language Processing (RANLP 2005), pages 590–596. <br/>
	url: http://mokk.bme.hu/resources/hunalign/ </i> 

3.	Gilles Sérasset (2014). <br/>
	DBnary: Wiktionary as a Lemon-Based Multilingual Lexical Resource in RDF. <br/>
	<i>In to appear in Semantic Web Journal (special issue on Multilin- gual Linked Open Data). <br/>
	url: http://kaiko.getalp.org/about-dbnary/ </i> 

4.	Peter Prettenhofer and Benno Stein (2010). <br/>
	Cross-language text classification using structural correspondence learning. <br/>
	<i>In Proceedings of the 48th Annual Meeting of the Association for Computational Linguistics (ACL), pages 1118-1127. <br/>
	url: http://www.uni-weimar.de/en/media/chairs/webis/corpora/corpus-webis-cls-10/ </i>

5.	Martin Potthast, Benno Stein, Alberto Barrón-Cedeño, and Paolo Rosso (2010). <br/>
	An Evaluation Framework for Plagiarism Detection. <br/>
	<i>In Proceedings of the 23rd International Conference on Computational Linguistics (COLING 2010), Beijing,
China, August 2010. Association for Computational Linguistics. <br/>
	url: http://www.uni-weimar.de/en/media/chairs/webis/corpora/pan-pc-11/ </i> 
	
6.	Florian Boudin (2013). <br/>
	TALN Archives : a digital archive of French research articles in Natural Language Processing (TALN Archives : une archive numérique francophone des articles de recherche en Traitement Automatique de la Langue) [in French]). <br/>
	<i>In Proceedings of TALN 2013 (Volume 2: Short Papers), pages 507–514. <br/>
	url: https://github.com/boudinfl/taln-archives </i> 

7.	ForceUTF8 <br/>
	<i>url: https://github.com/neitanod/forceutf8</i>

8.	Text Language Detect <br/>
	<i>url: https://github.com/webmil/text-language-detect</i>

9.	William B. Cavnar and John M. Trenkle (1994). <br/>
	N-Gram- Based Text Categorization. <br/>
	<i>In Proceedings of SDAIR- 94, 3rd Annual Symposium on Document Analysis and Information Retrieval, pages 161–175.</i>

10.	DBNary PHP Interface <br/>
	<i>url: https://github.com/FerreroJeremy/DBNary-PHP-Interface</i>


### Licence
<a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
