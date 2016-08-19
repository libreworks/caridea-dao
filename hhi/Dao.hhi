<?hh // strict

namespace Caridea\Dao;

abstract class Dao
{
    use \Psr\Log\LoggerAwareTrait;

    public function __construct(?\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger ?? new \Psr\Log\NullLogger();
    }
}
