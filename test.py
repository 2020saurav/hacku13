import cv
import cv2
import os
import glob
import time
from stat import *

from PIL import Image


images =  glob.glob("*.JPG")
for filename in images:
    
    im = Image.open(filename)
    pix=im.load()
    p,q=im.size
    sumr=0
    sumb=0
    sumg=0
    sumbl=0
    sumw=0
    for i in range(p):
        for j in range(q):
            r,g,b=pix[i,j]
            if(b>=210 and r>=210 and g>=210):
                sumw=sumw+1
            elif(b<=40 and r<=40 and g<=40):
                sumbl=sumbl+1
            else:
                if(r>=g and r>=b):
                   sumr=sumr+1
                elif(g>=r and g>=b):
                   sumg=sumg+1
                elif(b>=r and b>=g):
                   sumb=sumb+1


    im.save("tempz.png")
    st = os.stat(filename)

    img = cv2.imread("tempz.png",0)
    hc = cv2.CascadeClassifier("/home/saurav/opencv-2.4.5/data/lbpcascades/lbpcascade_frontalface.xml")

    faces = hc.detectMultiScale(img)
    t= (sumr+sumg+sumb+sumbl+sumw)/100
    print (filename,len(faces),st[ST_SIZE]/1024, (sumr/t,sumg/t,sumb/t,sumw/t,sumbl/t),time.asctime(time.localtime(st[ST_MTIME])))

    
  
