<?hh

namespace Caridea\Dao;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class Doctrine2 extends Dao
{
    protected EntityManager $manager;
    protected string $entityName;
    protected EntityRepository $repository;

    public function __construct(EntityManager $manager, string $entityName, ?\Psr\Log\LoggerInterface $logger = null)
    {
        parent::__construct($logger);
        $this->manager = $manager;
        $this->entityName = $entityName;
        $this->repository = $manager->getRepository($entityName);
    }

    protected function doExecute<Ta>((function(EntityManager): Ta) $cb): Ta
    {
        return $cb($this->manager);
    }

    protected function doExecuteInRepository<Ta>((function(EntityRepository): Ta) $cb): Ta
    {
        return $cb($this->repository);
    }
}
