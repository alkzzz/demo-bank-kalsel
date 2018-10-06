<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $fillable = ['name', 'user_id', 'tabungan'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
