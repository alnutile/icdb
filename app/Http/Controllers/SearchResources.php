<?php

namespace App\Http\Controllers;

use App\Interfaces\MarvelInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class SearchResources extends Controller
{
    /**
     * @var \App\MarvelApi
     */
    protected $marvel = null;

    public function __construct(MarvelInterface $marvel)
    {
        $this->marvel = $marvel;
    }

    public function search(Request $request)
    {
        try
        {
            /**
             * Search Comic Names and then People
             */
            $results = $this->getMarvel()->comics($request);

            return Response::json(['data' => $results, 'message' => "Got em"], 200);
        }
        catch(\Exception $e)
        {
            return Response::json(['data' => [], 'message' => $e->getMessage()], 400);
        }
    }

    /**
     * @return \App\MarvelApi
     */
    public function getMarvel()
    {
        return $this->marvel;
    }

    /**
     * @param \App\MarvelApi $marvel
     */
    public function setMarvel($marvel)
    {
        $this->marvel = $marvel;
    }
}
