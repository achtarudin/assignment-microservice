<?php

namespace Tests;

use Faker\Factory;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseMigrations;
    // DatabaseTransactions

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

    public function test_registration_validation_error_without_name()
    {
        $faker = Factory::create();

        $response = $this->call('POST', 'registration', [
            'name'      => '',
            'email'     => $faker->email,
            'password'  => $faker->password,
        ]);

        $response->assertJsonValidationErrors('name', $responseKey = null);
    }

    public function test_registration_validation_error_without_email()
    {
        $faker = Factory::create();

        $response = $this->call('POST', 'registration', [
            'name'      => $faker->name,
            'email'     => '',
            'password'  => $faker->password,
        ]);

        $response->assertJsonValidationErrors('email', null);
    }

    public function test_registration_validation_error_without_password()
    {
        $faker = Factory::create();

        $response = $this->call('POST', 'registration', [
            'name'      => $faker->name,
            'email'     => $faker->email,
            'password'  => '21',
        ]);
        $response->assertJsonValidationErrors('password', null);
    }


    public function test_user_can_registration_without_errors()
    {
        $faker = Factory::create();

        $email = $faker->email;
        $name = $faker->name;

        $response = $this->call('POST', 'registration', [
            'name'      => $name,
            'email'     => $email,
            'password'  =>  $faker->password,
        ]);

        $this->assertEquals(200, $response->status());
        $this->seeInDatabase('users', ['email' => $email, 'name' => $name])->assertResponseOk();
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
