# Created by Nick Snyder

import sys
import pprint
import MySQLdb

# id, geom, "OBJECTID", "CODIGO", "CODIGO_ANTERIOR", "SHAPE.AREA", "SHAPE.LEN", wkt

f = open('terreno.data', 'r')

i = 0

list_of_obj = []

# Create Objects for construccion
for line in f:
  obj = {'id': int(line.split('\t')[0])}
  obj['geom'] = str(line.split('\t')[1])
  obj['OBJECTID'] = int(line.split('\t')[2])
  obj['CODIGO'] = line.split('\t')[3]
  obj['CODIGO_ANTERIOR'] = line.split('\t')[4]
  obj['SHAPEAREA'] = float(line.split('\t')[5])
  obj['SHAPELEN'] = float(line.split('\t')[6])
  obj['wkt'] = line.split('\t')[7]

  list_of_obj.append(obj)
  #i += 1
 # print 'On object: %d' % i

pprint.pprint(list_of_obj[0])
print '\n\n'
#pprint.pprint(list_of_obj[1])
#print '\n\n'
#print len(list_of_obj)


# Load objects into db
#print "id - %d" % (list_of_obj[0])
#sys.exit()


db = MySQLdb.connect(host="backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com",user="Backend431",port=4310,passwd="Backend431pass",db="backend431")
cur = db.cursor()
counter = 0
for obj in list_of_obj:
  sql = """
INSERT INTO terreno 
    (id, geom, OBJECTID, CODIGO, CODIGO_ANTERIOR, SHAPEAREA, SHAPELEN, wkt)
    VALUES (%d, '%s', %d, '%s', '%s', %f, %f, '%s')""" % (obj['id'], obj['geom'], obj['OBJECTID'], obj['CODIGO'], obj['CODIGO_ANTERIOR'], obj['SHAPEAREA'], obj['SHAPELEN'], obj['wkt'])

  try:
    cur.execute(sql)
    db.commit()
    print 'completed: %d' % (counter)
  except:
    db.rollback()

  counter += 1

db.close()  





