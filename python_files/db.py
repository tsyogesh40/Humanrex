import pymysql
import datetime
from datetime import timedelta
import time
import re
cnx=pymysql.connect(user='root',password='root',host='localhost',database='admin_panel')
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

staffid='IT05'
date='2018-03-05'
try:
    sql_tym="select in_time, out_time,p_value from temp_entry where staff_id=%s and date=%s"
    res_tym=cur.execute(sql_tym,(staffid,date))
    data=cur.fetchone()
    in_time=data[0]
    out_time=data[1]
    count=data[2]
    diff=out_time-in_time
    print(diff)
    #p_value is incremented when working hours is more than 7:45 hrs
    if str(diff)>='3:00:00' and str(diff)< '7:00:00':
            p_value=count
    elif str(diff)>='7:00:00':
            p_value=count+1

    print(p_value)            
except Exception as ex:
    print(ex)
