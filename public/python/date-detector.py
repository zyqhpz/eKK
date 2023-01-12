import PyPDF2
import re

# accept file name from argument
import sys
object = PyPDF2.PdfFileReader(sys.argv[1])

# object = PyPDF2.PdfFileReader(r"Kertas Kerja JHEPA.pdf")
# Get number of pages
NumPages = object.getNumPages()

# Enter code here
String = "TARIKH:"
PageObj = object.getPage(0)
text = PageObj.extractText()
lines = text.splitlines()

#iterate through each line
for line in lines:
    if line.startswith("TARIKH :"):
        #if we find the line starts with TARIKH:
        # we will get the next line
        date = lines[lines.index(line) + 1]
        print(date)
        break

    if line.startswith("TARIKH:"):
        #if we find the line starts with TARIKH:
        # we will get the next line
        date = lines[lines.index(line) + 1]
        print(date)
        break