#!/bin/bash
while [ true ]
do
# Auto-Processing
	curl http://localhost/sadena/autoproc/refresh
# Time Period 30 seconds	
	sleep 30
done
