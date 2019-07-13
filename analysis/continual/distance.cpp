#include <iostream>
#include <cmath>
#include <fstream>
#include <streambuf>



using namespace std;

// arg list: coord lat1; coord long1, alt 1; coord lat2; coord long2; alt 2

int main(int argc, char *argv[]){
    if ( argc != 7 ){ 
        cout << argc << "Enter four arguments: coord 1; alt 1; coord 2; alt 2";
    }
    else {

        double lat1, long1, alt1, lat2, long2, alt2;

        ifstream readlat1(argv[1]);
        readlat1 >> lat1;
        ifstream readlong1(argv[2]);
        readlong1 >> long1;
        ifstream readalt1(argv[3]);
        readalt1 >> alt1;
        ifstream readlat2(argv[4]);
        readlat2 >> lat2;
        ifstream readlong2(argv[5]);
        readlong2 >> long2;
        ifstream readalt2(argv[6]);
        readalt2 >> alt2;

        alt1 = alt1 + 6371000;
        alt2 = alt2 + 6371000;
        double x1, y1, z1, x2, y2, z2;

        // phi = lat
        // theta = long
        // rho = alt

        x1 = alt1 * cos(lat1) * sin(long1);
        x2 = alt2 * cos(lat2) * sin(long2);

        y1 = alt1 * sin(lat1);
        y2 = alt2 * sin(lat2);

        z1 = alt1 * cos(lat1) * cos(long1);
        z2 = alt2 * cos(lat2) * cos(long2);

        // x1 = alt1 * cos(lat1) * sin(long1);
        // x2 = alt2 * cos(lat2) * sin(long2);

        // y1 = alt1 * sin(lat1);
        // y2 = alt2 * sin(lat2);

        // z1 = alt1 * cos(lat1) * cos(long1);
        // z2 = alt2 * cos(lat2) * cos(long2);

        double dist = sqrt( (x2-x1) * (x2-x1) + (y2-y1) * (y2-y1) + (z2-z1) * (z2-z1));
        cout << dist << endl;

// RESULT WILL BE IN METERS, THAT IS WHAT ALTITUDE IS MEASURED IN
//   p = (long, lat, alt)

// we calculate the equivalent Cartesian coordinates

//   p = (x, y, z)

// as follows, where the asterisk denotes multiplication.

//   x = alt * cos(lat) * sin(long)
//   y = alt * sin(lat)
//   z = alt * cos(lat) * cos(long)


    }

} 