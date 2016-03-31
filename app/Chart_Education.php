<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Education extends Model
{
    protected $table = 'chart_education';

    protected $fillable = [
        'report_id',
        'Some High School',
        'In High School',
        'High School Grad',
        'Some College',
        'In College',
        'College Graduate',
        'Some Grad School',
        'In Grad School',
        'Master Degree',
        'Professional Degree',
        'Doctorate Degree',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
