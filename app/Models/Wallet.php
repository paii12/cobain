<?php

namespace App\Models;
use App\Models\user;

use Illuminate\Database\Eloquent\Factories\Hasfactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use Hasfactory;
    protected $fillable = [
        'user_id',
        'debit',
        'credit',
        'description',
        'status',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}