<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class usuarios extends Model
{
    use HasFactory;
    protected $table ='usuarios';
    protected $fillable = [
        'name',
        'password',
        'create_at',
        'tipo'
    ];

    public function getAuthPassword(){
        return $this->password;
    }
    public $timestamp = false;
}
