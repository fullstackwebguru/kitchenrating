#!/bin/sh
if [ -n "$DYNO" ]
then
    php init --env=Heroku --overwrite=All
fi
