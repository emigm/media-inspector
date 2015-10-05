# Media Inspector

Media Inspector is a PHP based web application that allows you to obtain information about a media entity uploaded to a social network

## Installation

At Media Inspector we try to make your life easier. Due to that, we offer two way of installing it:
- Installing from Source
- Installing through Docker

We recommend the use of Docker because of the following advantages:
- We also Dockerized the development environment, so you don't need to install anything on your development machine
- Avoid side effects while running multiple applications in the same host
- Failure isolation
- Immutable Artifacts
- Standarization

### Installing from Source

First of all, install the following dependencies
- PHP 5.6+
- A Git client

Secondly, clone this repo into your working directory
```
>> git clone https://github.com/emigm/media-inspector.git media_inspector
```

Finally, install the application requirements
```
>> curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
>> cd media_inspector
>> composer install --prefer-dist
```

### Installing through Docker

Install [Docker](http://docs.docker.com/installation/) and **that's it**, this is all you need!

There is a Docker image stored in [quay.io](https://quay.io/) with the latest version of Media Inspector.
Also, a change in this respository triggers a new image build, so you will always run the latest version.

## API

Media Inspector's API is RESTful

### Get information
#### Request
- **URI**
```
/media/$MEDIA_ID
```
- **Method**
```
GET
```
- **Headers**
```
Authorizaion: Bearer $INSTAGRAM_ACCESS_TOKEN
```
#### Response
- **Status Code**
```
200 OK
```
- **Body**
```
{
    "id": "1081347983064313090_1220832186",
    "type": "image",
    "location": {
        "geoPoint": {
            "latitude": 40.7155418,
            "longitude": -73.9533691
        },
        "reverseGeoCode": {
            "streetAddress": "33 Havemeyer St, Brooklyn, NY 11211, USA",
            "neighborhood": "Williamsburg",
            "subLocality": "Brooklyn",
            "locality": "NY",
            "postalCode": "11211",
            "adminArea1": "Kings County",
            "adminArea2": "NY",
            "country": "US"
        }
    }
}
```

## Usage

Media Inspector is customized through environment variables to create immutable artifacts that can be run in any environment

### Using Media Inspector after installing it from source

- Define environment variables
```
>> export GOOGLE_API_KEY=$API_KEY
>> export GOOGLE_ENDPOINT=https://maps.googleapis.com
>> export INSTAGRAM_ENDPOINT=https://api.instagram.com
```
- Run Media Inspector service
```
>> php -S localhost:8080
```
- Perform a HTTP request replacing those values that start with "$" with the correct ones
```
>> curl -XGET -H "Authorization: Bearer $INSTAGRAM_ACCESS_TOKEN" http://localhost:8080/media/$MEDIA_ID
```

### Using Media Inspector after installing Docker

Run the Media Inspector container
```
>> docker run \
    -e GOOGLE_API_KEY=$API_KEY \
    -e GOOGLE_ENDPOINT=https://maps.googleapis.com \
    -e INSTAGRAM_ENDPOINT=https://api.instagram.com \
    --name media_inspector \
    -p 8080:80 \
    quay.io/emigm/media-inspector
```
- Perform a HTTP request replacing those values that starts with "$" with the correct ones
```
>> curl -XGET -H "Authorization: Bearer $INSTAGRAM_ACCESS_TOKEN" http://localhost:8080/media/$MEDIA_ID
```
- Stop the Media Inspector container
```
>> docker stop media_inspector
```

## Contribute with us!
- Fork it
- Download the development environment
```
>> docker pull quay.io/emigm/php-composer
```
- Install composer dependencies
```
>> docker run \
    -v $(pwd):/var/www quay.io/emigm/php-composer \
    "composer install --prefer-dist"
```
- Check that everithing is working fine by running the unit tests
```
>> docker run \
    -e TEST_INSTAGRAM_ACCESS_TOKEN=$INSTAGRAM_ACCESS_TOKEN \
    -v $(pwd):/var/www quay.io/emigm/php-composer \
    "./vendor/bin/phpunit tests"
```
- Run Media Inspector from the development environment
```
>> docker run \
    -e GOOGLE_API_KEY=$API_KEY \
    -e GOOGLE_ENDPOINT=https://maps.googleapis.com \
    -e INSTAGRAM_ENDPOINT=https://api.instagram.com \
    --name media_inspector_devenv \
    -p 8080:80 \
    -v $(pwd):/var/www quay.io/emigm/php-composer \
    "php -S 0.0.0.0:80"
```

Once you have passed through all the steps, start contributing!
- Create your feature branch: `git checkout -b my-new-feature`
- Commit your changes: `git commit -am 'Add some feature'`
- Push to the branch: `git push origin my-new-feature`
- Submit a pull request :D
