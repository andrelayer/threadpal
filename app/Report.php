<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'type',
        'name',
        'keywords',
        'slug'
    ];

    public function chart_gender()
    {
        return $this->hasOne('App\Chart_Gender');
    }
    public function chart_age()
    {
        return $this->hasOne('App\Chart_Age');
    }
    public function chart_income()
    {
        return $this->hasOne('App\Chart_Income');
    }
    public function chart_ethnicity()
    {
        return $this->hasOne('App\Chart_Ethnicity');
    }
    public function chart_education()
    {
        return $this->hasOne('App\Chart_Education');
    }


}
