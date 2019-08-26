ScheduledMessengerBundle
====================================

Symfony bundle that helps you dispatch delayed messages based on events.

[![Build Status](https://travis-ci.org/wernerdweight/ScheduledMessengerBundle.svg?branch=master)](https://travis-ci.org/wernerdweight/ScheduledMessengerBundle)
[![Latest Stable Version](https://poser.pugx.org/wernerdweight/scheduled-messenger-bundle/v/stable)](https://packagist.org/packages/wernerdweight/scheduled-messenger-bundle)
[![Total Downloads](https://poser.pugx.org/wernerdweight/scheduled-messenger-bundle/downloads)](https://packagist.org/packages/wernerdweight/scheduled-messenger-bundle)
[![License](https://poser.pugx.org/wernerdweight/scheduled-messenger-bundle/license)](https://packagist.org/packages/wernerdweight/scheduled-messenger-bundle)


Installation
------------

### 1. Download using composer

```bash
composer require wernerdweight/scheduled-messenger-bundle
```

### 2. Enable the bundle

Enable the bundle in your kernel:

```php
    <?php
    // config/bundles.php
    return [
        // ...
        WernerDweight\ScheduledMessengerBundle\ScheduledMessengerBundle::class => ['all' => true],
    ];
```

Usage
------------

TODO:

License
-------
This bundle is under the MIT license. See the complete license in the root directiory of the bundle.
