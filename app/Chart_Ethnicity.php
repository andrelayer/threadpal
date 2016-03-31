<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Ethnicity extends Model
{
    protected $table = 'chart_ethnicity';

    protected $fillable = [
        'report_id',
        'Hispanic',
        'Asian American',
        'African American',
        'Other',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
