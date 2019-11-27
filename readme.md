# Laravel OnePush
Custom package for private usage, thanks to `berkayk/laravel-onesignal`

## Installation
The best way to use this package is using [composer](https://getcomposer.org/)
```
composer require frankyso/laravel-onepush
```

## Usage
publish package vendor 
```php
php artisan vendor:publish
```

### How to Use
#### Send Broadcast
```php
use OnePush;
OnePush::broadcastNotification("your-message","headings","large-icon-url")->send();
```

#### Send Private Message
```php
use OnePush;
OnePush::broadcastNotification("id","your-message","headings","large-icon-url")->send();
```

#### Send With Banner
```php
use OnePush;
OnePush::broadcastNotification("your-message","headings","large-icon-url")->setBanner('https://miro.medium.com/max/2560/1*tqc2Tf1dK9WFJi2YW2rh9Q.png')->send();
```

#### With Url Redirect
```php
use OnePush;
OnePush::broadcastNotification("your-message","headings","large-icon-url")->setRedirectUrl('https://woobiz.id/')->send();
```


## Authors

* **Franky So** - *Initial work*