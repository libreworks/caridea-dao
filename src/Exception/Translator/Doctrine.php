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
namespace Caridea\Dao\Exception\Translator;

/**
 * Translates Doctrine ORM and ODM exceptions
 *
 * @copyright 2015-2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class Doctrine
{
    /**
     * Translates a Doctrine exception.
     *
     * @param \Exception $e The exception to translate
     * @return \Exception The exception to use
     */
    public static function translate(\Exception $e): \Exception
    {
        if ($e instanceof \Doctrine\ORM\EntityNotFoundException ||
                $e instanceof \Doctrine\ORM\UnexpectedResultException ||
                $e instanceof \Doctrine\ODM\MongoDB\DocumentNotFoundException ||
                $e instanceof \Doctrine\ODM\CouchDB\DocumentNotFoundException) {
            return new \Caridea\Dao\Exception\Unretrievable("Data could not be retrieved", 404, $e);
        } elseif ($e instanceof \Doctrine\ORM\PessimisticLockException ||
                $e instanceof \Doctrine\ORM\OptimisticLockException ||
                $e instanceof \Doctrine\ODM\CouchDB\OptimisticLockException) {
            return new \Caridea\Dao\Exception\Conflicting("Optimistic or pessimistic concurrency failure", 409, $e);
        } elseif ($e instanceof \Doctrine\ORM\Query\QueryException ||
                $e instanceof \Doctrine\ORM\Mapping\MappingException ||
                $e instanceof \Doctrine\Common\Persistence\Mapping\MappingException) {
            return new \Caridea\Dao\Exception\Inoperable("Invalid API usage", 0, $e);
        }
        return new \Caridea\Dao\Exception\Generic("Uncategorized database error", 0, $e);
    }
}
