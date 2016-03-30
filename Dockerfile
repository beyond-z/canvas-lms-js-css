# Very lightweight, static web server docker image

FROM node:slim

RUN npm install -g node-static

RUN mkdir /app
WORKDIR /app
ADD . /app

# This is run from docker-compose.yml
#CMD static --host-address 0.0.0.0 -p 3003 --gzip
