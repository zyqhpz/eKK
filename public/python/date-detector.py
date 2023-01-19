from datetime import datetime
import PyPDF2
import re

import sys

object = PyPDF2.PdfFileReader(sys.argv[1])
# Get number of pages
NumPages = object.getNumPages()

# Enter code here
String = "TARIKH:"
PageObj = object.getPage(0)
text = PageObj.extractText()
lines = text.splitlines()

# make function to convert month from Malay to English and CamelCase to number of month in 2 digits format
def convert_month(month):
    # convert month to CamelCase and convert from Malay to English
    month = month.title()

    if month == "Januari":
        month = "January"
    elif month == "Februari":
        month = "February"
    elif month == "Mac":
        month = "March"
    elif month == "April":
        month = "April"
    elif month == "Mei":
        month = "May"
    elif month == "Jun":
        month = "June"
    elif month == "Julai":
        month = "July"
    elif month == "Ogos":
        month = "August"
    elif month == "September":
        month = "September"
    elif month == "Oktober":
        month = "October"
    elif month == "November":
        month = "November"
    elif month == "Disember":
        month = "December"

    # convert the month to number
    month = datetime.strptime(month, '%B').month

    # convert the month to 2 digits
    month = str(month).zfill(2)

    return month

#iterate through each line
for line in lines:

    if line.startswith("TARIKH :"):
        #if we find the line starts with TARIKH:
        # we will get the next line
        date = lines[lines.index(line) + 1]

        date_string = date

        # print(date_string)

        # split the string to get the date
        date_string = date_string.split(" ")

        if (len(date_string) == 5):

            # get the day
            day = date_string[0]

            # get the month
            month = date_string[1]

            # get the year

            year = date_string[2]

            # convert month to CamelCase and convert from Malay to English
            month = month.title()

            month = convert_month(month)

            # convert the day to 2 digits
            day = str(day).zfill(2)

            # combine the date
            date_string = year + "-" + month + "-" + day

            # print the date
            print(date_string)

            break

        else:
            day_start = date_string[0]

            day_end = date_string[2]

            # get month
            month = date_string[3]

            # get year

            year = date_string[4]

            # convert month to CamelCase and convert from Malay to English
            month = month.title()

            month = convert_month(month)

            # convert the day to 2 digits
            day_start = str(day_start).zfill(2)

            # convert the day to 2 digits
            day_end = str(day_end).zfill(2)

            # combine the date in array 
            date_array = [year + "-" + month + "-" + day_start, year + "-" + month + "-" + day_end]

            # print the date
            print(date_array)
