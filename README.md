# media-inspector

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
    -v $(pwd):/var/www quay.io/emigm/php-composer
    "./vendor/bin/phpunit tests"

Run Service

>> docker run \
    -e GOOGLE_API_KEY=AIzaSyAJZS9xjpoN_CT7__iaqsxflGleHgL4QhA \
    -e GOOGLE_ENDPOINT=https://maps.googleapis.com \
    -e INSTAGRAM_ENDPOINT=https://api.instagram.com \
    -v $(pwd):/var/www quay.io/emigm/php-composer
    "php -S 0.0.0.0:80"

Check if service is up and running

>> docker ps -q
${container-id}

>> docker exec ${container-id} ip addr show eth0
${eth0-ipv4}

>> curl -XGET -H "Authorization: Bearer ${Instagram-Access-Token}" http://${eth0-ipv4}:80/media/{id}

Stop service

>> docker stop ${container-id}
