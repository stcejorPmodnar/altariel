#!/bin/bash
lat1=$(cat $1)
long1=$(cat $2)
alt1=$(cat $3)
lat2=$(cat $4)
long2=$(cat $5)
alt2=$(cat $6)

lat1=$(echo "$lat1 * 0.0174533" | bc -l)
lat2=$(echo "$lat2 * 0.0174533" | bc -l)

long1=$(echo "$long1 * 0.0174533" | bc -l)
long2=$(echo "$long2 * 0.0174533" | bc -l)

alt1=$(echo "$alt1 + 6371000")
alt2=$(echo "$alt2 + 6371000")

sin() {
    echo "scale=10;s($1)" | bc -l
}

cos() {
    echo "scale=10;c($1)" | bc -l
}

tan() {
    echo "scale=10;s($1)/c($1)" | bc -l
}

cosLat1=$(cos $lat1)
cosLat2=$(cos $lat2)
cosLong1=$(cos $long1)
cosLong2=$(cos $long2)
sinLong1=$(sin $long1)
sinLong2=$(sin $long2)
sinLat1=$(sin $lat1)
sinLat2=$(sin $lat2)

x1=$(echo "$alt1 * $cosLat1 * $sinLong1" | bc -l)
x2=$(echo "$alt2 * $cosLat2 * $sinLong2" | bc -l)

y1=$(echo "$alt1 * $sinLat1" | bc -l)
y2=$(echo "$alt2 * $sinLat2" | bc -l)

z1=$(echo "$alt1 * $cosLat1 * $cosLong1" | bc -l)
z2=$(echo "$alt2 * $cosLat2 * $cosLong2" | bc -l)
distance=$(echo "sqrt(($x2 - $x1)^2 + ($y2 - $y1)^2 + ($z2 - $z1)^2)" | bc -l)
echo $distance

        # x1 = alt1 * cos(lat1) * sin(long1);
        # x2 = alt2 * cos(lat2) * sin(long2);

        # y1 = alt1 * sin(lat1);
        # y2 = alt2 * sin(lat2);

        # z1 = alt1 * cos(lat1) * cos(long1);
        # z2 = alt2 * cos(lat2) * cos(long2);
        #        double dist = sqrt( (x2-x1) * (x2-x1) + (y2-y1) * (y2-y1) + (z2-z1) * (z2-z1));
