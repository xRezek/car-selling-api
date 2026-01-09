<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('User can login with valid credentials via API', function () {
    
    $user = User::factory()->create([

        'email' => 'kox@example.com',
        'password' => Hash::make('password')

    ]);

    $response = $this->postJson('/api/login',[

        'email' => 'kox@example.com',
        'password' => 'password'

    ]);


    $response->assertStatus(200);

});
