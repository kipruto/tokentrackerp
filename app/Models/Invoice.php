<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'invoice_number', 'invoice_date', 'total_amount'];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
