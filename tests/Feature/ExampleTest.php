<?php

test('example', function () {
    $response = $this->get('/');

    // Intentionally assert a status code that is incorrect to make the test fail
    $response->assertStatus(500);
});
