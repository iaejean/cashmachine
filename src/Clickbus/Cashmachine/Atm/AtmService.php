<?php
/**
 * Copyright 2016 iaejean
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 * @package  Clickbus\Cashmachine
 * @author   Israel Hernández Valle
 * @license  http://iaejea.github.com/ Apache License 2.0
 */
namespace Clickbus\Cashmachine\Atm;

use Clickbus\Cashmachine\Exception\InvalidArgumentException;
use Clickbus\Cashmachine\Exception\NoteUnavailableException;

/**
 * Copyright 2016 iaejean
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 * @package  Clickbus\Cashmachine\Atm
 * @author   Israel Hernández Valle
 * @license  http://iaejea.github.com/ Apache License 2.0
 */
class AtmService
{
    /**
     * @var  AtmService $_instance
     */
    private static $_instance;
    /**
     * @var  Atm $_atm
     */
    private $_atm;
    /**
     * @var  array $_response
     */
    private $_response;

    /**
     * Class Constructor
     */
    private function __construct()
    {
        $this->_atm = new Atm();
    }

    /**
     * For a Singleton patter int class
     */
    public static function getInstance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        }

        return self::$_instance = new self();
    }

    /**
     * Return array with de denomination billets
     *
     * @param int $amount
     * @return array
     */
    public function withdraw($amount)
    {
        $this->_response = [];

        if ($amount < 0) {
            throw new InvalidArgumentException(
                "No valid value, please try it again!"
            );
        }

        $this->isDivibleByMin($amount);

        foreach ($this->_atm->getListBilletDenominations() as $item) {
            while ($this->getBilletByDenomination(
                    $amount,
                    $item->getDenomination())
                ) {
                array_push($this->_response, $item->getDenomination());
                $amount-= $item->getDenomination();
            }
        }

        return $this->_response;
    }

    /**
     * Return true if the amount is divisible by de min billet denomination
     *
     * @param $amount
     * @return  bool
     * @throws NoteUnavailableException
     */
    private function isDivibleByMin($amount)
    {
        if (!is_int($amount / $this->_atm->getMinDenomination())) {
            throw new NoteUnavailableException(
                "No valid operation, please try it again!"
            );
        }
    }

    /**
     * Return true if the amount could provide other billet
     *
     * @param $amount
     * @param $denomination
     * @return  bool
     */
    private function getBilletByDenomination($amount, $denomination)
    {
        return (($amount - $denomination) >= 0);
    }
}
