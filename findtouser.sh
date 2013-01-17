#!/bin/bash

timeout='50'
cert_path='/path/to/a/cacert.pem'
resource='https://prowl.weks.net/publicapi/add'
key=$1

app=$2

event=$3

desc=$4

# 0 - Normal, 2 - Emergency, -2 - Very Low priority
priority=$5
if [ -z "$priority" ]; then
  priority=0
elif [ "$priority" != "-2" ] &&  [ "$priority" != "-1" ] &&  [ "$priority" != "0" ] &&  [ "$priority" != "1" ] &&  [ "$priority" != "2" ]; then
  priority=0
fi

url=$6

app=$(echo -n $app | perl -pe's/([^-_.~A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg');
event=$(echo -n $event | perl -pe's/([^-_.~A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg');
desc=$(echo -n $desc | perl -pe's/([^-_.~A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg');

post="apikey=$key&application=$app&event=$event&description=$desc&priority=$priority&url=$url"

/usr/bin/wget -T $timeout -q -O- --ca-certificate=$cert_path --post-data $post $resource

