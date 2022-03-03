<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;

class Countries extends Model
{
    use HasFactory;
    public function state(){

        return $this->hasMany(State::class);
    }
}
