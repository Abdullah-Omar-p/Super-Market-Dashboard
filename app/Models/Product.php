<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'id',
        'name',
        'barcode',
        'description',
        'available_pices',
        'price',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults([]);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}
