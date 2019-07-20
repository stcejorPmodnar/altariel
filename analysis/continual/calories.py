import sys


def get_met(exercise_type, speed):  # speed in mph
    
    if exercise_type == "run":

        if 4 <= speed < 5:
            return 6.0

        elif 5 <= speed < 5.2:
            return 8.3

        elif 5.2 <= speed < 6:
            return 9.0

        elif 6 <= speed < 6.7:
            return 9.8

        elif 6.7 <= speed < 7:
            return 10.5

        elif 7 <= speed < 7.5:
            return 11.0
            
        elif 7.5 <= speed < 8.6:
            return 11.8

        elif 8.6 <= speed < 9:
            return 12.3
        
        elif 9 <= speed < 10:
            return 12.8

        elif 10 <= speed < 11:
            return 14.5

        elif 11 <= speed < 12:
            return 16.0

        elif 12 <= speed < 13:
            return 19.0

        elif 13 <= speed < 14:
            return 19.8

        elif speed >= 14:
            return 23.0

    elif exercise_type == "bike":

        if 5.5 <= speed < 9.4:
            return 3.5

        elif 9.4 <= speed < 10:
            return 5.8

        elif 10 <= speed < 12:
            return 6.8

        elif 12 <= speed < 13.9:
            return 8.0

        elif 14 <= speed < 15.9:
            return 10.0

        elif 16 <= speed <= 20:
            return 12.0

        elif speed > 20:
            return 15.8


def calories(exercise_type, speed):

    met = get_met(exercise_type, speed)
    return (met * 62.0) / 1800  # 62 is average weight in kg, and 1800 because 2 seconds


if __name__ == "__main__":
    print(calories(sys.argv[1], float(sys.argv[2])))  # pylint: disable=no-value-for-parameter