<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class debt extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'no_products',
        'total_price',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults([]);
    }
}
