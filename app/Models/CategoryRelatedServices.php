<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRelatedServices extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = "category_related_services";
    protected $primaryKey = 'category_related_service_id';

    public function getPortfolioCategory(){
        return $this->belongsTo(PortfolioCategories::class,'portfolio_category_id');
    }
    public function getCategory()
    {
        return $this->belongsTo(PortfolioCategories::class,'portfolio_category_id');
    }
}
