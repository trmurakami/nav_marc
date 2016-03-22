#!/bin/bash
#catmandu import MARC --type ALEPHSEQ to MongoDB  --fix ../fixes/fixes.txt --database_name sibi --bag producao < ../data/prodeca.seq

catmandu convert MARC --type ALEPHSEQ to JSON < $1 --fix ../fixes/fixes.txt >> records.json
catmandu import JSON to MongoDB --database_name sibi --bag producao < records.json
