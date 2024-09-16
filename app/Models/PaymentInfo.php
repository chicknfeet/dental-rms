<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    protected $table = 'paymentinfos';

    protected $fillable = ['users_id', 'patient','description', 'amount', 'balance', 'date'];

    public function patient()
    {
        return $this->belongsTo(User::class);
    }

}

