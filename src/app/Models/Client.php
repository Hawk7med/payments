<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'cin',
        'email',
        'tel',
        'address',
        'appartement_id',
        'first_year',
        // Add other attributes if needed
    ];
    public function clientAppartements()
    {
        return $this->hasMany(ClientAppartement::class);
    }
    public function appartements()
{
    return $this->belongsToMany(Appartement::class, 'client_appartements')->withPivot('first_year');
}
}
