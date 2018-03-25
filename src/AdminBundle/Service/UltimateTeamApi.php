<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16/03/18
 * Time: 11:42
 */

namespace AdminBundle\Service;
use GuzzleHttp\Client;

class UltimateTeamApi extends Client
{
    private $container;
    private $doctrine;

    /**
     * QueovalApi constructor.
     *
     * @param $container
     * @param $doctrine
     */
    public function __construct($container, $doctrine)
    {
        $this->container = $container;
        $this->doctrine = $doctrine;
    }

    /**
     * @return String
     */
    private function getData($url)
    {
        $httpMethod = "GET";
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
        ];
        $response = $client->request(
            $httpMethod,
            $url,
            [
                'headers' => $headers,
            ]
        );

        $data = $response->getBody()->getContents();
        $data = \GuzzleHttp\json_decode($data);

        return $data;
    }

    public function getPlayers($nbPages){
        $url = "https://www.easports.com/fifa/ultimate-team/api/fut/item?jsonParamObject=%7B%22page%22:" . $nbPages . ",%22quality%22:%22silver,gold,rare_silver,rare_gold%22,%22position%22:%22LF,CF,RF,ST,LW,LM,CAM,CDM,CM,RM,RW,LWB,LB,CB,RB,RWB%22%7D";
        $data = $this->getData($url)->items;

        return $data;
    }

    public function getGoalkeeper($nbPages){
        $url = "https://www.easports.com/fifa/ultimate-team/api/fut/item?jsonParamObject=%7B%22page%22:" . $nbPages . ",%22quality%22:%22bronze,silver,gold,rare_bronze,rare_silver,rare_gold%22,%22position%22:%22GK%22%7D";
        $data = $this->getData($url)->items;

        return $data;
    }
}