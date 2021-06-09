<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioTag extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = "portfolio_tags";
    protected $primaryKey = 'portfolio_tag_id';
}
