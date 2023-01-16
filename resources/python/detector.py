import PyPDF2
import re
# Open the pdf file
# object = PyPDF2.PdfFileReader(r"kk.pdf")

# accept file name from argument
import sys
object = PyPDF2.PdfFileReader(sys.argv[1])

# object = PyPDF2.PdfFileReader(r"Kertas Kerja JHEPA.pdf")
# Get number of pages
NumPages = object.getNumPages()
# Enter code here
String = "IMPLIKASI KEWANGAN"
# Extract text and do the search
for i in range(0, NumPages):
    PageObj = object.getPage(i)
    Text = PageObj.extractText()
    if re.search(String,Text):
        print("Pattern Found on Page: " + str(i))

         
        #  re.search(r'adalah sebanyak RM (.*)sehingga', Text).group(1)

        # Read the numbers after the string "adalah sebanyak RM ", exclude "." in the end and put it in a variable total_cost
        total_cost = re.search(r'adalah sebanyak RM (.*)', Text).group(1)

        # remove the last "." from total_cost string
        total_cost = total_cost[:-1] 

        print(total_cost)

        #remove the comma from total_cost string
        total_cost = total_cost.replace(",", "")

        # remvoe "." from total_cost string
        total_cost = total_cost.replace(".", "")
        