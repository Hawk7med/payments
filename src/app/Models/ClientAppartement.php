<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAppartement extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'appartement_id',
        'first_year',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function appartement()
    {
        return $this->belongsTo(Appartement::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
   
}
