#!/usr/bin/env bash

git pull
sed -i -E "s/APP_BUILD=\".*\"/APP_BUILD=\"`git rev-parse --short HEAD`\"/" .env

composer update
npm update

gulp build