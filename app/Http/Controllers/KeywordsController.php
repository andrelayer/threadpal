<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\KeywordService;
use Laracasts\Flash\Flash;

class KeywordsController extends Controller
{

    public function search()
    {
        return view('keywords/search');
    }

    public function getAutocomplete(Request $input, KeywordService $keywordService)
    {

        $autocomplete = $keywordService->search($input['keyword']);

        if(isset($autocomplete)){

            return view('keywords/select', compact('autocomplete'));

        }else{

            Flash::error('Sorry, there were no results for that keyword, please try again');

            return view('keywords/search');

        }


    }

}
