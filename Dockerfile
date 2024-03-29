## Development image
FROM node:16.15.1-alpine3.16 AS development

ARG USER_ID=1000
ENV USER_NAME=default
ENV PATH="${PATH}:/usr/src/app/node_modules/.bin"

WORKDIR /usr/src/app

RUN if [ $USER_ID -ne 1000 ]; then \
        apk add --no-cache -t volatile \
            shadow \
     && groupmod -g $USER_ID node \
     && usermod -u $USER_ID -g $USER_ID node \
     && apk del --purge volatile; \
    fi
