<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsPolicies extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = "terms_policies";
    protected $primaryKey = 'terms_policie_id';
}
