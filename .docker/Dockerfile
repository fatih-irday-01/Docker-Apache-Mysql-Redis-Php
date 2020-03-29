FROM debian:10

MAINTAINER 'fatihirday@gmail.com'

RUN apt-get update && \
    apt-get -y upgrade


# INSTALL PREREQUISITES
RUN apt-get install -y software-properties-common \
    build-essential \
    locales \
    unzip \
    sudo \
    wget \
    curl \
    htop \
    git \
    cron \
    apache2

# INSTALL LOCALES
RUN echo "en_US.UTF-8 UTF-8" >> /etc/locale.gen && \
    echo "tr_TR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen


# PHP REPOSITORY
RUN apt-get -y install apt-transport-https lsb-release ca-certificates && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'

RUN apt-get update

RUN apt-get install -y php7.3 \
    php7.3-gd \
    php7.3-zip \
    php7.3-intl \
    php7.3-curl \
    php7.3-mbstring \
    php-mysql \
    php-redis \
    php-bcmath \
    libapache2-mod-php


# INSTALL SUPERVISOR
RUN apt-get install -y supervisor
RUN ln -s /var/www/html/.supervisor/supervisord.conf /etc/supervisord.conf

WORKDIR "/var/www/html"
CMD ["/bin/bash"]
RUN echo "mkdir /home/log" >> /home/serverStart.sh
RUN echo "a2enmod rewrite" >> /home/serverStart.sh
RUN echo "service apache2 restart" >> /home/serverStart.sh
RUN echo "supervisord -n -c /etc/supervisor/supervisord.conf" >> /home/serverStart.sh
ENTRYPOINT ["/bin/bash","/home/serverStart.sh"]
