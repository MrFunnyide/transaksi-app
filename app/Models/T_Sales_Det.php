<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Sales_Det extends Model
{
    use HasFactory;
    protected $table = 't_sales_det';
    public $timestamps = false;
    protected $fillable = [
        'sales_id',
        'barang_id',
        'harga_bandrol',
        'qty',
        'diskon_pct',
        'diskon_nilai',
        'harga_diskon',
        'total'
    ];

    public function m_barang()
    {
        return $this->belongsTo(M_Barang::class, 'barang_id');
    }

    public function t_sales()
    {
        return $this->belongsTo(T_Sales::class, 'sales_id');
    }
}
