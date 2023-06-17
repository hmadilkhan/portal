<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    protected $with = ['finances'];

    public function finances()
    {
        return $this->belongsTo(CustomerFinance::class,"id","customer_id");
    }
}
