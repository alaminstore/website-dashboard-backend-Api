<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategories extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = "portfolio_categories";
    protected $primaryKey = 'portfolio_category_id';

}
