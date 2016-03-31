<?php

namespace App\Services;

use App\Repositories\SlugRepository;

class SlugService{

    protected $slugRepository;

    public function __construct(SlugRepository $slugRepository)
    {
        $this->slugRepository = $slugRepository;
    }


    public function makeandValidateReportSlug()
    {
        return $this->slugRepository->makeandValidateReportSlug($slug);
    }

    public function getReportBySlug($slug)
    {

        return $this->slugRepository->getReportBySlug($slug);

    }
}