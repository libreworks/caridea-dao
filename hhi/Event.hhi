<?hh // strict

namespace Caridea\Dao;

abstract class Event<Ts,To> extends \Caridea\Event\Event<Ts>
{
    private To $entity;

    public function __construct(Ts $source, To $entity)
    {
        parent::__construct($source);
        $this->entity = $entity;
    }

    public function getEntity(): To
    {
        return $this->entity;
    }
}
