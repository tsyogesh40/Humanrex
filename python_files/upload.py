from datetime import date,datetime,timedelta
import serial, time, datetime
import struct           #Convert between strings and binary data
import sys
import os
import binascii
import pymysql

try:
        ser = serial.Serial('/dev/ttyUSB0',57600,timeout=1)      # serial communication in Linux
#ser = ses
except:
        print("....port detecting...")
        ser= serial.Serial('/dev/ttyUSB1',57600,timeout=1)
pack = [0xef01, 0xffffffff, 0x1]        # Header, Address and Package Identifier


        
def readPacket():       # Function to read the Acknowledge packet
        time.sleep(1)
        w = ser.inWaiting()
        ret = []
        if w >= 9:
                s = ser.read(9)         # Partial read to get length
                ret.extend(struct.unpack('!HIBH', s))
                ln = ret[-1]

                time.sleep(1)
                w = ser.inWaiting()
                if w >= ln:
                        s = ser.read(ln)
                        form = '!' + 'B' * (ln - 2) + 'H'       # Specifying byte size
                        ret.extend(struct.unpack(form, s))
        return ret


def readPacket1():      # Function to read the Acknowledge packet
        time.sleep(1)
        print ("Processing...Please wait")
        w = ser.inWaiting()
        ret = []
        print ("----------------")
        form = 'B' * 546
        s = ser.read(700)
        #print ("len_S =",len(s))
        t=binascii.hexlify(s)   # convert to hex
        u=t[24:]
        ##DB connection##
        try:
                cnx=pymysql.connect(user='yoges',password='',host='172.16.3.57',database='Humanrexx1')       # connect to MySql database
                if cnx:
                        print ("Server DB connected")
                        flag=1
        except:
                flag=0
                cnx=pymysql.connect(user='root',password='root',host='127.0.0.1',database='admin_panel')       # connect to MySql database
                if cnx:
                    print ("localhost connected")
        cur=cnx.cursor()
        name=''

        try:
           if(flag!=0):
                   sql="INSERT INTO fingerdb values(%s,%s)"
                   result=cur.execute(sql,(name,u))  #update server database
           else :
                   #Fetching staff details
                   sql_details="Select name,store_id,staff_id from staff_details where staff_id=%s"
                   result_details=cur.execute(sql_details,(staffid))
                   row=cur.fetchone()
                   name=row[0]
                   storeid=row[1]
                   staff_id=row[2]

                   ##Inserting fingerprint datas 
                   sql="INSERT INTO fingerprint_details (name,staff_id,store_id,finger_name,finger_code,finger_print) values (%s,%s,%s,%s,%s,%s)"
                   result=cur.execute(sql,(name,staff_id,storeid,finger_nm,finger_code,u))  #update database
                   print ('Hello!',name,'Your',finger_nm,' FingerPrint is Updated successfully ')
                   cnx.commit()

                       
        except Exception as ex:
            print ("rollback")
            print (ex)
            cnx.rollback()
            
        #Closing connection
        cnx.close()

        v=binascii.unhexlify(u)
        #print ("len _V=",len(v))
        form1='B'*534
        ret1=[]
        ret1.extend(struct.unpack(form1, v))
        ret.extend(struct.unpack(form, s))

       
def writePacket(data):          # Function to write the Command Packet
        pack2 = pack + [(len(data) + 2)]
        a = sum(pack2[-2:] + data)
        pack_str = '!HIBH' + 'B' * len(data) + 'H'
        l = pack2 + data + [a]
        s = struct.pack(pack_str, *l)
        ser.write(s)


def verifyFinger():     # Verify Module?s handshaking password
        data = [0x13, 0x0, 0, 0, 0]
        writePacket(data)
        s = readPacket()
        return s[4]

def genImg():   # Detecting finger and store the detected finger image in ImageBuffer
        data = [0x1]
        writePacket(data)
        s = readPacket()
        return s[4]

def img2Tz(buf):        # Generate character file from the original finger image in ImageBuffer and store the file in CharBuffer1 or CharBuffer2.
        data = [0x2, buf]
        writePacket(data)
        s = readPacket()
        return s[4]

def regModel():         # Combine information of character files from CharBuffer1 and CharBuffer2 and generate a template which is stroed back in both CharBuffer1 and CharBuffer2.
        data = [0x5]
        writePacket(data)
        s = readPacket()
        return s[4]

def UpChar(buf):        # Upload the character file or template of CharBuffer1/CharBuffer2 to upper computer
        data = [0x8,buf]
        writePacket(data)
        s = readPacket1()

print ("Type done to exit")
staffid=input("Enter Your Staff ID:")

while (staffid!='done'):
        print('1.LEFT_THUMB\t','2. RIGHT_THUMB\t','3. LEFT_INDEX\n','4. RIGHT_INDEX\t','5.LEFT_MID\t','6.RIGHT_MID\t')
        print("Select finger(1 to 6):")
        fno=int(input("Enter the Finger no:"))
        if fno==1:
                finger_nm="LEFT_THUMB"
                finger_code="LT"
        elif fno==2:
                finger_nm="RIGHT_THUMB"
                finger_code="RT"
        elif fno==3:
                finger_nm="LEFT_INDEX"
                finger_code="LI"
        elif fno==4:
                finger_nm="RIGHT_INDEX"
                finger_code="RI"
        elif fno==5:
                finger_nm="LEFT_MID"
                finger_code="LM"
        elif fno==6:
                finger_nm="RIGHT_MID"
                finger_code="RM"

        if verifyFinger():
                print ('Verification Error')
                sys.exit(0)

        print ('Insert Your',finger_nm)
        sys.stdout.flush()
       # time.sleep(1)
        while genImg():
                time.sleep(0.1)
                print ('Holdon Your Finger...')
                sys.stdout.flush()

        print ('')
        sys.stdout.flush()

        if img2Tz(1):
                print ('Conversion Error')
                sys.exit(0)

        print ('Insert Your',finger_nm,'again')
        sys.stdout.flush()

        #time.sleep(1)
        while genImg():
                time.sleep(0.1)
                print ('Holdon Your Finger...')
                sys.stdout.flush()

        print ('')
        sys.stdout.flush()

        if img2Tz(2):
                print ('Conversion Error')
                sys.exit(0)
        
        if regModel():
                print ('Template Error')
                sys.exit(0)

        if UpChar(2):
                print ('Template Error')
                sys.exit(0)

        staffid=input("Enter Your Staff ID:")
