FROM php:7.3-fpm-alpine
RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql
RUN apk add bash icu-dev
RUN docker-php-ext-install opcache
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version
RUN apk add zsh
RUN sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
RUN sed -i -e "s/bin\/ash/bin\/zsh/" /etc/passwd
RUN apk add openssh git-perl
RUN apk add --update nodejs npm
RUN curl https://cli-assets.heroku.com/install.sh | sh
WORKDIR /var/www
CMD ["php-fpm"]
EXPOSE 9000