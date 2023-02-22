FROM php:7.4-cli

WORKDIR /usr/src/myapp

CMD [ "php", "-S", "0.0.0.0:8001"]
