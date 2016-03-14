<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Mexico_City');

require_once realpath(__DIR__."/../../../../../../../dependencies/vendor/autoload.php");

/**
 * Trait for Test Class
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
 * @author      Israel Hernández Valle
 * @license     http://iaejea.github.com/ Apache License 2.0
 */
trait TTest
{
    /**
     * To test private methods
     *
     * @param  mixed   $object
     * @param  string  $methodName
     * @param  array   $params
     * @return mixed
     */
    public function privateMethod($object, $methodName, array $params = array())
    {
        $refelctionClass  = new ReflectionClass($object);
        $reflectionMethod = $refelctionClass->getMethod($methodName);
        $reflectionMethod->setAccessible(true);
        return $reflectionMethod->invokeArgs($object, $params);
    }
}
