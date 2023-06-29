FROM alpine:3.17
RUN set -x \
    && apk add --no-cache supercronic shadow \
    && useradd -m app
USER app
COPY crontab .
