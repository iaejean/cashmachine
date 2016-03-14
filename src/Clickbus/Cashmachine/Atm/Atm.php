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
namespace Clickbus\CashMachine\Atm;

use Clickbus\CashMachine\Billet\Billet;

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
class Atm
{
    /**
     * @var array $listBilletDenominations Content array with the definition of diferents billets denominations
     */
    private $listBilletDenominations = [];

    /**
     * Class Constructor
     */
    public function __construct()
    {
        $this->addBilletDenomination(new Billet(10))
             ->addBilletDenomination(new Billet(20))
             ->addBilletDenomination(new Billet(50))
             ->addBilletDenomination(new Billet(100))
             ->orderList();
    }

    /**
     * Indicate if the ATM has a denomination billet
     *
     * @param  Billet $billet
     * @return bool
     */
    public function hasBilletDenomination(Billet $billet)
    {
        foreach ($this->listBilletDenominations as $item) {
            if ($item->getDenomination() == $billet->getDEnomination()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add a new billet denomination to the ATM
     *
     * @param  Billet $billet
     * @return Atm
     */
    public function addBilletDenomination(Billet $billet)
    {
        array_push($this->listBilletDenominations, $billet);
        return $this;
    }

    /**
     * Return the min value for a denomination billet
     *
     * @return int
     */
    public function getMinDenomination()
    {
        $min = $this->listBilletDenominations[0]->getDenomination();

        foreach ($this->listBilletDenominations as $item) {
            if ($min > $item->getDenomination()) {
                $min = $item->getDenomination();
            }
        }

        return $min;
    }

    /**
     * Return the max value for a denomination billet
     *
     * @return int
     */
    public function getMaxDenomination()
    {
        $max = 0;

        foreach ($this->listBilletDenominations as $item) {
            if ($max < $item->getDenomination()) {
                $max = $item->getDenomination();
            }
        }

        return $max;
    }

    /**
     * Order the list of billetm, first the billet with most value
     *
     * @return void
     */
    private function orderList()
    {
        $aux = [];

        foreach ($this->listBilletDenominations as $item) {
            array_push($aux, $item->getDenomination());
        }

        rsort($aux);

        foreach ($aux as $key => $item) {
            $this->listBilletDenominations[$key]->setDenomination($item);
        }
    }

    /**
     * Return the list of billets denomination in the Atm
     *
     * @return array
     */
    public function getListBilletDenominations()
    {
        return $this->listBilletDenominations;
    }
}
