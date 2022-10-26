FROM nginx:stable-alpine

# Install production dependencies
RUN apk add --no-cache \
    bash \
    curl \
    git

ADD ./.docker/nginx/nginx.conf /etc/nginx/
ADD ./.docker/nginx/default.conf /etc/nginx/conf.d/

RUN mkdir -p /var/www/html

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN chown laravel:laravel /var/www/html

# OhMyBash
RUN bash -c "$(curl -fsSL https://raw.githubusercontent.com/ohmybash/oh-my-bash/master/tools/install.sh)" && \
sed -i 's/OSH_THEME="font"/OSH_THEME="agnoster"/' ~/.bashrc
