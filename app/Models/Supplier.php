<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public function supplierInvoices()
    {
        return $this->hasMany(SupplierInvoice::class);
    }

    public function lotInfos()
    {
        return $this->hasMany(LotInfo::class);
    }
}
