#create index
db.producao.createIndex({title:"text",authors:"text",subject:"text",evento:"text",ispartof:"text"},{language_override:"pt",weights:{title: 10,autor: 9,subject:9,evento:2,ispartof:2},name:"TextIndex"})
