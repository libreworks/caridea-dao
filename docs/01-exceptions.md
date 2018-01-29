# Exception Hierarchy

We provide a mechanism to translate vendor-specific exceptions into a standard exception hierarchy.

## Reason

It's all about separation of concerns and abstraction. Using the translation utilities in this library, you can wrap vendor-specific exceptions in these generic exceptions.

It decouples your persistence layer from the rest of your application. You can swap out the library you use to store data and not have to worry about changes in the rest of your application.

## Exception Classes

All of the following classes are in the `Caridea\Dao\Exception` namespace:

* `Inoperable` – An exception for invalid API usage and configuration problems (extends from `\LogicException`)
* `Transient` – An abstract super class for problems that might not occur a second time (extends from `\RuntimeException`)
  * `Conflicting` – An exception for concurrency failures
  * `Unreachable` – An exception for connection problems
* `Permanent` – An abstract super class for problems that will probably occur a second time (extends from `\RuntimeException`)
  * `Generic` – An exception for any other problem not covered elsewhere
  * `Locked` – An exception for unwritable records
  * `Unretrievable` – An exception for unexpected results, for instance no results or too many results
  * `Violating` – An exception for constraint violations
    * `Duplicative` – An exception for unique constraint violations

## Translators

We distribute two translation utilities with this library: one for the popular [Doctrine ORM library](http://www.doctrine-project.org/), the other for the popular [MongoDB library](https://github.com/mongodb/mongo-php-library).
