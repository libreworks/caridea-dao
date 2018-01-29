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
namespace Caridea\Dao\Event;

/**
 * Publishes events.
 *
 * We don't build this into the DAO itself because your persistence layer may
 * implement an event system. Duplicity is bad!
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
trait Publishing
{
    use \Caridea\Event\PublisherSetter;

    /**
     * Sends a pre-delete event.
     *
     * @param array|object $entity - The event entity
     */
    protected function preDelete($entity)
    {
        $this->publisher->publish(new PreDelete($this, $entity));
    }

    /**
     * Sends a post-delete event.
     *
     * @param array|object $entity - The event entity
     */
    protected function postDelete($entity)
    {
        $this->publisher->publish(new PostDelete($this, $entity));
    }

    /**
     * Sends a pre-insert event.
     *
     * @param array|object $entity - The event entity
     */
    protected function preInsert($entity)
    {
        $this->publisher->publish(new PreInsert($this, $entity));
    }

    /**
     * Sends a post-insert event.
     *
     * @param array|object $entity - The event entity
     */
    protected function postInsert($entity)
    {
        $this->publisher->publish(new PostInsert($this, $entity));
    }

    /**
     * Sends a pre-update event.
     *
     * @param array|object $entity - The event entity
     */
    protected function preUpdate($entity)
    {
        $this->publisher->publish(new PreUpdate($this, $entity));
    }

    /**
     * Sends a post-update event.
     *
     * @param array|object $entity - The event entity
     */
    protected function postUpdate($entity)
    {
        $this->publisher->publish(new PostUpdate($this, $entity));
    }
}
