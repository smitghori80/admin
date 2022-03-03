<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;

class State extends Model
{
    use HasFactory;
    public function countries(){
        return $this->belongsTo(Countries::class);
    }
}
