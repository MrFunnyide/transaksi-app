<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Sales extends Model
{
    protected $table = 't_sales';
    protected $fillable = [
        'kode',
        'tgl',
        'cust_id',
        'subtotal',
        'diskon',
        'ongkir',
        'total_bayar',
        'created_at',
        'updated_at'
    ];
    use HasFactory;

    public function t_sales_det()
    {
        return $this->hasMany(T_Sales_Det::class, 'sales_id');
    }

    public function m_customer()
    {
        return $this->belongsTo(M_Customer::class, 'cust_id');
    }
}
