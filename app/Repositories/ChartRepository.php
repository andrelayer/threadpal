<?php

namespace App\Repositories;

use FacebookAds\Api;
use App\Services\ConnectionService;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\ReachEstimateFields;
use FacebookAds\Object\Values\OptimizationGoals;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;




class ChartRepository{

    public function getChartData($reportId, $chart)
    {
        $chart = strtolower($chart);

        return DB::table($chart)->where('report_id',$reportId)->first();
    }




    public function Chart_Gender($token,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'), $token);

        $api = Api::instance();

        $traits = array(
            'total'=> array(1,2),
            'male' => array(1),
            'female' => array(2)
        );

        $account = new AdAccount('act_936301983083925');

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),
                'genders' =>
                    $value
                ,
                'age_min' => 13,

            );

            if(isset($keywordId))
            {
                $targeting_spec['interests'] = array(array(
                'id'=> $keywordId,
                'name'=> $keywordName,
                ));
            }

            $reach_estimate = $account->getReachEstimate(
                array(),
                array(
                    'currency' => 'USD',
                    'optimize_for' => OptimizationGoals::OFFSITE_CONVERSIONS,
                    'targeting_spec' => $targeting_spec,
                ))->getData();

            $reach[$key] = $reach_estimate['users'];

        }
        return $reach;
    }

    public function Chart_Age($token,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'), $token);

        $api = Api::instance();

        $traits = array(
            '13 to 19' => array('min' => 13, 'max' => 19),
            '20 to 24' => array('min' => 20, 'max' => 24),
            '25 to 29' => array('min' => 25, 'max' => 29),
            '30 to 34' => array('min' => 30, 'max' => 34),
            '35 to 39' => array('min' => 35, 'max' => 39),
            '40 to 44' => array('min' => 40, 'max' => 44),
            '45 to 49' => array('min' => 45, 'max' => 49),
            '50 to 54' => array('min' => 50, 'max' => 54),
            '55 to 59' => array('min' => 55, 'max' => 59),
            '60 to 64' => array('min' => 60, 'max' => 64),
            '65 and older' => array('min' => 65, 'max' => NULL),
            'total' => array('min' => 13, 'max' => NULL)
        );

        $account = new AdAccount('act_936301983083925');

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => $value['min'],
                'age_max' => $value['max'],

            );

            if(isset($keywordId))
            {
                $targeting_spec['interests'] = array(array(
                    'id'=> $keywordId,
                    'name'=> $keywordName,
                ));
            }

            $reach_estimate = $account->getReachEstimate(
                array(),
                array(
                    'currency' => 'USD',
                    'optimize_for' => OptimizationGoals::OFFSITE_CONVERSIONS,
                    'targeting_spec' => $targeting_spec,
                ))->getData();

            $reach[$key] = $reach_estimate['users'];

        }
        return $reach;

    
    }

    public function Chart_Income($token,$keywordName = NULL, $keywordId = NULL)
    {

        $total_reach = 0;

        Api::init(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'), $token);

        $api = Api::instance();

        $traits = array(
            '30K to 40K' => array('id' => 6018510070532, 'name' => '$30,000 - $40,000'),
            '40K to 50K' => array('id' => 6018510087532, 'name' => '$40,000 - $50,000'),
            '50K to 75K' => array('id' => 6018510122932, 'name' => '$50,000 - $75,000'),
            '75K to 100K' => array('id' => 6018510100332, 'name' => '$75,000 - $100,000'),
            '100K to 125K' => array('id' => 6018510083132, 'name' => '$100,000 - $125,000'),
            '125K to 150K' => array('id' => 6017897162332, 'name' => '$125,000 - $150,000'),
            '150K to 250K' => array('id' => 6017897374132, 'name' => '$150,000 - $250,000'),
            '250K to 350K' => array('id' => 6017897397132, 'name' => '$250,000 - $350,000'),
            '350K to 500K' => array('id' => 6017897416732, 'name' => '$350,000 - $500,000'),
            'Over 500K' => array('id' => 6017897439932, 'name' => 'Over $500,000')
        );

        $account = new AdAccount('act_936301983083925');

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,


            );

            $targeting_spec['income'] = array(array(
                'id'=> $value['id'],
                'name'=> $value['name'],
            ));

            if(isset($keywordId))
            {
                $targeting_spec['interests'] = array(array(
                    'id'=> $keywordId,
                    'name'=> $keywordName,
                ));
            }

            $reach_estimate = $account->getReachEstimate(
                array(),
                array(
                    'currency' => 'USD',
                    'optimize_for' => OptimizationGoals::OFFSITE_CONVERSIONS,
                    'targeting_spec' => $targeting_spec,
                ))->getData();

            $reach[$key] = $reach_estimate['users'];

            $total_reach = $total_reach + $reach_estimate['users'];

        }

        $reach['total'] = $total_reach;

        return $reach;
    }

    public function Chart_Ethnicity($token,$keywordName = NULL, $keywordId = NULL)
    {

        $total_reach = 0;
        $other = 0;

        Api::init(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'), $token);

        $api = Api::instance();

        $traits = array(
            'Hispanic' => array('id' => 6003133212372, 'name' => 'Hispanic (US - All)'),
            'Asian American' => array('id' => 6021722613183, 'name' => 'Asian American (US)'),
            'African American' => array('id' => 6018745176183, 'name' => 'African American (US)'),
            'Other' => NULL,
        );

        $account = new AdAccount('act_936301983083925');

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,


            );
            if(isset($value))
            {
                $targeting_spec['ethnic_affinity'] = array(array(
                    'id' => $value['id'],
                    'name' => $value['name'],
                ));
            }

            if(isset($keywordId))
            {
                $targeting_spec['interests'] = array(array(
                    'id'=> $keywordId,
                    'name'=> $keywordName,
                ));
            }

            $reach_estimate = $account->getReachEstimate(
                array(),
                array(
                    'currency' => 'USD',
                    'optimize_for' => OptimizationGoals::OFFSITE_CONVERSIONS,
                    'targeting_spec' => $targeting_spec,
                ))->getData();



            if(isset($value)) {

                $reach[$key] = $reach_estimate['users'];

                $other = $other + $reach_estimate['users'];

            }else{

                $reach['total'] = $reach_estimate['users'];

            }

        }
        $reach['Other'] = $reach['total'] - $other;


        return $reach;
    }

    public function Chart_Education($token,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'), $token);

        $api = Api::instance();

        $traits = array(
            'total'=> array(13,1,4,5,2,3,8,7,9,10,11),
            'Some High School' => array(13),
            'In High School' => array(1),
            'High School Grad' => array(4),
            'Some College' => array(5),
            'In College' => array(2),
            'College Graduate' => array(3),
            'Some Grad School' => array(8),
            'In Grad School' => array(7),
            'Master Degree' => array(9),
            'Professional Degree' => array(10),
            'Doctorate Degree' => array(11)

        );

        $account = new AdAccount('act_936301983083925');

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),
                'education_statuses' =>
                    $value
                ,
                'age_min' => 13,

            );

            if(isset($keywordId))
            {
                $targeting_spec['interests'] = array(array(
                    'id'=> $keywordId,
                    'name'=> $keywordName,
                ));
            }

            $reach_estimate = $account->getReachEstimate(
                array(),
                array(
                    'currency' => 'USD',
                    'optimize_for' => OptimizationGoals::OFFSITE_CONVERSIONS,
                    'targeting_spec' => $targeting_spec,
                ))->getData();

            $reach[$key] = $reach_estimate['users'];

        }
        return $reach;
    }



    public function checkFBTargetIds($token)
    {
        $url = 'https://graph.facebook.com/v2.5/search';

        $urlparams = [
            'access_token' => $token,
            'type' => 'adTargetingCategory',
            'class' => 'income'
        ];

        $client = new \GuzzleHttp\Client;

        $response = $client->get($url, ['query' => $urlparams]);

        $response = json_decode($response->getBody(),true);

        print_r($response);
        die();
    }

}