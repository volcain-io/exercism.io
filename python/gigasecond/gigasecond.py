from datetime import datetime
import calendar
import math


def add_gigasecond(birth_date):
    seconds = calendar.timegm(birth_date.timetuple()) + math.pow(10, 9)
    return datetime.utcfromtimestamp(seconds)
