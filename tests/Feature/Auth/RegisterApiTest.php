<?php

use Pest\Support\Str;

test('User can register with valid credentials', function(){

    $response = $this->postJson('/api/register',[

        'name' => "Kox",
        'email' => 'kox@example.com',
        'password' => 'password',
        'password_confirmation' => 'password'

    ]);

    $response->assertStatus(204)
        ->assertNoContent();


});

test('User cannot register with invalid name', function(){

    $response = $this->postJson('/api/register',[

        'name' => Str::random(256), // 255 is maximum length
        'email' => 'kox@example.com',
        'password' => 'password',
        'password_confirmation' => 'password'

    ]);

    $response->assertStatus(422)
        ->assertJsonStructure([

            "message",
            "errors" => [

                "name"

            ]

        ])
        ->assertJsonValidationErrors(['name']);
    

});

test('User cannot register with invalid email', function(){

    $response = $this->postJson('/api/register',[

        'name' => "Kox",
        'email' => 'kox-example.com', // - instead of @
        'password' => 'password',
        'password_confirmation' => 'password'

    ]);

    $response->assertStatus(422)
        ->assertJsonStructure([

            "message",
            "errors" => [

                "email"

            ]

        ])
        ->assertJsonValidationErrors(['email']);
    

});

test('User cannot register with empty password',function(){

    $response = $this->postJson('/api/register',[

        'name' => "Kox",
        'email' => 'kox@example.com',
        'password' => '',
        'password_confirmation' => ''

    ]);

    $response->assertStatus(422)
    ->assertJsonStructure([

        "message",
        "errors" => [

            "password"

        ]

    ])
    ->assertJsonValidationErrors(['password']);


});

test('User cannot register with invalid password confirmation',function(){

    $response = $this->postJson('/api/register',[

        'email' => 'kox@example.com',
        'password' => 'password',
        'password_confirmation' => 'WrongConfirmation'

    ]);

    $response->assertStatus(422)
    ->assertJsonStructure([

        "message",
        "errors" => [

            "password"

        ]

    ])
    ->assertJsonValidationErrors(['password']);


});

test('Registration requires name field',function(){

    $response = $this->postJson('/api/register',[

        'email' => 'kox@example.com',
        'password' => 'password',
        'password_confirmation' => 'password'

    ]);

    $response->assertStatus(422)
    ->assertJsonStructure([

        "message",
        "errors" => [

            "name"

        ]

    ])
    ->assertJsonValidationErrors(['name']);


});

test('Registration requires email field',function(){

    $response = $this->postJson('/api/register',[

        'name' => "Kox",
        'password' => 'password',
        'password_confirmation' => 'password'

    ]);

    $response->assertStatus(422)
    ->assertJsonStructure([

        "message",
        "errors" => [

            "email"

        ]

    ])
    ->assertJsonValidationErrors(['email']);


});

test('Registration requires password field',function(){

    $response = $this->postJson('/api/register',[

        'name' => "Kox",
        'email' => 'kox@example.com',
        'password_confirmation' => 'password'

    ]);

    $response->assertStatus(422)
    ->assertJsonStructure([

        "message",
        "errors" => [

            "password"

        ]

    ])
    ->assertJsonValidationErrors(['password']);


});

test('Registration requires password_confirmation field',function(){

    $response = $this->postJson('/api/register',[

        'name' => "Kox",
        'email' => 'kox@example.com',
        'password_' => 'password'

    ]);

    $response->assertStatus(422)
    ->assertJsonStructure([

        "message",
        "errors" => [

            "password"

        ]

    ])
    ->assertJsonValidationErrors(['password']);


});