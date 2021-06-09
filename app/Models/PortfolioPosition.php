<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioPosition extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = "portfolio_position";
    protected $primaryKey = 'portfolio_position_id';

    public function getPortfolioCategory()
    {
        return $this->belongsTo(PortfolioCategories::class,'portfolio_category_id');
    }
    public function getPortfolioItem()
    {
        return $this->belongsTo(PortfolioItem::class,'portfolio_item_id');
    }
}
