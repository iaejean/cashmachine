<?php
use Clickbus\CashMachine\Atm\Atm;
use Clickbus\CashMachine\Atm\AtmService;

/**
 * Class Test fot ATM Serivce
 *
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
 * @package     Test
 * @subpackage  Clickbus\Cashmachine
 * @author      Israel Hernández Valle
 * @license     http://iaejea.github.com/ Apache License 2.0
 */
class TestAtmservice extends PHPUnit_Framework_TestCase
{
    use TTest;

    /**
     * @test
     */
    public function test1()
    {
        $atmService = AtmService::getInstance();

        $cash = $atmService->withdraw(30);
        //var_dump($cash);
        $this->assertContains(10, $cash);
        $this->assertContains(20, $cash);

        $cash = $atmService->withdraw(80);
        //var_dump($cash);
        $this->assertContains(10, $cash);
        $this->assertContains(20, $cash);
        $this->assertContains(50, $cash);

        $cash = $atmService->withdraw(100);
        //var_dump($cash);
        $this->assertContains(100, $cash);

        $cash = $atmService->withdraw(110);
        //var_dump($cash);
        $this->assertContains(100, $cash);
        $this->assertContains(10, $cash);

        $cash = $atmService->withdraw(120);
        //var_dump($cash);
        $this->assertContains(100, $cash);
        $this->assertContains(20, $cash);

        $cash = $atmService->withdraw(130);
        //var_dump($cash);
        $this->assertContains(100, $cash);
        $this->assertContains(20, $cash);
        $this->assertContains(10, $cash);

        $cash = $atmService->withdraw(140);
        //var_dump($cash);
        $this->assertContains(100, $cash);
        $this->assertContains(20, $cash);

        $cash = $atmService->withdraw(200);
        //var_dump($cash);
        $this->assertContains(100, $cash);

        $cash = $atmService->withdraw(null);
        //var_dump($cash);
        $this->assertEmpty($cash);
    }

    /**
     * @test
     * @expectedException   Clickbus\Cashmachine\Exception\NoteUnavailableException
     */
    public function test2()
    {
        $atmService = AtmService::getInstance();
        $cash       = $atmService->withdraw(125);
    }

    /**
     * @test
     * @expectedException   Clickbus\Cashmachine\Exception\InvalidArgumentException
     */
    public function test4()
    {
        $atmService = AtmService::getInstance();
        $cash       = $atmService->withdraw(-130);
    }
}
