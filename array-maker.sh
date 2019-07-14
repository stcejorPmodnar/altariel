#!/bin/bash

# $1 will be a directory

# this script returns a js array of contents of all files in a directory


array="["

sorted=$(ls $1 | sort -n)

# for i in $(ls $1); do
for i in $sorted; do
    file=$(cat $1/$i | tr -d '\n' | tr -d ' ')
    array+="\"$file\","
done

array=$(echo "$array" | rev | cut -c 2- | rev)

array+="]"

printf "$array"