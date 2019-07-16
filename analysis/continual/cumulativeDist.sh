#!/bin/bash

total=0
for i in $(ls $1); do
    num=$(cat $i | tr -d '\n' | tr -d ' ')
    total=$(echo "$total + $num" | bc -l)
done

printf "$total"