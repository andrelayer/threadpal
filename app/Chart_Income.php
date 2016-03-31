<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Income extends Model
{
    protected $table = 'chart_income';

    protected $fillable = [
        'report_id',
        '30K to 40K',
        '40K to 50K',
        '50K to 75K',
        '75K to 100K',
        '100K to 125K',
        '125K to 150K',
        '150K to 250K',
        '250K to 350K',
        '350K to 500K',
        'Over 500K',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
