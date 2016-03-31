<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $table = 'connections';

    protected $fillable = [
        'user_id',
        'social_id',
        'provider',
        'token',
        'token_updated_at',
        'token_expires_at'
    ];

    protected $dates = ['token_updated_at','token_expires_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
