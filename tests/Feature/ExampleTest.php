<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_startseite_leitet_weiter(): void
    {
        $this->get('/')->assertRedirect('/projekte');
    }
}
