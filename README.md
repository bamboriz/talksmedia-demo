# junior-php-test
This repository holds the code for the junior PHP developer test.

## Development Flow

All development work occurs on the `develop` branch.
The `master` branch is used to create new releases by merging current head of the `develop` branch.
You should create a feature-branch in `feature/feature-name`, branching from `develop`, whenever 
you need to add some changes to the `master` branch.
If those changes are accepted they will be merged by the repository maintainer.

## Dependencies
This application is based on:
- nginx:latest
- php7.4-fpm-alpine

## Development environment

To ease local development you have to install these tools:

* [Docker CE](https://www.docker.com/)
* [Docker-Compose](https://docs.docker.com/compose/)

In the project's root folder there is the main file where the architecture is described: `docker-compose.yml`.
In there you can find all services configured that you'll get.

In order to have everything work correctly you have to copy the `.env.dist` 
file, located in the root folder to the `.env` in the root folder.

### Start environment

To start your environment, execute these commands:
```sh
make start
make init
```
When the process finishes you can interact with the API at `http://localhost:[NGINX_PORT_EXPOSED]`.

### Monitor environment

To monitor your environment, execute this command:
```sh
make ps
```

To follow all logs, execute this command:
```sh
make logs
``` 

### Stop environment

To stop your environment, execute this command:
```sh
make stop
```

### Destroy environment

To destroy your environment, execute this command:
```sh
make destroy
```

### Use PHP Version installed in Docker

To use the PHP version available in the `app` container:
```sh
docker-compose exec php php
```

## Testing

The repository is configured to run PHPUnit tests and there are several handy shortcut
for it in the `composer.json` file.

To run all tests, execute this command:
```sh
make test