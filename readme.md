# Víctor's showcase

## About

This is the repository of my showcase, where I share my professional career, my skills and my interests. Find it live [here](https://v0ctor.me).

### Standards

The project follows these standards:

* [PSR-2](https://www.php-fig.org/psr/psr-2/): coding style.
* [PSR-4](https://www.php-fig.org/psr/psr-4/): autoloading.
* [PSR-5](https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc.md) and [PSR-19](https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md): documentation.

Extended by the following rules:

* Code must sort `use` declarations in alphabetical order.
* Code must use the short array declaration style.
* Code must align multiline constant declarations and array key-value pairs.
* Code must use a comma after last element in multiline arrays.

### Directory structure

The project follows the [default Laravel application structure](https://laravel.com/docs/structure) with the following addition:

* `Dockerfile`, `docker-compose.yml`, `.dockerignore` and `chart` contain all necessary [Docker](https://www.docker.com) and [Kubernetes](https://kubernetes.io) manifests to define the infrastructure.

### License
This software is distributed under the MIT license. Please read `license.md` for more information on the software availability and distribution.

### Credits
* [Main header](https://unsplash.com/photos/jVx8JaO2Ddc) by [Philipp Katzenberger](https://unsplash.com/@fantasyflip).
* [WebSocket header](https://unsplash.com/photos/7m2gkYUDfFE) by [Marat Gilyadzinov](https://unsplash.com/@m3design).
* [Errors header](https://unsplash.com/photos/-coR_4tgtWA) by [Ali Inay](http://unsplash.com/@inayali).

## First steps

The project comes with a fully functional [Docker](https://www.docker.com) environment that has everything necessary to develop on any platform.

### Installation

The only software requirements are [Docker Engine](https://docs.docker.com/engine/installation/) (Community Edition) and [Docker Compose](https://docs.docker.com/compose/install/). Follow the previous links to read the installation instructions. It is necessary to install the latest versions before continuing.

#### Environment file

Once installed, copy the example environment file to its default location.

```Shell
cp .env.example .env
```

Then, complete the `UID` environment variable with your user ID (`id -u`). Thus, the application container will use your user to interact with shared volumes.

```Shell
sed -i "s/UID=.*/UID=$(id -u)/" .env
```

#### Docker environment

The development environment is made of two different containers:

* `app` runs the application itself using the [PHP interpreter](https://php.net).
* `web` serves the application through HTTP using [Nginx](https://nginx.org).

To build the environment, run Docker Compose in daemon mode. The first time it may take a few minutes, since software must be compiled.

```Shell
docker-compose up -d
```

Then, enter to the `app` container.

```Shell
docker-compose exec -u $(id -u) app bash
```

To easily access the container on subsequent occasions, you can add the following alias to your `.bashrc` or `.zshrc` file.

```Shell
alias app="docker-compose exec -u $(id -u) app bash"
```

### Initialization

Being inside of the `app` container for the first time, you should install the dependencies.

```Shell
composer install
npm install
```

### Usage

Now you can use [Composer](https://getcomposer.org), [Artisan](https://laravel.com/docs/artisan), [Tinker](https://github.com/laravel/tinker) and [PHPUnit](https://phpunit.de) in the `app` container, among others

[Xdebug](https://xdebug.org) is also available from the host machine. To use it with [PhpStorm](https://www.jetbrains.com/phpstorm/), see [the official guide](https://www.jetbrains.com/help/phpstorm/configuring-xdebug.html#integrationWithProduct).

To use the application through HTTP, you can perform requests to [http://localhost](http://localhost). The database is also accessible from the host with the following credentials:

* **Host:** `localhost`
* **Port:** `3306`
* **Database:** `test`
* **Username:** `test`
* **Password:** `test`

> Note that Git is not available in the container, so you should use it from the host machine. It is strongly recommended to use [Fork](https://git-fork.com), a Git client.

### Deployment

The deployment process is automated with [Drone](https://drone.io) and [Kubernetes](https://kubernetes.io). When changes are incorporated into production (`master` branch) or staging (`develop` branch), an automatic deployment is made to the corresponding environment.

## Troubleshooting

There are several common problems that can be easily solved. Here are their causes and solutions.

### Composer

When a class is not found, check that it is in the correct namespace. If that was not the problem, you should [update the autoloader](https://getcomposer.org/doc/03-cli.md#dump-autoload-dumpautoload-) by running the following command.

```Shell
composer dump-autoload
```

### Docker

The Docker environment should work properly as it has been exhaustively tested. Otherwise, it is possible to rebuild it by running the following command.

```Shell
docker-compose build --no-cache
```

You can also rebuild a single service. For example, if you want to rebuild the `app` service:

```Shell
docker-compose build --no-cache app
```

To start from scratch, you can remove all containers, images and volumes of your computer by running the following commands.

> Note that all system containers, images and volumes will be deleted, not only those related to this project.

```Shell
docker-compose down
docker rm $(docker ps -a -q)
docker rmi $(docker images -q)
docker volume rm $(docker volume ls -f dangling=true -q)
```
