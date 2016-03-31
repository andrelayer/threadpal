<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Gender extends Model
{
    protected $table = 'chart_gender';

    protected $fillable = [
        'report_id',
        'male',
        'female',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
