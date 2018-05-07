# Created by Nick Snyder

import sys
import pprint
import MySQLdb

#  id, geom, OBJECTID, CODIGO, TERRENO_CODIGO, TIPO_CONSTRUCCION, TIPO_DOMINIO, NUMERO_PISOS, NUMERO_SOTANOS, NUMERO_MEZANINES, NUMERO_SEMISOTANOS, ETIQUETA, IDENTIFICADOR, CODIGO_EDIFICACION, CODIGO_ANTERIOR, SHAPE.AREA, SHAPE.LEN, wkt
f = open('construccion.data', 'r')

i = 0

list_of_obj = []

# Create Objects for construccion
for line in f:
  obj = {'id': int(line.split('\t')[0])}
  obj['geom'] = str(line.split('\t')[1])
  obj['OBJECTID'] = int(line.split('\t')[2])
  obj['CODIGO'] = line.split('\t')[3]
  obj['TERRENO_CODIGO'] = line.split('\t')[4]
  obj['TIPO_CONSTRUCCION'] = line.split('\t')[5]
  obj['TIPO_DOMINIO'] = line.split('\t')[6]
  obj['NUMERO_PISOS'] = int(line.split('\t')[7])
  obj['NUMERO_SOTANOS'] = int(line.split('\t')[8])
  obj['NUMERO_MEZANINES'] = int(line.split('\t')[9])
  obj['NUMERO_SEMISOTANOS'] = int(line.split('\t')[10])
  obj['ETIQUETA'] = line.split('\t')[11]
  obj['IDENTIFICADOR'] = line.split('\t')[12]
  obj['CODIGO_EDIFICACION'] = line.split('\t')[13]
  obj['CODIGO_ANTERIOR'] = line.split('\t')[14]
  obj['SHAPEAREA'] = float(line.split('\t')[15])
  obj['SHAPELEN'] = float(line.split('\t')[16])
  obj['wkt'] = line.split('\t')[17]

  list_of_obj.append(obj)
  #i += 1
 # print 'On object: %d' % i

pprint.pprint(list_of_obj[0])
print '\n\n'
#pprint.pprint(list_of_obj[1])
#print '\n\n'
#print len(list_of_obj)

#VALUES (%d, %s, %d, %s, %s, %s, %s, %d, %d, %d, %d, %s, %s, %s, %s, %d, %d, %s)"

# Load objects into db
#print "id - %d" % (list_of_obj[0]['OBJECTID'])
#sys.exit()


db = MySQLdb.connect(host="backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com",user="Backend431",port=4310,passwd="Backend431pass",db="backend431")
cur = db.cursor()
counter = 0
for obj in list_of_obj:
  if counter == 0:
    print 'skipping 1st one'
  else:
    sql = """
INSERT INTO construccion 
    (id, geom, OBJECTID, CODIGO, TERRENO_CODIGO, TIPO_CONSTRUCCION, TIPO_DOMINIO, NUMERO_PISOS, NUMERO_SOTANOS, NUMERO_MEZANINES, NUMERO_SEMISOTANOS, ETIQUETA, IDENTIFICADOR, CODIGO_EDIFICACION, CODIGO_ANTERIOR, SHAPEAREA, SHAPELEN, wkt)
    VALUES (%d, '%s', %d, '%s', '%s', '%s', '%s', %d, %d, %d, %d, '%s', '%s', '%s', '%s', %f, %f, '%s')""" % (obj['id'], obj['geom'], obj['OBJECTID'], obj['CODIGO'], obj['TERRENO_CODIGO'], obj['TIPO_CONSTRUCCION'], obj['TIPO_DOMINIO'], obj['NUMERO_PISOS'], obj['NUMERO_SOTANOS'], obj['NUMERO_MEZANINES'], obj['NUMERO_SEMISOTANOS'], obj['ETIQUETA'], obj['IDENTIFICADOR'], obj['CODIGO_EDIFICACION'], obj['CODIGO_ANTERIOR'], obj['SHAPEAREA'], obj['SHAPELEN'], obj['wkt'])

  try:
    cur.execute(sql)
    db.commit()
    print 'completed: %d' % (counter)
  except:
    db.rollback()

  counter += 1

db.close()  





