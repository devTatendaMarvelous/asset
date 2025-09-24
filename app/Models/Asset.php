<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
protected $fillable =  [
    'brand' ,
    'description',
    'serial_number' ,
    'type_id',
    'status',
    'user_id'
];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function type(){
        return $this->belongsTo(AssetType::class,'type_id');
    }
}
