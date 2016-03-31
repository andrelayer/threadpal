<?php

namespace App\Repositories;

use FacebookAds\Api;
use App\Services\ConnectionService;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\ReachEstimateFields;
use FacebookAds\Object\Values\OptimizationGoals;
use FacebookAds\Object\TargetingSearch;
use FacebookAds\Object\Search\TargetingSearchTypes;


class KeywordRepository{




    public function search($keyword, $token)
    {

        $count = 0;
        $limit = 10;

        $keyword_array = array($keyword);

        Api::init(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'), $token);

        $api = Api::instance();



        $account = new AdAccount('act_936301983083925');

        $results = TargetingSearch::search(
            TargetingSearchTypes::INTEREST,
            null,
            $keyword);

        /*$result = $results[0]->getData();
        print_r($result['id']);*/

        foreach ($results as $result)
        {
            $r = $result->getData();
            $autocomplete[$count]['id'] = $r['id'];
            $autocomplete[$count]['name'] = $r['name'];
            $autocomplete[$count]['reach'] = $r['audience_size'];
            $count++;
            if($count == $limit){break;}

        }

        return $autocomplete;

        //return associative array of values for total and subtraits
    }



}