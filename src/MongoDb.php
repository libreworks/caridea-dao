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
 * @copyright 2015-2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
namespace Caridea\Dao;

use MongoDB\Driver\Manager;

/**
 * An abstract Data Access Object for MongoDb.
 *
 * Requires the `mongodb` extension.
 *
 * @copyright 2015-2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
abstract class MongoDb extends Dao
{
    /**
     * @var \MongoDB\Driver\Manager The driver manager
     */
    protected $manager;
    /**
     *
     * @var string The collection name
     */
    protected $collection;

    /**
     * Creates a new MongoDB DAO.
     *
     * @param \MongoDB\Driver\Manager $manager The MongoDB driver manager
     * @param string $collection The collection name (e.g. `database.collection`)
     * @param \Psr\Log\LoggerInterface $logger A logger
     */
    public function __construct(Manager $manager, string $collection, \Psr\Log\LoggerInterface $logger = null)
    {
        parent::__construct($logger);
        $this->manager = $manager;
        $this->collection = $collection;
    }

    /**
     * Executes something in the context of the collection.
     *
     * Exceptions are caught and translated.
     *
     * @param callable $cb The closure to execute, takes the entityManager and collection
     * @return mixed Whatever the function returns, this method also returns
     * @throws \Caridea\Dao\Exception If a database problem occurs
     * @see \Caridea\Dao\Exception\Translator\MongoDb
     */
    protected function doExecute(\Closure $cb)
    {
        try {
            return $cb($this->manager, $this->collection);
        } catch (\Exception $e) {
            throw Exception\Translator\MongoDb::translate($e);
        }
    }
}
