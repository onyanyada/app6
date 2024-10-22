<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    //購入とのリレーション
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
