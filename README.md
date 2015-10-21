# A multilingual, multi-style and multi-granularity dataset for cross-language textual similarity detection

* In the Aligned_Documents_Sub_Corpus/ directory, you can find the dataset of parallel and comparable files aligned at document-level (one file represents one document).<br/>
* In the Aligned_Sentences_Sub_Corpus/ directory, you can find the dataset of parallel and comparable files aligned at sentence-level (a line of a file represents one sentence).<br/>
* In the Aligned_Chunks_Sub_Corpus/ directory, you can find the dataset of parallel and comparable files aligned at chunk-level (a line of a file represents one noun chunk).<br/>
* In the tools/ directory, you can find all the useful files to re-create the dataset.

### Characteristics

Sub-corpus | Alignment | Authors | Translations | Translators | Alteration
--- | --- | ---| --- | ---| ---
JRC Acquis | Parallel | Politicians | Human | Professional | No
Europarl | Parallel | Politicians | Human | Professional | No
Wikipedia | Comparable | Anyone | - | - | Noise
PAN 2011 (Gutenberg Project) |  Parallel |  Professional authors | Human | Professional | Yes
Amazon Product Reviews | Parallel | Anyone | Machine | Google Translate | No
Conference papers | Comparable | Computer scientists | Human | Computer scientists | Noise

### Statistics

Sub-corpus | # Aligned documents | # Aligned sentences | # Aligned noun chunks
--- | --- | ---| ---
JRC-Acquis | 10,000 | 149,506 | 10,094 
Europarl | 9,442 | 475,834 | 25,603 
Wikipedia | 10,000 | 4,792 | 132 
PAN 2011 | 2,920 | 88,977 | 1,360 
Amazon Product Reviews | 6,000 | 23,235 | 2,603 
Conference papers | 35 | 1,304 | 272 

> <b>More statistics and explanations on this corpus coming soon, stay tuned!</b>

### References, tools used and existing collections

1.	Philipp Koehn (2005). <br/>
	Europarl: A Parallel Corpus for Statistical Machine Translation. <br/>
	<i>In Conference Proceedings: the tenth Machine Translation Summit, pages 79–86. AAMT.<br/>
	url: http://opus.lingfil.uu.se/Europarl.php </i> 
	
2.	Martin Potthast, Alberto Barrón-Cedeño, Benno Stein, and Paolo Rosso (2011). <br/>
	Cross-Language Plagiarism Detection.<br/>
	<i>In Language Ressources and Evaluation, volume 45, pages 45–62.<br/>
	url: http://users.dsic.upv.es/grupos/nle/downloads.html </i> 

3.	Martin Potthast, Benno Stein, Alberto Barrón-Cedeño, and Paolo Rosso (2010). <br/>
	An Evaluation Framework for Plagiarism Detection. <br/>
	<i>In Proceedings of the 23rd International Conference on Computational Linguistics (COLING 2010), Beijing,
China, August 2010. Association for Computational Linguistics. <br/>
	url: http://www.uni-weimar.de/en/media/chairs/webis/corpora/pan-pc-11/ </i> 
	
4.	Peter Prettenhofer and Benno Stein (2010). <br/>
	Cross-language text classification using structural correspondence learning. <br/>
	<i>In Proceedings of the 48th Annual Meeting of the Association for Computational Linguistics (ACL), pages 1118-1127. <br/>
	url: http://www.uni-weimar.de/en/media/chairs/webis/corpora/corpus-webis-cls-10/ </i>
	
5.	Florian Boudin (2013). <br/>
	TALN Archives : a digital archive of French research articles in Natural Language Processing (TALN Archives : une archive numérique francophone des articles de recherche en Traitement Automatique de la Langue) [in French]). <br/>
	<i>In Proceedings of TALN 2013 (Volume 2: Short Papers), pages 507–514. <br/>
	url: https://github.com/boudinfl/taln-archives </i> 

6.	Helmut Schmid (1994). <br/>
	Probabilistic Part-of-Speech Tagging Using Decision Trees. <br/>
	<i>In Proceedings of the International Conference on New Methods in Language Processing. <br/>
	url: http://www.cis.uni-muenchen.de/~schmid/tools/TreeTagger/ </i> 

7.	Gilles Sérasset (2014). <br/>
	DBnary: Wiktionary as a Lemon-Based Multilingual Lexical Resource in RDF. <br/>
	<i>In to appear in Semantic Web Journal (special issue on Multilin- gual Linked Open Data). <br/>
	url: http://kaiko.getalp.org/about-dbnary/ </i> 

8.	Dániel Varga, Péter Hálacsy, Viktor Nagy, Lázló Németh, András Kornai, and Viktor Trón (2005). <br/>
	Parallel corpora for medium density languages. <br/>
	<i>In Recent Advances in Natural Language Processing (RANLP 2005), pages 590–596. <br/>
	url: http://mokk.bme.hu/resources/hunalign/ </i> 

### Licence
<a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
