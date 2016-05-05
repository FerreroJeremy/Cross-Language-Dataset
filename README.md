# Cross-Language Dataset

### Description

<b>This dataset is a multilingual, multi-style and multi-granularity dataset for cross-language textual similarity detection</b>. 
More precisely, the characteristics of this dataset are the following:
* it is multilingual: <b>French</b>, <b>English</b> and <b>Spanish</b>;
* it proposes cross-language alignment information at
different granularities: <b>document</b>-level, <b>sentence</b>-level
and <b>chunk</b>-level;
* it is based on both <b>parallel</b> and <b>comparable</b> corpora;
* it contains both <b>human and machine translated text</b>;
* part of it has been <b>altered</b> (to make the cross-language
similarity detection more complicated) while the rest
remains <b>without noise</b>;
* documents were <b>written by multiple types of authors</b>:
from average to professionals.

##### Scientific paper

A description of the dataset and its building are described in the following paper:

<i><a href="https://www.researchgate.net/publication/301861882_A_Multilingual_Multi-Style_and_Multi-Granularity_Dataset_for_Cross-Language_Textual_Similarity_Detection">A Multilingual, Multi-Style and Multi-Granularity Dataset for Cross-Language Textual Similarity Detection. Jérémy Ferrero, Frédéric Agnès, Laurent Besacier and Didier Schwab. In the 10th edition of the Language Resources and Evaluation Conference (LREC 2016).</a></i>

### Characteristics

Sub-corpus | Alignment | Authors | Translations | Translators | Alteration | NE (%)
--- | --- | --- | --- | --- | --- | --- |
JRC Acquis<sup>2</sup> | Parallel | Politicians | Human | Professional | No | 3.74
Europarl<sup>1</sup> | Parallel | Politicians | Human | Professional | No | 7.74
Wikipedia<sup>2</sup> | Comparable | Anyone | - | - | Noise | 8.37
PAN-PC-11<sup>3</sup> |  Parallel |  Professional authors | Human | Professional | Yes | 3.24
APR (Amazon Product Reviews<sup>4</sup>) | Parallel | Anyone | Machine | Google Translate | No | 6.04
Conference papers | Comparable | Computer scientists | Human | Computer scientists | Noise | 9.36

### Statistics

Sub-corpus | # Aligned documents | # Aligned sentences | # Aligned noun chunks
--- | --- | ---| ---
JRC-Acquis<sup>2</sup> | 10,000 | 149,506 | 10,094 
Europarl<sup>1</sup> | 9,431 | 475,834 | 25,603 
Wikipedia<sup>2</sup> | 10,000 | 4,792 | 132 
PAN-PC-11<sup>3</sup> | 2,920 | 88,977 | 1,360 
APR (Amazon Product Reviews<sup>4</sup>) | 6,000 | 23,235 | 2,603 
Conference papers | 35 | 1,304 | 272 

For more statistics, see the <i>stats/</i> directory.

### Repository description

