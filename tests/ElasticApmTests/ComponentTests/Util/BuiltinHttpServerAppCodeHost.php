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

namespace ElasticApmTests\ComponentTests\Util;

use Elastic\Apm\ElasticApm;
use Elastic\Apm\Impl\Log\LoggableToString;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

final class BuiltinHttpServerAppCodeHost extends AppCodeHostBase
{
    use HttpServerProcessTrait;

    public function __construct()
    {
        if (self::isStatusCheck()) {
            // We don't want any of the testing infrastructure operations to be recorded as application's APM events
            ElasticApm::getCurrentTransaction()->discard();
        }

        parent::__construct();

        ($loggerProxy = $this->logger->ifDebugLevelEnabled(__LINE__, __FUNCTION__))
        && $loggerProxy->log(
            'Received request',
            ['URI' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']]
        );
    }

    protected static function isStatusCheck(): bool
    {
        return $_SERVER['REQUEST_URI'] === HttpServerHandle::STATUS_CHECK_URI;
    }

    protected function shouldRegisterThisProcessWithResourcesCleaner(): bool
    {
        // We should register with ResourcesCleaner only on the status-check request
        return self::isStatusCheck();
    }

    protected function processConfig(): void
    {
        TestCase::assertNotNull(
            AmbientContextForTests::testConfig()->dataPerProcess->thisServerPort,
            LoggableToString::convert(AmbientContextForTests::testConfig())
        );

        parent::processConfig();

        AmbientContextForTests::reconfigure(
            new RequestHeadersRawSnapshotSource(
                function (string $headerName): ?string {
                    $headerKey = 'HTTP_' . $headerName;
                    return array_key_exists($headerKey, $_SERVER) ? $_SERVER[$headerKey] : null;
                }
            )
        );
    }

    protected function runImpl(?string &$topLevelCodeId): void
    {
        $dataPerRequest = AmbientContextForTests::testConfig()->dataPerRequest;
        TestCase::assertNotNull($dataPerRequest);
        $response = self::verifySpawnedProcessId($dataPerRequest->spawnedProcessId);
        if ($response->getStatusCode() !== HttpConsts::STATUS_OK || self::isStatusCheck()) {
            self::sendResponse($response);
            return;
        }

        $this->callAppCode(/* ref */ $topLevelCodeId);
    }

    private static function sendResponse(ResponseInterface $response): void
    {
        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }
}
