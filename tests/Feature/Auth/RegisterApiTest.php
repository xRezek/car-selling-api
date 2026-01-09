<?php

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

//todo: napisać testy do rejestracji usera