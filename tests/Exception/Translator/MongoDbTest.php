<?php
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
 * Generated by hand
 * @requires extension mongodb
 * @covers \Caridea\Dao\Exception\Translator\MongoDb::translate
 */
class MongoDbTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Caridea\Dao\Exception\Unreachable
     * @expectedException \Caridea\Dao\Exception\Unreachable
     * @expectedExceptionMessage System unreachable or connection timed out
     * @expectedExceptionCode 123
     */
    public function testUnreachable1()
    {
        throw MongoDb::translate(new \MongoDB\Driver\Exception\ConnectionException("Failed", 123));
    }

    /**
     * @covers \Caridea\Dao\Exception\Unreachable
     * @expectedException \Caridea\Dao\Exception\Unreachable
     * @expectedExceptionMessage System unreachable or connection timed out
     * @expectedExceptionCode 123
     */
    public function testUnreachable2()
    {
        throw MongoDb::translate(new \MongoDB\Driver\Exception\ExecutionTimeoutException("Failed", 123));
    }

    /**
     * @covers \Caridea\Dao\Exception\Inoperable
     * @expectedException \Caridea\Dao\Exception\Inoperable
     * @expectedExceptionMessage Invalid API usage
     * @expectedExceptionCode 345
     */
    public function testInoperable1()
    {
        throw MongoDb::translate(new \MongoDB\Driver\Exception\InvalidArgumentException("Failed", 345));
    }

    /**
     * @covers \Caridea\Dao\Exception\Inoperable
     * @expectedException \Caridea\Dao\Exception\Inoperable
     * @expectedExceptionMessage Invalid API usage
     * @expectedExceptionCode 345
     */
    public function testInoperable2()
    {
        throw MongoDb::translate(new \MongoDB\Driver\Exception\LogicException("Failed", 345));
    }

    /**
     * @covers \Caridea\Dao\Exception\Inoperable
     * @expectedException \Caridea\Dao\Exception\Inoperable
     * @expectedExceptionMessage Invalid API usage
     * @expectedExceptionCode 345
     */
    public function testInoperable3()
    {
        throw MongoDb::translate(new \MongoDB\Exception\BadMethodCallException("Failed", 345));
    }

    /**
     * @covers \Caridea\Dao\Exception\Unretrievable
     * @expectedException \Caridea\Dao\Exception\Unretrievable
     * @expectedExceptionMessage Data could not be retrieved
     * @expectedExceptionCode 456
     */
    public function testUnretrievable1()
    {
        throw MongoDb::translate(new \MongoDB\GridFS\Exception\FileNotFoundException("Failed", 456));
    }

    /**
     * @covers \Caridea\Dao\Exception\Unretrievable
     * @expectedException \Caridea\Dao\Exception\Unretrievable
     * @expectedExceptionMessage Data could not be retrieved
     * @expectedExceptionCode 456
     */
    public function testUnretrievable2()
    {
        throw MongoDb::translate(new \MongoDB\GridFS\Exception\CorruptFileException("Failed", 456));
    }

    /**
     * @covers \Caridea\Dao\Exception\Duplicative
     * @expectedException \Caridea\Dao\Exception\Duplicative
     * @expectedExceptionMessage Unique constraint violation
     * @expectedExceptionCode 409
     */
    public function testDuplicative1()
    {
        throw MongoDb::translate(new \MongoDB\Driver\Exception\BulkWriteException("Failed", 11000));
    }

    /**
     * @covers \Caridea\Dao\Exception\Duplicative
     * @expectedException \Caridea\Dao\Exception\Duplicative
     * @expectedExceptionMessage Unique constraint violation
     * @expectedExceptionCode 409
     */
    public function testDuplicative2()
    {
        throw MongoDb::translate(new \MongoDB\Driver\Exception\BulkWriteException("E11000", 0));
    }

    /**
     * @covers \Caridea\Dao\Exception\Violating
     * @expectedException \Caridea\Dao\Exception\Violating
     * @expectedExceptionMessage Constraint violation
     * @expectedExceptionCode 422
     */
    public function testViolating()
    {
        throw MongoDb::translate(new \MongoDB\Driver\Exception\BulkWriteException("Document failed validation", 0));
    }

    /**
     * @covers \Caridea\Dao\Exception\Generic
     * @expectedException \Caridea\Dao\Exception\Generic
     * @expectedExceptionMessage Uncategorized database error
     * @expectedExceptionCode 0
     */
    public function testGeneric()
    {
        throw MongoDb::translate(new \MongoDB\Driver\Exception\BulkWriteException("No idea dude", 0));
    }
}