<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Age extends Model
{
    protected $table = 'chart_age';

    protected $fillable = [
        'report_id',
        '13 to 19',
        '20 to 24',
        '25 to 29',
        '30 to 34',
        '35 to 39',
        '40 to 44',
        '45 to 49',
        '50 to 54',
        '55 to 59',
        '60 to 64',
        '65 and older',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
