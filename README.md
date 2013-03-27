# PHPThumb for Laravel 4

A simple [Laravel 4](http://four.laravel.com/) service provider for including the [PHPThumb for Laravel 4](https://github.com/mewebstudio/phpthumb).

## Installation

The PHPThumb Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`mews/phpthumb` package and setting the `minimum-stability` to `dev` (required for Laravel 4) in your
project's `composer.json`.

```json
{
    "require": {
        "laravel/framework": "4.0.*",
        "mews/phpthumb": "dev-master"
    },
    "minimum-stability": "dev"
}
```

Update your packages with ```composer update``` or install with ```composer install```.

## Usage

To use the PHPThumb Service Provider, you must register the provider when bootstrapping your Laravel application. There are
essentially two ways to do this.

Find the `providers` key in `app/config/app.php` and register the PHPThumb Service Provider.

```php
    'providers' => array(
        // ...
        'Mews\Phpthumb\PhpthumbServiceProvider',
    )
```

## Example

```php

    class ImageController extends Controller {

        public function getIndex()
        {

            $file = base_path() . '/test.jpg';
            //$file = 'http://phpthumb.gxdlabs.com/wp-content/themes/phpthumb/images/header_bg.png';
            App::make('phpthumb')
                ->create('crop', array($file, 'center', 200, 200))
                //->create('crop', array($file, 'basic', 100, 100, 300, 200))
                //->create('resize', array($file, 400, 400, 'adaptive'))
                //->rotate(array('degree', 180))
                ->reflection(array(40, 40, 80, true, '#a4a4a4'))
                //->save(base_path() . '/', 'aaa.jpg');
                ->show();
        }

    }
```

^_^                         


## Links

* [PHPThumb Library website](http://phpthumb.gxdlabs.com/)

* [L4 PHPThumb on Github](https://github.com/mewebstudio/Phpthumb)
* [L4 PHPThumb on Packagist](https://packagist.org/packages/mews/phpthumb)
* [License](http://www.opensource.org/licenses/mit-license.php)
* [Laravel website](http://laravel.com)
* [Laravel Turkiye website](http://www.laravel.gen.tr)
* [MeWebStudio website](http://www.mewebstudio.com)
