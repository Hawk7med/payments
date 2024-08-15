<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immeuble extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'zone_id',
    ];
    public function zone()
{
    return $this->belongsTo(Zone::class);
}

public function appartements()
{
    return $this->hasMany(Appartement::class);
}
}
