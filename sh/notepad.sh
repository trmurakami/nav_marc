#create index
db.iusdata.createIndex({title:"text",authors:"text",subject:"text",evento:"text",ispartof:"text"},{language_override:"pt",weights:{title: 10,autor: 9,subject:9,evento:2,ispartof:2},name:"TextIndex"})
#fields index
db.iusdata.createIndex( { type: 1 } )
db.iusdata.createIndex( { departamentoFD: 1 } )
db.iusdata.createIndex( { subject: 1 } )
db.iusdata.createIndex( { authors: 1 } )
db.iusdata.createIndex( { issn_part: 1 } )
db.iusdata.createIndex( { ispartof: 1 } )
db.iusdata.createIndex( { year: 1 } )
db.iusdata.createIndex( { paginacao: 1 } )
db.iusdata.createIndex( { volume: 1 } )
db.iusdata.createIndex( { numeracao: 1 } )
db.iusdata.createIndex( { mes: 1 } )
db.iusdata.createIndex( { language: 1 } )
db.iusdata.createIndex( { revisado: 1 } )
db.iusdata.createIndex( { producao: 1 } )



db.iusdata.update({}, {$set : {"type":"ARTIGO DE PERIODICO"}}, {upsert:false, multi:true})


#mongoexport --db sibi --collection producao --type=csv --fields _id,colab_instituicao_trab --query '{ year: { $gte: "2010", $lte: "2015" } }' --out ../data/colab_instituicao.csv

#mongoexport --db sibi --collection producao --type=csv --fields _id,colab_instituicao_corrigido --query '{ colab_instituicao_corrigido: { $exists: true } }' --out ../data/colab_instituicao_corrigido.csv


mongoexport --db sibi --collection producao --fields _id,colab_instituicao_trab --query '{ colab_instituicao_trab: { $exists: true } }' --out ../data/colab_instituicao.json


mongoexport --db sibi --collection producao --fields _id,colab_instituicao_corrigido --query '{ colab_instituicao_corrigido: { $exists: true } }' --out ../data/colab_instituicao_corrigido.json
