<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\KeywordService;

class KeywordsController extends Controller
{

    public function search()
    {
        return view('keywords/search');
    }

    public function getAutocomplete(Request $input, KeywordService $keywordService)
    {

        $autocomplete = $keywordService->search($input['keyword']);

        return view('keywords/select', compact('autocomplete'));
    }

}
