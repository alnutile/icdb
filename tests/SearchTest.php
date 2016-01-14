<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    /**
     * @test
     */
    public function search_all()
    {

        $response = $this->call('GET', '/api/v1/search?title=Ant');

        dd($response->getContent());
    }
}
