<?php

/*
 * Licensed to Elasticsearch B.V. under one or more contributor
 * license agreements. See the NOTICE file distributed with
 * this work for additional information regarding copyright
 * ownership. Elasticsearch B.V. licenses this file to you under
 * the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

declare(strict_types=1);

namespace ElasticApmTests\Util;

use Elastic\Apm\Impl\BackendComm\SerializationUtil;
use Elastic\Apm\Impl\Clock;
use Elastic\Apm\Impl\Log\LoggingSubsystem;
use ElasticApmTests\ComponentTests\Util\AmbientContextForTests;
use PHPUnit\Runner\BeforeTestHook;

/**
 * Code in this file is part of implementation internals and thus it is not covered by the backward compatibility.
 *
 * @internal
 */
abstract class PhpUnitExtensionBase implements BeforeTestHook
{
    /** @var float */
    public static $timestampBeforeTest;

    /** @var ?float */
    public static $timestampAfterTest = null;

    public function __construct(string $dbgProcessName)
    {
        LoggingSubsystem::$isInTestingContext = true;
        SerializationUtil::$isInTestingContext = true;

        AmbientContextForTests::init($dbgProcessName);
    }

    public function executeBeforeTest(string $test): void
    {
        self::$timestampBeforeTest = Clock::singletonInstance()->getSystemClockCurrentTime();
        self::$timestampAfterTest = null;
        TransactionDataExpectations::setDefaults();
    }
}
