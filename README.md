# A multilingual, multi-style and multi-granularity dataset for cross-language textual similarity detection

* In the Aligned_Documents_Sub_Corpus/ directory, you can find the dataset of parallel and comparable files aligned at document-level (one file represents one document).<br/>
* In the Aligned_Sentences_Sub_Corpus/ directory, you can find the dataset of parallel and comparable files aligned at sentence-level (a line of a file represents one sentence).<br/>
* In the Aligned_Chunks_Sub_Corpus/ directory, you can find the dataset of parallel and comparable files aligned at chunk-level (a line of a file represents one noun chunk).<br/>
* In the tools/ directory, you can find all the useful files to re-create the dataset.

## Characteristics

Sub-corpus | Alignment | Authors | Translations | Translators | Alteration
--- | --- | ---| --- | ---| ---
JRC Acquis | Parallel | Politicians | Human | Professional | No
Europarl | Parallel | Politicians | Human | Professional | No
Wikipedia | Comparable | Anyone | - | - | Noise
PAN 2011 (Gutenberg Project) |  Parallel |  Professional authors | Human | Professional | Yes
Amazon Product Reviews | Parallel | Anyone | Machine | Google Translate | No
Conference papers | Comparable | Computer scientists | Human | Computer scientists | Noise
