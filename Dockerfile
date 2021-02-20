## Development image
FROM node:14.15.5-alpine3.13 AS development

ARG USER_ID=1000
ENV USER_NAME=default
ENV PATH="${PATH}:/usr/src/app/node_modules/.bin"

WORKDIR /usr/src/app

RUN if [ $USER_ID -ne 1000 ]; then \
        apk add --no-cache -t tmp shadow \
     && groupmod -g $USER_ID node \
     && usermod -u $USER_ID -g $USER_ID node \
     && apk del --purge tmp; \
    fi
