import sys
import os
from math import sqrt


MINIMUM_HILL_LENGTH = 60  # feet
MINIMUM_GRADIENT = 4  # percent


def listdir(path):
    """returns list of contents of all files in directory"""
    
    files = [os.path.join(path, file) for file in os.listdir(path) if file != '.DS_Store']
    values = []
    for file in files:
        with open(file, 'r') as f:
            values.append(float(f.read()))

    return values


def hills(altitude_directory, distance_directory):
    """returns list of hills
    
    Each element (tuple) in the output represents one hill, 
    with the two values being the start and stop datapoint indices of the hill it represents
    """
    
    altitude_list = listdir(altitude_directory)
    distance_list = listdir(distance_directory)

    def gradients():
        for i, alt, dist in enumerate(zip(altitude_list[1:], distance_list[1:])):
            horizontal_distance = sqrt((dist ** 2) - ((alt - altitude_list[i - 1]) ** 2))  # uses pythagorean theorem
            yield ((alt - altitude_list[i - 1]) / horizontal_distance) * 100  # (rise / run) * 100

    g = gradients()

    hills = []
    for i, grad in enumerate(g):

        if grad > MINIMUM_GRADIENT:

            f = i  # first point of hill
            e = i  # last point of hill

            while True:

                if next(g) > MINIMUM_GRADIENT:
                    e += 1
                else:
                    break

            hill_length = sum(distance_list[f:e])
            if hill_length > MINIMUM_HILL_LENGTH:
                hills.append((f, e))

    return hills


if __name__ == "__main__":
    hills(*sys.argv[1:])  #pylint: disable=no-value-for-parameter
