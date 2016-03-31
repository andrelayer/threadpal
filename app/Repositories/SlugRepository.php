<?php

namespace App\Repositories;

use App\Report;


class SlugRepository{

    public function makeandValidateUserSlug($slug)
    {

        $slug = str_slug($slug);

        $count = Report::whereRaw("website_slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function getReportBySlug($slug)
    {

        return Report::where('website_slug',$slug)->firstorfail();

    }
}