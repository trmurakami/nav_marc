#!/bin/bash
#catmandu import MARC --type ALEPHSEQ to MongoDB  --fix ../fixes/fixes.txt --database_name sibi --bag producao < ../data/prodeca.seq
rm ../data/records.json
catmandu convert MARC --type ALEPHSEQ to JSON < $1 --fix ../fixes/fixes.txt >> ../data/records.json
#catmandu import JSON to MongoDB --database_name sibi --bag producao < ../data/records.json
mongoimport --db sibi --collection producao --file ../data/records.json --batchSize 1 --upsert --jsonArray
