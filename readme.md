# Víctor's website

## About

This is the repository of my personal website, in which I share my professional career, my skills and my interests. Find it live [here](https://victordiaz.me).

### Standards

The project follows these standards:

* [PSR-2](http://www.php-fig.org/psr/psr-2/): coding style.
* [PSR-4](http://www.php-fig.org/psr/psr-4/): autoloading.
* [PHPDoc](https://docs.phpdoc.org/references/phpdoc/index.html): documentation.

Extended by the following rules:

* Code must sort `use` declarations in alphabetical order.
* Code must use the short array declaration style.
* Code must align multiline constant declarations and array key-value pairs.
* Code must use a comma after last element in multiline arrays.

### Directory structure

The project follows the [default Laravel application structure](https://laravel.com/docs/structure) with the following addition:

* `docker` and `docker-compose.yml` define the local Docker environment.

### License
This software is distributed under the MIT license. Please read `LICENSE` for information on the software availability and distribution.

### Credits
* [Main header](https://unsplash.com/photos/XJXWbfSo2f0) by [Luca Bravo](https://unsplash.com/@lucabravo).
* [WebSocket header](https://unsplash.com/photos/7m2gkYUDfFE) by [Marat Gilyadzinov](https://unsplash.com/@m3design).
* [Bitcoin header](https://unsplash.com/photos/IrmtwS7ledw) by [me](https://unsplash.com/@victordm).
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

Then, complete `USER_ID` and `USER_NAME` environment variables with your user ID (`id -u`) and your username (`whoami`). Thus, Docker containers will work with the same user than your computer.

#### Docker environment

The development environment is made of two different containers:

* `app` runs the application itself using the [PHP interpreter](https://php.net).
* `web` serves the application through HTTP using [Nginx](https://nginx.org).

To build the environment for the very first time, run Docker Compose in daemon mode. It may take a few minutes.

```Shell
docker-compose up -d
```

Then, enter to the `app` container.

```Shell
docker exec -it -u=$(id -u) app bash
```

### Initialization

Being inside of the `app` container for the first time, you should install the dependencies.

```Shell
composer install
```

### Usage

Now you can use [Composer](https://getcomposer.org), [Artisan](https://laravel.com/docs/artisan) and [PHPUnit](https://phpunit.de) inside the container, among others. [Xdebug](https://xdebug.org) is also available from the host machine.

To use the application through HTTP, you can perform requests to [http://localhost](http://localhost).
