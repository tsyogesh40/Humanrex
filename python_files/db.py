import pymysql
import datetime
from datetime import timedelta
import time
import re
cnx=pymysql.connect(user='root',password='root',host='localhost',database='Humanrexx')
if cnx:
        print('localhost connected')
cur=cnx.cursor()

#staffid=input("Enter the staffid")
t=datetime.datetime.now()
time_24=t.strftime("%H:%M:%S") #24 Hrs time
print('Time= ',time_24)

h=t.strftime("%H")
m=t.strftime("%M")
s=t.strftime("%S")

time_delta=timedelta(hours=int(h),minutes=int(m),seconds=int(s))

date=t.strftime("%Y-%m-%d")

try:
    sql="select in_time,out_time from default_time where cadre=%s"
    result=cur.execute(sql,('T'))
    row=cur.fetchone()
    #for r in row:
    print(row[0])
    print(row[1])
    print(type(row[0]))
    print(type(time_24))
    if(row[0] > time_delta):
            print(row[0])
    else:
            print(time_delta)
    
except Exception as ex:
    print(ex)
