#!/bin/bash

result=`cat ${1} | xxd -p`
echo $result
