<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Clear the team_invitations table before each test
        \DB::table('team_invitations')->truncate();

        // Run migrations before each test
        $this->artisan('migrate');
    }
}
