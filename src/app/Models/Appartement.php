<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'immeuble_id', // Include if you have a foreign key for relationship
    ];
    public function immeuble()
    {
        return $this->belongsTo(Immeuble::class);
    }
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, ClientAppartement::class, 'appartement_id', 'client_appartement_id');
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_appartement')->withPivot('first_year');
    }




    public function clientAppartements()
    {
        return $this->hasMany(ClientAppartement::class);
    }


}
