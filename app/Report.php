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

    public function Chart_Gender()
    {
        return $this->hasOne('App\Chart_Gender');
    }
    public function Chart_Age()
    {
        return $this->hasOne('App\Chart_Age');
    }
    public function Chart_Income()
    {
        return $this->hasOne('App\Chart_Income');
    }
    public function Chart_Ethnicity()
    {
        return $this->hasOne('App\Chart_Ethnicity');
    }
    public function Chart_Education()
    {
        return $this->hasOne('App\Chart_Education');
    }


}
