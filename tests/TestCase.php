<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    /**
     * RefreshDatabase drops and recreates every table, so the test suite must never be
     * pointed at a development or production database.
     *
     * The check runs here, right after the application is created and before any testing
     * trait (such as RefreshDatabase) is set up. A hook like beforeRefreshingDatabase() would
     * not work: RefreshDatabase defines its own empty version, and a trait method overrides
     * one inherited from this class.
     */
    public function createApplication()
    {
        $app = parent::createApplication();
        $this->assertSafeTestDatabase($app['config']);

        return $app;
    }

    protected function assertSafeTestDatabase($config): void
    {
        $name = $config->get('database.default');
        $connection = $config->get("database.connections.{$name}", []);
        $host = (string) ($connection['host'] ?? '');
        $database = (string) ($connection['database'] ?? '');

        $safe = $name === 'pgsql'
            && empty($connection['url'])
            && in_array($host, ['127.0.0.1', 'localhost', '::1'], true)
            && str_ends_with($database, '_test');

        if (! $safe) {
            throw new RuntimeException(sprintf(
                'Refusing to run tests against "%s" (connection %s, host %s): tests may only use a local PostgreSQL database whose name ends in "_test".',
                $database, $name, $host
            ));
        }
    }
}
