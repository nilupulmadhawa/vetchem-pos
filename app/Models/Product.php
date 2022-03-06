<?php

namespace App\Models;

use Faker\Core\Barcode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function lotInfos()
    {
        return $this->hasMany(LotInfo::class);
    }
    public function barcodes()
    {
        return $this->hasMany(Barcode::class);
    }
}
