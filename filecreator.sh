#!/bin/bash

# # arg 1 is directory to look in
# # arg 2 is content to write

if [ -z $3 ]; then 
    num=$(ls "../$1" | wc -l)
    nump=$(echo "$num + 1" | bc)
    echo "$2" > "../$1$nump.txt"
else 
    num=$(ls "../$1" | wc -l)
    nump=$(echo "($num/2) + 1" | bc)
    echo -e "$2" > "../${1}${nump}-lat.txt"
    echo -e "$3" > "../${1}${nump}-long.txt"
fi