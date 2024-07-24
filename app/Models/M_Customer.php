<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Customer extends Model
{
    protected $table = 'm_customer';
    protected $fillable = [
        'kode',
        'nama',
        'telp',
    ];
    use HasFactory;

    public function t_sales()
    {
        return $this->hasMany(T_Sales::class, 'cust_id');
    }
}
