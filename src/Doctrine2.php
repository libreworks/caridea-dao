<?php
declare(strict_types=1);
/**
 * Caridea
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
namespace Caridea\Dao;

use Doctrine\ORM\EntityManager;

/**
 * An abstract Data Access Object for the Doctrine ORM library.
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
abstract class Doctrine2 extends Dao
{
    /**
     * @var \Doctrine\ORM\EntityManager The entity manager
     */
    protected $manager;
    /**
     * @var string
     */
    protected $entityName;
    /**
     * @var \Doctrine\ORM\EntityRepository The entity repository
     */
    protected $repository;

    /**
     * Creates a new MongoDB DAO.
     *
     * @param \Doctrine\ORM\EntityManager $manager The entity manager
     * @param string $entityName The entity name
     * @param \Psr\Log\LoggerInterface $logger A logger
     */
    public function __construct(EntityManager $manager, string $entityName, \Psr\Log\LoggerInterface $logger = null)
    {
        parent::__construct($logger);
        $this->manager = $manager;
        $this->entityName = $entityName;
        $this->repository = $manager->getRepository($entityName);
    }

    /**
     * Executes something in the context of the entityManager.
     *
     * Exceptions are caught and translated.
     *
     * @param Closure $cb The closure to execute, takes the entityManager
     * @return mixed whatever the function returns, this method also returns
     * @throws \Caridea\Dao\Exception If a database problem occurs
     * @see \Caridea\Dao\Exception\Translator\Doctrine
     */
    protected function doExecute(\Closure $cb)
    {
        try {
            return $cb($this->manager);
        } catch (\Exception $e) {
            throw Exception\Translator\Doctrine::translate($e);
        }
    }

    /**
     * Executes something in the context of the entityRepository.
     *
     * Exceptions are caught and translated.
     *
     * @param Closure $cb The closure to execute, takes the entityRepository
     * @return mixed whatever the function returns, this method also returns
     * @throws \Caridea\Dao\Exception If a database problem occurs
     * @see \Caridea\Dao\Exception\Translator\Doctrine
     */
    protected function doExecuteInRepository(\Closure $cb)
    {
        try {
            return $cb($this->repository);
        } catch (\Exception $e) {
            throw Exception\Translator\Doctrine::translate($e);
        }
    }
}
