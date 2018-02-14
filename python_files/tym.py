import datetime

t=datetime.datetime.now()
#date format

weekday=t.strftime("%a") # %A for abbr
day=t.strftime("%d")
month=t.strftime("%b")  #%B for abbr
month_num=t.strftime("%m") 
year=t.strftime("%Y")

date=t.strftime("%Y-%m-%d")
print(date)

#time format

hour_12=t.strftime("%I")
hour_24=t.strftime("%H")
minutes=t.strftime("%H")
seconds=t.strftime("%S")
am_pm=t.strftime("%p")

time_12=t.strftime("%I:%M:%S %p") #12hrs time AM/PM

time_24=t.strftime("%H:%M:%S") #24 Hrs time

print(time_12)
print(time_24)

def sem_calc(month):
    if(month>=1 & month<6):
        return "odd"
    else:
        return "even"

def date():
    t=datetime.datetime.now()
    time_12=t.strftime("%I:%M:%S %p") #12hrs time AM/PM
    return time_12

print(sem_calc(int(month_num)))

print(date())
