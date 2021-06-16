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

    public function getClient()
    {
        return $this->belongsTo(Client::class,'client_id');
    }
    public function getTag()
    {
        return $this->hasMany(PortfolioTag::class,'portfolio_item_id');
    }
}
