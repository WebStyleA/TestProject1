<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NovaPoshtaLog extends Model
{
    use HasFactory;


    public function log()
    {
        return $this->morphOne(Log::class, 'loggable');
    }

}
