<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_position', function (Blueprint $table) {
            $table->increments('portfolio_position_id');
            $table->unsignedBigInteger('portfolio_category_id')->nullable();
            $table->unsignedBigInteger('portfolio_item_id')->nullable();
            $table->unsignedBigInteger('position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_position');
    }
}
