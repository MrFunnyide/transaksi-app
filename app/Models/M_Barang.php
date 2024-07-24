<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Barang extends Model
{
    protected $table = 'm_barang';
    protected $fillable = [
        'kode',
        'nama',
        'harga'
    ];
    use HasFactory;

    public function t_sales_det()
    {
        return $this->hasMany(T_Sales_Det::class, 'barang_id');
    }
}
