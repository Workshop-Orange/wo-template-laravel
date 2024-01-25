#!/bin/sh

COUNT=`ps ax | grep horizon:work | grep -v grep | wc -l`

if [ $COUNT -gt 0 ]; then
	echo Horizon is running
else
	echo Horizon is not running
fi
