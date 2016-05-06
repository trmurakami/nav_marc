#!/bin/bash
#catmandu import MARC --type ALEPHSEQ to MongoDB  --fix ../fixes/fixes.txt --database_name sibi --bag producao < ../data/prodeca.seq
rm ../data/records.json
rm ../data/records.seq
sort $1 > ../data/records.seq
catmandu convert MARC --type ALEPHSEQ to JSON --line_delimited 1 < ../data/records.seq --fix ../fixes/fixes.txt >> ../data/records.json
#catmandu import JSON to MongoDB --database_name sibi --bag producao < ../data/records.json
mongoimport --db sibi --collection producao --file ../data/records.json --batchSize 1 --upsert #--jsonArray
