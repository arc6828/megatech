#!/bin/bash
if [[ ! "$(/usr/sbin/service mysql status)" =~ "running" ]]
then
    echo "RESTART"
    /usr/sbin/service mysql start
else 
    echo "RUNNING"
fi
