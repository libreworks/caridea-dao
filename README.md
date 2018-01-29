# caridea-dao
Caridea is a miniscule PHP application library. This shrimpy fellow is what you'd use when you just want some helping hands and not a full-blown framework.

![](http://libreworks.com/caridea-100.png)

This is its Data Access Object support component. You can use these classes to support DAOs that you write.

[![Packagist](https://img.shields.io/packagist/v/caridea/dao.svg)](https://packagist.org/packages/caridea/dao)
[![Build Status](https://travis-ci.org/libreworks/caridea-dao.svg)](https://travis-ci.org/libreworks/caridea-dao)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/libreworks/caridea-dao/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/libreworks/caridea-dao/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/libreworks/caridea-dao/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/libreworks/caridea-dao/?branch=master)
[![Documentation Status](http://readthedocs.org/projects/caridea-dao/badge/?version=latest)](http://caridea-dao.readthedocs.io/en/latest/?badge=latest)

## Installation

You can install this library using Composer:

```console
$ composer require caridea/dao
```

* The master branch (version 3.x) of this project requires PHP 7.1 and depends on `caridea/event`.
* Version 2.x of this project requires PHP 7.0 and depends on `caridea/event`.

## Compliance

Releases of this library will conform to [Semantic Versioning](http://semver.org).

Our code is intended to comply with [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/), and [PSR-4](http://www.php-fig.org/psr/psr-4/). If you find any issues related to standards compliance, please send a pull request!

## Documentation

* Head over to [Read the Docs](http://caridea-dao.readthedocs.io/en/latest/)

## Features

We provide a mechanism to translate vendor-specific exceptions (right now, MongoDB and Doctrine exceptions) into a standard exception hierarchy.

* `Conflicting` – An exception for concurrency failures.
* `Inoperable` – An exception for invalid API usage and configuration problems.
* `Locked` – An exception for unwritable records.
* `Unreachable` – An exception for connection problems.
* `Unretrievable` – An exception for unexpected results, for instance no results or too many results.
* `Violating` – An exception for constraint violations.
   * `Duplicative` – An exception for unique constraint violations.
* When all else fails, there's `Generic`.

We also provide abstract DAOs that allow you to make calls against your persistence API and have exceptions translated automatically.

```php
class MyDao extends \Caridea\Dao\MongoDb
{
    public function create($record)
    {
        $this->logger->info("Creating the record");
        $this->doExecute(function ($manager, $collection) use ($record) {
            $bulk = new \MongoDB\Driver\BulkWrite();
            $bulk->insert($record);
            return $manager->executeBulkWrite($collection, $bulk);
        });
    }
}
```
