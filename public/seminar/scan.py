import pytesseract
import cv2
import matplotlib.pyplot as plt
from difflib import SequenceMatcher
sm = SequenceMatcher
import sys
path = sys.argv[1]
# print(path)
pytesseract.pytesseract.tesseract=r"C:\Program Files\Tesseract-OCR\tesseract.exe"
img = cv2.imread(path)
img = cv2.resize(img, None, fx=0.5, fy=0.5)
img = cv2.fastNlMeansDenoisingColored(img, None, 10, 10, 7, 15)
#gray scaling the image
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
img2Char = pytesseract.image_to_string(gray)
img2Char = ' '.join(img2Char.split())
acc = sm(None,"THE KITE RUNNER",img2Char).ratio()
acc = acc*100
adaptive_threshold = cv2.adaptiveThreshold(gray, 255, cv2.ADAPTIVE_THRESH_GAUSSIAN_C,cv2.THRESH_BINARY, 113, 11)
img2Char1 = pytesseract.image_to_string(adaptive_threshold)
img2Char1 = ' '.join(img2Char1.split()[2:5])
acc1 = sm(None,"THE KITE RUNNER",img2Char1).ratio()
acc1 = acc1*100
# if acc1>acc:
#     searchText = img2Char1
# else:
#     searchText = img2Char
# searchText = img2Char
searchText = img2Char1
print(searchText)
