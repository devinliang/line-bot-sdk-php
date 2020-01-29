<?php
/**
 * Copyright 2020 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

namespace LINE\LINEBot\Narrowcast\DemographicFilter;

/**
 * A builder class for app type demographic filter
 *
 * @package LINE\LINEBot\Narrowcast\DemographicFilter
 */
class OperatorDemographicFilterBuilder extends DemographicFilterBuilder
{
    const TYPE = 'operator';

    /** @var string $operator */
    private $operator;

    /** @var DemographicFilterBuilder[] $children */
    private $children;

    /**
     * Set filters with 'and' operation
     *
     * @param DemographicFilterBuilder[] $demographicFilterBuilders
     * @return $this
     */
    public function setAnd($demographicFilterBuilders)
    {
        $this->operator = 'and';
        $this->children = $demographicFilterBuilders;
        return $this;
    }

    /**
     * Set filters with 'or' operation
     *
     * @param DemographicFilterBuilder[] $demographicFilterBuilders
     * @return $this
     */
    public function setOr($demographicFilterBuilders)
    {
        $this->operator = 'or';
        $this->children = $demographicFilterBuilders;
        return $this;
    }

    /**
     * Set filters with 'not' operation
     *
     * @param DemographicFilterBuilder[] $demographicFilterBuilders
     * @return $this
     */
    public function setNot($demographicFilterBuilders)
    {
        $this->operator = 'not';
        $this->children = $demographicFilterBuilders;
        return $this;
    }

    /**
     * Builds demographic filter
     *
     * @return array
     */
    public function build()
    {
        return [
            'type' => self::TYPE,
            $this->operator => array_map(function ($child) {
                return $child->build();
            }, $this->children)
        ];
    }
}
