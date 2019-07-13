#!/bin/bash

#identifies the database directory
directory="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )/loc-data"

#counts # of folders
foldercount=$(ls $directory | wc -l)

# adds one to the number of folders
echo "$foldercount+1" | bc -l | grep . | tr -d '\n' | tr -d ' '