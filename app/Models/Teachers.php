<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teachers extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','city','subject','pob','dob','subject_id'];
}