#!/bin/bash

composer selfupdate
composer update
npm update --save-dev --silent
npm prune
# bower cache clean
bower update --save
bower prune
