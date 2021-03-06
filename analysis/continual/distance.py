from math import sin, cos, sqrt, radians
import sys

def distance_formula(A, B):

    sum_of_squared_distances = 0

    for i in range(3):
        sum_of_squared_distances += (A[i] - B[i]) ** 2

    dist = sqrt(sum_of_squared_distances)

    return dist


def shperical_to_cartesian(lat, long, alt):

    x = alt * cos(lat) * sin(long)
    y = alt * sin(lat)
    z = alt * cos(lat) * cos(long)

    return x, y, z


def main(lat1, lon1, alt1, lat2, lon2, alt2):
    
    p1 = shperical_to_cartesian(lat1, lon1, alt1)
    p2 = shperical_to_cartesian(lat2, lon2, alt2)

    print(distance_formula(p1, p2))

if __name__ == "__main__":

    lat1, lon1, alt1, lat2, lon2, alt2 = [float(i) for i in sys.argv[1:]]
    lat1 = radians(lat1)
    lat2 = radians(lat2)
    lon1 = radians(lon1)
    lon2 = radians(lon2)
    main(lat1, lon1, 6371000 + alt1, lat2, lon2, 6371000 + alt2)

