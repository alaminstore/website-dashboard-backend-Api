<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = "counts";
    protected $primaryKey = 'count_id';
}
