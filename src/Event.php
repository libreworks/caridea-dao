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

/**
 * An abstract peristence event.
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
abstract class Event extends \Caridea\Event\Event
{
    private $entity;

    /**
     * Creates a new Dao Event.
     *
     * @param object $source
     * @param object|array $entity
     */
    public function __construct($source, $entity)
    {
        parent::__construct($source);
        $this->entity = $entity;
    }

    /**
     * Gets the entity associated with the event.
     *
     * @return object|array The event entity
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
