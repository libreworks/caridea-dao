# Abstract DAO Classes

This library comes with two super-classes to be extended by your own projects:

* `Caridea\Dao\Doctrine2` – designed for the popular [Doctrine ORM library](http://www.doctrine-project.org/)
* `Caridea\Dao\MongoDb` – designed for the popular [MongoDB library](https://github.com/mongodb/mongo-php-library)

They both extend from `Caridea\Dao\Dao`, which is an abstract class that implements `Psr\Log\LoggerAwareInterface`.

## Doctrine

The Doctrine DAO constructor takes the `Doctrine\ORM\EntityManager`, the name of the entity, and an optional `Psr\Log\LoggerInterface`. Once created, the following protected properties are available to subclasses:

* `$manager` – The `EntityManager` you provided
* `$entityName` – The `string` entity name you provided
* `$repository` – A `Doctrine\ORM\EntityRepository` retrieved from the `EntityManager`
* `$logger` – A `Psr\Log\LoggerInterface`, guaranteed to be non-null

There are also two very useful protected methods available to subclasses.

### The doExecute Method

The `doExecute` method accepts a `Closure` that gets passed the `EntityManager`.

If an exception occurs while your function is being executed, it's translated and wrapped by one of the exceptions included in this library.

```php
class MyDao extends \Caridea\Dao\Doctrine2
{
    public function create($record)
    {
        $this->logger->info("Creating the record");
        $this->doExecute(function ($manager) use ($record) {
            $manager->persist($record);
            $manager->flush();
        });
    }
}
```

### The doExecuteInRepository Method

Similarly, the `doExecuteInRepository` method accepts a `Closure` that gets passed the `EntityRepository`.

If an exception occurs while your function is being executed, it's translated and wrapped by one of the exceptions included in this library.

```php
class MyDao extends \Caridea\Dao\Doctrine2
{
    public function find($id)
    {
        return $this->doExecuteInRepository(function ($repository) {
            return $repository->find($id);
        });
    }
}
```

## MongoDB

The MongoDB DAO constructor takes the `MongoDB\Driver\Manager`, the name of the collection, and an optional `Psr\Log\LoggerInterface`. Once created, the following protected properties are available to subclasses:

* `$manager` – The `Manager` you provided
* `$collection` – The `string` collection name you provided
* `$logger` – A `Psr\Log\LoggerInterface`, guaranteed to be non-null

There are also a very useful protected method available to subclasses.

### The doExecute Method

The `doExecute` method accepts a `Closure` that gets passed the `Manager` and collection name.

If an exception occurs while your function is being executed, it's translated and wrapped by one of the exceptions included in this library.

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
