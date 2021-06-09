<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetQuotes extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = "get_quotes";
    protected $primaryKey = 'get_quote_id';
}
