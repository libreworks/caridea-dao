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
namespace Caridea\Dao\Exception\Translator;

/**
 * Translates MongoDB driver exceptions
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
class MongoDb
{
    /**
     * Translates a MongoDB exception.
     *
     * @param \Exception $e The exception to translate
     * @return \Exception The exception to use
     */
    public static function translate(\Exception $e): \Exception
    {
        if ($e instanceof \MongoDB\Driver\Exception\ConnectionException ||
                $e instanceof \MongoDB\Driver\Exception\ExecutionTimeoutException) {
            return new \Caridea\Dao\Exception\Unreachable("System unreachable or connection timed out", $e->getCode(), $e);
        } elseif ($e instanceof \MongoDB\Driver\Exception\InvalidArgumentException ||
                $e instanceof \MongoDB\Driver\Exception\LogicException ||
                $e instanceof \MongoDB\Exception\BadMethodCallException) {
            return new \Caridea\Dao\Exception\Inoperable("Invalid API usage", $e->getCode(), $e);
        } elseif ($e instanceof \MongoDB\GridFS\Exception\FileNotFoundException ||
                $e instanceof \MongoDB\GridFS\Exception\CorruptFileException) {
            return new \Caridea\Dao\Exception\Unretrievable("Data could not be retrieved", $e->getCode(), $e);
        } elseif ($e instanceof \MongoDB\Driver\Exception\RuntimeException &&
                ($e->getCode() == 11000 || 'E11000' == substr($e->getMessage(), 0, 6))) {
            return new \Caridea\Dao\Exception\Duplicative("Unique constraint violation", 409, $e);
        } elseif ($e instanceof \MongoDB\Driver\Exception\BulkWriteException &&
                $e->getMessage() == 'Document failed validation') {
            return new \Caridea\Dao\Exception\Violating("Constraint violation", 422, $e);
        }
        return new \Caridea\Dao\Exception\Generic("Uncategorized database error", 0, $e);
    }
}
