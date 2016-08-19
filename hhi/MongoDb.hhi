<?hh // strict

namespace Caridea\Dao;

use MongoDB\Driver\Manager;

abstract class MongoDb extends Dao
{
    protected Manager $manager;
    protected string $collection;

    public function __construct(Manager $manager, string $collection, ?\Psr\Log\LoggerInterface $logger = null)
    {
        parent::__construct($logger);
        $this->manager = $manager;
        $this->collection = $collection;
    }

    protected function doExecute<Ta>((function(Manager, string): Ta) $cb): Ta
    {
        return $cb($this->manager, $this->collection);
    }
}
