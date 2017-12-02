FROM composer:latest

ADD ./ /zero-installer

RUN cd /zero-installer/ && composer install

RUN chmod -R ugo+rw /tmp/cache/

WORKDIR /workspace

ENTRYPOINT ["/zero-installer/laravel-zero"]
