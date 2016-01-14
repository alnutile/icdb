<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 1/13/16
 * Time: 8:38 PM
 */

namespace App;


use App\Interfaces\MarvelInterface;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MarvelApi implements MarvelInterface
{

    protected $key = false;
    protected $secret = false;
    protected $base_url = false;
    protected $api_version = '/v1/public';

    /**
     * @var Client
     */
    protected $client = null;

    public function __construct($key, $secret, Client $client)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->client = $client;
    }

    public function comics(Request $request)
    {
        $query = ['query' => $this->makeAuth()];

        if($title = $request->input('title'))
        {
            $query['query'] = array_merge($query['query'], ['titleStartsWith' => $title]);
        }

        $results = $this->client->request('GET', $this->getApiVersion() . '/comics', $query);

        return json_decode($results->getBody());

    }

    protected function makeAuth()
    {
        $ts = Carbon::now();
        $hash = md5($ts->timestamp . $this->secret . $this->key);
        return ['apikey' => $this->key, 'ts' => $ts->timestamp, 'hash' => $hash];
    }

    public function connect()
    {

    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->base_url;
    }

    /**
     * @param string $url
     */
    public function setBaseUrl($url)
    {
        $this->base_url = $url;
    }

    /**
     * @return null
     */
    public function getApiVersion()
    {
        return $this->api_version;
    }

    /**
     * @param null $api_version
     */
    public function setApiVersion($api_version)
    {
        $this->api_version = $api_version;
    }

}