# media-inspector

Docker Ready !

You need to install Docker in your host

http://docs.docker.com/installation/ubuntulinux/

Download development environment

>> docker pull quay.io/emigm/php-composer

Install Composer dependencies

>> docker run \
    -v $(pwd):/var/www quay.io/emigm/php-composer
    "composer install --prefer-dist"

Update Composer dependencies

>> docker run \
    -v $(pwd):/var/www quay.io/emigm/php-composer
    "composer update"

Run UnitTests

>> docker run \
    -e TEST_INSTAGRAM_ACCESS_TOKEN=${YOUR_TOKEN} \
    -v $(pwd):/var/www quay.io/emigm/php-composer \
    "./vendor/bin/phpunit tests"

Run the service from the development environment

>> docker run \
    -e GOOGLE_API_KEY=${YOUR_API_KEY} \
    -e GOOGLE_ENDPOINT=https://maps.googleapis.com \
    -e INSTAGRAM_ENDPOINT=https://api.instagram.com \
    --name media_inspector_devenv \
    -v $(pwd):/var/www quay.io/emigm/php-composer
    "php -S 0.0.0.0:80"

Run the service from the released version

>> docker run \
    -e GOOGLE_API_KEY=${YOUR_API_KEY} \
    -e GOOGLE_ENDPOINT=https://maps.googleapis.com \
    -e INSTAGRAM_ENDPOINT=https://api.instagram.com \
    --name media_inspector \
    quay.io/emigm/media-inspector

Check if service is up and running

>> docker exec media_inspector ip addr show eth0
${eth0-ipv4}

>> curl -XGET -H "Authorization: Bearer ${Instagram-Access-Token}" http://${eth0-ipv4}:80/media/{id}

Stop service

>> docker stop ${container-id}
