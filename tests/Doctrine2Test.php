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
namespace Caridea\Dao;

/**
 * Generated by hand
 */
class Doctrine2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Caridea\Dao\Dao::__construct
     * @covers \Caridea\Dao\Doctrine2::__construct
     * @covers \Caridea\Dao\Doctrine2::doExecute
     */
    public function testBasic()
    {
        $manager = $this->createMock(\Doctrine\ORM\EntityManager::class);
        $repo = $this->createMock(\Doctrine\ORM\EntityRepository::class);
        $manager->method('getRepository')->willReturn($repo);
        $entityName = "foobar";
        $object = $this->getMockBuilder(Doctrine2::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs([$manager, $entityName])
            ->setMethods([])
            ->getMock();
        $ro = new \ReflectionObject($object);
        $rm = $ro->getMethod('doExecute');
        $rm->setAccessible(true);
        $output = $rm->invoke($object, function ($m) use ($manager) {
            $this->assertSame($manager, $m);
            return "Hello";
        });
        $this->assertEquals('Hello', $output);
        $this->verifyMockObjects();
    }

    /**
     * @covers \Caridea\Dao\Dao::__construct
     * @covers \Caridea\Dao\Doctrine2::__construct
     * @covers \Caridea\Dao\Doctrine2::doExecute
     * @covers \Caridea\Dao\Exception\Translator\Doctrine::translate
     * @expectedException \Caridea\Dao\Exception\Generic
     * @expectedExceptionMessage Uncategorized database error
     */
    public function testException()
    {
        $manager = $this->createMock(\Doctrine\ORM\EntityManager::class);
        $repo = $this->createMock(\Doctrine\ORM\EntityRepository::class);
        $manager->method('getRepository')->willReturn($repo);
        $entityName = "foobar";
        $object = $this->getMockBuilder(Doctrine2::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs([$manager, $entityName])
            ->setMethods([])
            ->getMock();
        $ro = new \ReflectionObject($object);
        $rm = $ro->getMethod('doExecute');
        $rm->setAccessible(true);
        $rm->invoke($object, function ($m) use ($manager) {
            $this->assertSame($manager, $m);
            throw new \RuntimeException();
        });
    }

    /**
     * @covers \Caridea\Dao\Dao::__construct
     * @covers \Caridea\Dao\Doctrine2::__construct
     * @covers \Caridea\Dao\Doctrine2::doExecuteInRepository
     */
    public function testBasicRepo()
    {
        $manager = $this->createMock(\Doctrine\ORM\EntityManager::class);
        $repo = $this->createMock(\Doctrine\ORM\EntityRepository::class);
        $manager->method('getRepository')->willReturn($repo);
        $entityName = "foobar";
        $object = $this->getMockBuilder(Doctrine2::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs([$manager, $entityName])
            ->setMethods([])
            ->getMock();
        $ro = new \ReflectionObject($object);
        $rm = $ro->getMethod('doExecuteInRepository');
        $rm->setAccessible(true);
        $output = $rm->invoke($object, function ($r) use ($repo) {
            $this->assertSame($repo, $r);
            return "Hello";
        });
        $this->assertEquals('Hello', $output);
        $this->verifyMockObjects();
    }

    /**
     * @covers \Caridea\Dao\Dao::__construct
     * @covers \Caridea\Dao\Doctrine2::__construct
     * @covers \Caridea\Dao\Doctrine2::doExecuteInRepository
     * @covers \Caridea\Dao\Exception\Translator\Doctrine::translate
     * @expectedException \Caridea\Dao\Exception\Generic
     * @expectedExceptionMessage Uncategorized database error
     */
    public function testExceptionRepo()
    {
        $manager = $this->createMock(\Doctrine\ORM\EntityManager::class);
        $repo = $this->createMock(\Doctrine\ORM\EntityRepository::class);
        $manager->method('getRepository')->willReturn($repo);
        $entityName = "foobar";
        $object = $this->getMockBuilder(Doctrine2::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs([$manager, $entityName])
            ->setMethods([])
            ->getMock();
        $ro = new \ReflectionObject($object);
        $rm = $ro->getMethod('doExecuteInRepository');
        $rm->setAccessible(true);
        $rm->invoke($object, function ($r) use ($repo) {
            $this->assertSame($repo, $r);
            throw new \RuntimeException();
        });
    }
}

namespace Doctrine\ORM;

if (!class_exists('Doctrine\ORM\EntityManager')) {
    class EntityManager
    {
        public function getRepository($name) {}
    }
}
if (!class_exists('Doctrine\ORM\EntityRepository')) {
    class EntityRepository
    {
    }
}