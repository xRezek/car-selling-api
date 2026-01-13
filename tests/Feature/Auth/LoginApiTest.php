<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;


beforeEach(function(){

    $throttleKey = Str::transliterate(Str::lower('kox@example.com') . '|' . '127.0.0.1');
    RateLimiter::clear($throttleKey);

});

test('User can login with valid credentials via API', function () {
    
    $user = User::factory()->create([

        'email' => 'kox@example.com',
        'password' => Hash::make('password')

    ]);

    $response = $this->postJson('/api/login',[

        'email' => 'kox@example.com',
        'password' => 'password'

    ]);


    $response->assertStatus(200)
        ->assertJsonstructure([

            'user' => [

                'id',
                'name',
                'email'

            ],
            'token'

        ])
        ->assertJson([

            'user' => [

                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email

            ]

            ]);

    expect($response->json('token'))->not()->toBeEmpty();

    $this->assertAuthenticated();

});

test('user cannot login with incorrect email via api', function(){

    $user = User::factory()->create([

        'email' => 'kox@example.com',
        'password' => Hash::make('password')

    ]);

    $response = $this->postJson('/api/login',[

        'email' => 'kox@exampdle.com',
        'password' => 'password'

    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);

    $this->assertGuest();

});

test('User cannot login with incorrect password via api', function(){

    $user = User::factory()->create([

        'email' => 'kox@example.com',
        'password' => Hash::make('password')

    ]);

    $response = $this->postJson('/api/login',[

        'email' => 'kox@exampdle.com',
        'password' => 'WrongPassword'

    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);

    $this->assertGuest();

});

test('Login requires email field', function(){

    $response = $this->postJson('/api/login',[

        'password' => 'password'

    ]);

    $response->assertJsonValidationErrors(['email']);


});

test('Login requires password field', function(){

    $response = $this->postJson('/api/login',[

        'email' => 'kox@example.com',

    ]);

    $response->assertJsonValidationErrors(['password']);


});

test('Login requires valid email format',function(){

    $response = $this->postJson('/api/login',[

        'email' => 'email-in-incorret-format',
        'password' => 'WrongPassword'

    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);

});

test('Test throttling: Rate is limited after too many attempts', function(){

    $user = User::factory()->create([

        'email' => 'kox@example.com',
        'password' => Hash::make('password')

    ]);

    for($i = 0; $i < 5; $i++){

        $response = $this->postJson('/api/login',[

            'email' => 'kox@example.com',
            'password' => 'WrongPassword'

        ]);

    }

    $response = $this->postJson('/api/login',[

        'email' => 'kox@exampdle.com',
        'password' => 'WrongPassword'

    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);

});

test('Login works after rate limit expires', function(){

    $user = User::factory()->create([

        'email' => 'kox@example.com',
        'password' => Hash::make('password')

    ]);

    for($i = 0; $i < 5; $i++){

        $response = $this->postJson('/api/login',[

            'email' => 'kox@example.com',
            'password' => 'WrongPassword'

        ]);

    }

    $throttleKey = Str::transliterate(Str::lower('kox@example.com') . '|' . '127.0.0.1');
    RateLimiter::clear($throttleKey);

    $response = $this->postJson('/api/login',[

        'email' => 'kox@example.com',
        'password' => 'password'

    ]);

    $response->assertStatus(200)
    ->assertJsonstructure([

        'user' => [

            'id',
            'name',
            'email'

        ],
        'token'

    ])
    ->assertJson([

        'user' => [

            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email

        ]

    ]);

    expect($response->json('token'))->not()->toBeEmpty();

    $this->assertAuthenticated();

});

test('Test endpoint requires guest middleware', function(){

    $user = User::factory()->create();

    $response = $this->actingAs($user,'sanctum')
        ->postJson('/api/login',[

            'email' => 'kox@example.com',
            'password' => 'password'

        ]);

        $response->assertStatus(302);

});

test('Login response contains correct user data structure', function(){

    $user = User::factory()->create([

        'name' => 'Mr Bean',
        'email' => 'kox@example.com',
        'password' => Hash::make('password')

    ]);

    $response = $this->postJson('/api/login',[

        'email' => 'kox@example.com',
        'password' => 'password'

    ]);

    $response->assertStatus(200)
    ->assertJson([

        'user' => [

            'id' => $user->id,
            'name' => 'Mr Bean',
            'email' => 'kox@example.com',

        ]

    ]);

    $responseData = $response->json();
    expect($responseData['user'])->not->toHaveKey('password');
    expect($responseData['user'])->not->toHaveKey('remember_token');

});
