<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function clientAppartement()
{
    return $this->belongsTo(ClientAppartement::class);
}
protected $fillable = [
    'client_appartement_id',
    'year',
    'is_paid',
    'amount',
    'payment_date',
];
}
