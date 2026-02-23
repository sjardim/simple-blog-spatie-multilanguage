<?php

test('can visit the homepage in English', function () {
        refreshApplicationWithLocale('en');

        $response = $this->get('/en');

        $response->assertStatus(200);
});

test('can visit the homepage in Portuguese', function () {
        refreshApplicationWithLocale('pt');

        $response = $this->get('/pt');

        $response->assertStatus(200);
});
