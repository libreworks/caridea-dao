# Events

This library includes several events that can be broadcast, and a trait you can use in your DAOs to broadcast these events.

## Event Classes

The following classes are all in the `Caridea\Dao\Event` namespace. They all extend from the `Caridea\Dao\Event` class, which includes a method: `getEntity` that returns the entity involved.

* `PreDelete` – To be broadcast before a delete event
* `PostDelete` – To be broadcast after a delete event
* `PreInsert` – To be broadcast before an insert event
* `PostInsert` – To be broadcast after an insert event
* `PreUpdate` – To be broadcast before an update event
* `PostUpdate` – To be broadcast after an update event

## Publishing Trait

The `Caridea\Dao\Event\Publishing` trait has methods your DAO can call that publish the above events. They all accept a single argument that is the entity involved.

* `preDelete` – publishes a `PreDelete` event
* `postDelete` – publishes a `PostDelete` event
* `preInsert` – publishes a `PreInsert` event
* `postInsert` – publishes a `PostInsert` event
* `preUpdate` – publishes a `PreUpdate` event
* `postUpdate` – publishes a `PostUpdate` event

Here's an example class that uses this trait:

```php
class MyDao extends \Caridea\Dao\MongoDb implements \Caridea\Event\PublisherAware
{
    use \Caridea\Dao\Event\Publishing;

    public function create($record)
    {
        $this->preInsert($record);
        $this->doExecute(function () {
            // do some persistence magic
        });
        $this->postInsert($record);
    }
}
```

When creating an instance of this class, you'd want to make sure to call `setPublisher`, or better yet, use [caridea/container](https://github.com/libreworks/caridea-container) to factory your DAO.

## But My Persistence Library Has Events…

Awesome! Don't use this trait, then! If your library (e.g. Doctrine) already handles events that occur to entities, then this trait becomes irrelevant.
