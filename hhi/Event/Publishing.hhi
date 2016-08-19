<?hh // strict

namespace Caridea\Dao\Event;

trait Publisher
{
    protected \Caridea\Event\Publisher $publisher;

    protected function preDelete<T>(T $entity): void
    {
    }

    protected function postDelete<T>(T $entity): void
    {
    }

    protected function preInsert<T>(T $entity): void
    {
    }

    protected function postInsert<T>(T $entity): void
    {
    }

    protected function preUpdate<T>(T $entity): void
    {
    }

    protected function postUpdate<T>(T $entity): void
    {
    }
}
