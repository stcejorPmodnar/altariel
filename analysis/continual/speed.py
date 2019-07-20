"""I am speed"""

import sys

def speed(secs, meters):

    meters_per_second = meters / secs
    miles_per_hour = meters_per_second * 2.23694

    print(miles_per_hour)

if __name__ == "__main__":
    speed(2, float(sys.argv[1]))
