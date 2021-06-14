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

    public function getPortfolioItem()
    {
        return $this->belongsTo(PortfolioItem::class,'portfolio_item_id');
    }

}