* In the <i>dataset/documents/</i> directory, you can find the dataset of parallel and comparable files aligned at document-level (one file represents one document).
* In the <i>dataset/sentences/</i> directory, you can find the dataset of parallel and comparable files aligned at sentence-level (one line of a file represents one sentence).
* In the <i>dataset/chunks/</i> directory, you can find the dataset of parallel and comparable files aligned at chunk-level (one line of a file represents one noun chunk).
* In the <i>stats/</i> directory, you can find the XLSX file with statistics on the dataset.
* In the <i>scripts/</i> directory, you can find all the useful files to re-build the dataset from the pre-existing corpora.
* In the <i>docs/</i> directory, you can find the previously mentioned LREC paper.
* In the <i>dataset/documents/Conference_papers/</i> directory, you can also find a <i>pdf_conference_papers/</i> directory containing the original scientific papers in PDF format.
* In the <i>dataset/*/PAN11/</i> sub-directories, you can also find a <i>metadata/</i> directory containing additional information about the PAN-PC-11 alignments.

##### Scripts directory

This directory contains scripts that we used for corpus building. We also provide them in case somebody would be interested to extend the corpus.
* In the <i>scripts/chunking/</i> directory, you can find a script to extract noun chunks from a POS sequence from <i>TreeTagger</i><sup>5</sup>.<br/>
* In the <i>scripts/create_translations_dico/</i> directory, you can find a script to build an unigram translation dictionary for the use of <i>HunAlign<sup>6</sup></i>.<br/>
* In the <i>scripts/create_verif_align/</i> directory, you can find a script to print and save the alignments in a readable format.<br/>
* In the <i>scripts/enrich_dico_with_dbnary/</i> directory, you can find a script to enrich an unigram translation dictionary with <i>DBNary</i><sup>7</sup> entries.<br/>
* In the <i>scripts/parse_APR_collection/</i> directory, you can find a script to parse the <i>Webis-CLS-10<sup>4</sup></i> corpus and extract the English-French pairs.<br/>
* In the <i>scripts/parse_PAN_collection/</i> directory, you can find a script to parse the <i>PAN-PC-11<sup>3</sup></i> corpus and extract the English-Spanish pairs with metadata.<br/>
* In the <i>scripts/parse_conf_papers_bibtex/</i> directory, you can find a script to parse the <i>TALN BibTeX<sup>8</sup></i>, crawl the web and thus allow the construction of French-English conference paper pairs.<br/>

To manage the encoding of the files, we use the <i>ForceUTF8<sup>9</sup></i> class coded by Sebastián Grignoli.<br/>
To detect the language of a text, we use the PHP implementation<sup>10</sup> by Nicholas Pisarro of the Cavnar and Trenkle (1994)<sup>11</sup> classification algorithm.<br/>
To query <i>DBNary<sup>7</sup></i>, we use PHP class-interfaces<sup>12</sup>.

If you have additional questions, please send it to me by email at jeremy.ferrero@imag.fr.

### References, tools used and pre-existing collections

1.	<b>Europarl</b><br/>
	Philipp Koehn (2005). <br/>
	Europarl: A Parallel Corpus for Statistical Machine Translation. <br/>
	<i>In Conference Proceedings: the tenth Machine Translation Summit, pages 79–86. AAMT.<br/>
	url: http://opus.lingfil.uu.se/Europarl.php </i> 
	
2.	<b>CL-PL-09 (JRC-Acquis + Wikipedia)</b><br/>
	Martin Potthast, Alberto Barrón-Cedeño, Benno Stein, and Paolo Rosso (2011). <br/>
	Cross-Language Plagiarism Detection.<br/>
	<i>In Language Ressources and Evaluation, volume 45, pages 45–62.<br/>
	url: http://users.dsic.upv.es/grupos/nle/downloads.html </i> 

3.	<b>PAN-PC-11</b><br/>
	Martin Potthast, Benno Stein, Alberto Barrón-Cedeño, and Paolo Rosso (2010). <br/>
	An Evaluation Framework for Plagiarism Detection. <br/>
	<i>In Proceedings of the 23rd International Conference on Computational Linguistics (COLING 2010), Beijing,
China, August 2010. Association for Computational Linguistics. <br/>
	url: http://www.uni-weimar.de/en/media/chairs/webis/corpora/pan-pc-11/ </i> 
	
4.	<b>Webis-CLS-10 (Amazon Product Reviews)</b><br/>
	Peter Prettenhofer and Benno Stein (2010). <br/>
	Cross-language text classification using structural correspondence learning. <br/>
	<i>In Proceedings of the 48th Annual Meeting of the Association for Computational Linguistics (ACL), pages 1118-1127. <br/>
	url: http://www.uni-weimar.de/en/media/chairs/webis/corpora/corpus-webis-cls-10/ </i>

5.	<b>TreeTagger</b><br/>
	Helmut Schmid (1994). <br/>
	Probabilistic Part-of-Speech Tagging Using Decision Trees. <br/>
	<i>In Proceedings of the International Conference on New Methods in Language Processing. <br/>
	url: http://www.cis.uni-muenchen.de/~schmid/tools/TreeTagger/ </i> 

6.	<b>HunAlign</b><br/>
	Dániel Varga, Péter Hálacsy, Viktor Nagy, Lázló Németh, András Kornai, and Viktor Trón (2005). <br/>
	Parallel corpora for medium density languages. <br/>
	<i>In Recent Advances in Natural Language Processing (RANLP 2005), pages 590–596. <br/>
	url: http://mokk.bme.hu/en/resources/hunalign/ <br/>
	licence: GNU LGPL version 2.1 or later</i> 

7.	<b>DBNary</b><br/>
	Gilles Sérasset (2014). <br/>
	DBnary: Wiktionary as a Lemon-Based Multilingual Lexical Resource in RDF. <br/>
	<i>In to appear in Semantic Web Journal (special issue on Multilin- gual Linked Open Data). <br/>
	url: http://kaiko.getalp.org/about-dbnary/ <br/>
	licence: Creative Commons Attribution-ShareAlike 3.0 </i> 

8.	<b>TALN Archives</b><br/>
	Florian Boudin (2013). <br/>
	TALN Archives : a digital archive of French research articles in Natural Language Processing (TALN Archives : une archive numérique francophone des articles de recherche en Traitement Automatique de la Langue) [in French]). <br/>
	<i>In Proceedings of TALN 2013 (Volume 2: Short Papers), pages 507–514. <br/>
	url: https://github.com/boudinfl/taln-archives <br/>
	licence: Creative Commons Attribution-NonCommercial 3.0 </i> 

9.	<b>ForceUTF8</b> <br/>
	<i>url: https://github.com/neitanod/forceutf8 <br/>
	licence: BSD </i>

10.	<b>Text Language Detect</b> <br/>
	<i>url: https://github.com/webmil/text-language-detect <br/>
	licence: BSD </i>

11.	William B. Cavnar and John M. Trenkle (1994). <br/>
	N-Gram-Based Text Categorization. <br/>
	<i>In Proceedings of SDAIR- 94, 3rd Annual Symposium on Document Analysis and Information Retrieval, pages 161–175.</i>

12.	<b>DBNary PHP Interface</b> <br/>
	<i>url: https://github.com/FerreroJeremy/DBNary-PHP-Interface <br/>
	licence: Creative Commons Attribution-ShareAlike 4.0 International </i>

### Credit

When you use this dataset, please cite:
```
@inproceedings{CrossLanguageDatasetLREC2016,
  TITLE = {{A Multilingual, Multi-Style and Multi-Granularity Dataset for Cross-Language Textual Similarity Detection}},
  AUTHOR = {J{\'e}r{\'e}my Ferrero and Fr{\'e}d{\'e}ric Agn{\`e}s and Laurent Besacier and Didier Schwab},
  BOOKTITLE = {{The 10th edition of the Language Resources and Evaluation Conference (LREC 2016)}},
  ADDRESS = {Portoro{\v z}, Slovenia},
  YEAR = {2016},
  MONTH = May,
  KEYWORDS = {Cross-language plagiarism detection ; Dataset ; Cross-language dataset ; Cross-language similarity detection ; Evaluation},
}
```

### <img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png" /> License

This dataset is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.<br />

<b>For more details on licenses of every tools used and existing collections, refer to <a rel="license" href="https://github.com/FerreroJeremy/Cross-Language-Dataset/blob/master/LICENSE.md">LICENSE.md</a>. </b>
