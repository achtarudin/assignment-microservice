<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    /**
     * Auth Login Test
     *
     * @return void
     */
    public function test_user_can_login_with_their_credential()
    {
        $this->post('login');

        $this->assertEquals(
            'login',
            $this->response->getContent()
        );
    }

    /**
     * Auth Registration Test
     *
     * @return void
     */
    public function test_user_can_registration()
    {
        $this->post('registration');

        $this->assertEquals(
            'registration',
            $this->response->getContent()
        );
    }

    /**
     * Auth Logout Test
     *
     * @return void
     */
    public function test_user_can_logout()
    {
        $this->post('logout');

        $this->assertEquals(
            'logout',
            $this->response->getContent()
        );
    }
}
