<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'contacts';
    protected $fillable = [
        'address',
        'talk',
        'sale_email'
    ];
    public function setAddressAttribute($value){
        $this->attributes['address'] = ucwords($value);
    }
}
