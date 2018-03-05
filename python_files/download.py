import serial, time, datetime, struct
import sys
import os
import pymysql
import binascii

cnx=pymysql.connect(user='root',password='root',host='localhost',database='admin_panel')
if cnx:
        print('localhost connected')
cur=cnx.cursor()

try:
        ser = serial.Serial('/dev/ttyUSB0',57600,timeout=1)
except:
        ser=serial.Serial('/dev/ttyUSB1',57600,timeout=1)
pack = [0xef01, 0xffffffff, 0x1]

def readPacket():
	time.sleep(1)
	w = ser.inWaiting()
	ret = []
	if w >= 9:
		s = ser.read(9) #partial read to get length
		ret.extend(struct.unpack('!HIBH', s))
		ln = ret[-1]
		
		time.sleep(1)
		w = ser.inWaiting()
		if w >= ln:
			s = ser.read(ln)
			form = '!' + 'B' * (ln - 2) + 'H'
			ret.extend(struct.unpack(form, s))
			print (ret)
			
	return ret

def readPacket1():
        
        time.sleep(1)
        w = ser.inWaiting()
        print (w)
        time.sleep(1)
        pack_str='B'* 534
                
        try:
            sql="select finger_print from fingerprint_details where staff_id=%s and finger_code=%s"
            result=cur.execute(sql,(staffid,finger_code))
            if result:
                    print("Fetched")
            row=cur.fetchone()
        except Exception as ex:
                print ("DB Exception")
                print (ex)
        srow=str(row[0])
        #print (type(row))
        #print (srow)
        #print 'row is ',type(srow)
        v=binascii.unhexlify(srow)
        #print ('v is',v)
        #print ('v_len is',len(v))
        form1='B'* 534
        ret1=[]
        ret1.extend(struct.unpack(form1, v))
        x=ret1
       # print (x)
        s = struct.pack(pack_str, *x)
        ser.write(s)
        if store(storeid):
                print ('store error')
                sys.exit(0)
                print ("Enrolled successfully at id %d",j)	
                        
                
	
##	ret = []
##	form = 'B' * 700
##	s = ser.read(700)
##	ret.extend(struct.unpack(form, s))
##	print (ret)
##	j=ret.strip()   # Doesn't work
##	print (j)

def writePacket(data):
	pack2 = pack + [(len(data) + 2)]
	a = sum(pack2[-2:] + data)
	pack_str = '!HIBH' + 'B' * len(data) + 'H'
	l = pack2 + data + [a]
	s = struct.pack(pack_str, *l)
	ser.write(s)


def verifyFinger():
	data = [0x13, 0x0, 0, 0, 0]
	writePacket(data)
	s = readPacket()
	return s[4]
	
def genImg():
	data = [0x1]
	writePacket(data)
	s = readPacket()
	return s[4]	

def img2Tz(buf):
	data = [0x2, buf]
	writePacket(data)
	s = readPacket()
	return s[4]

def regModel():
	data = [0x5]
	writePacket(data)
	s = readPacket()
	return s[4]
def UpChar(buf):
	data = [0x8,buf]
	writePacket(data)
	s = readPacket1()
##	return s[4]

def DownChar(buf):
	data = [0x9,buf]
	writePacket(data)
	s = readPacket1()

def store(id):
	data = [0x6, 0x1, 0x0, id]
	writePacket(data)
	s = readPacket()
	return s[4]	

staffid=input('enter the staff ID:\t')
print (type(staffid))
finger_code=input('enter the finger code:\t')
#idno=int(input('enter the store id'))
#print (type(idno))
try :
        sql="SELECT store_id from fingerprint_details where staff_id=%s and finger_code=%s"
        res=cur.execute(sql,(staffid,finger_code))
        #cnx.commit()
        row=cur.fetchone()
        storeid=row[0]
        print('Store ID= ',storeid)
except Exception as ex:
        print("exception")
        print(ex)        

if verifyFinger():              # if password is correct zero gets returned , else a non zero value (13H) gets returned and 'Verification Error' gets printed
	print ('Verification Error')
	sys.exit(0)

if DownChar(1):
        print ('Template Error')
        sys.exit(0)

