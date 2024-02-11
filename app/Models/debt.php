<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class debt extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'id',
        'liability',
        'status', // .. if = 1 it then it your money ليك, if = 0 money you should give to some one عليك..
        'name',
        'phone',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults([]);
    }
}
