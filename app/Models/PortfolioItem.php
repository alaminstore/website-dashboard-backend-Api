<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = "portfolio_items";
    protected $primaryKey = 'portfolio_item_id';
}
