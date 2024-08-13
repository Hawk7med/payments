<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function appartements()
{
    return $this->belongsToMany(Appartement::class, 'client_appartement')->withPivot('first_year');
}
}
