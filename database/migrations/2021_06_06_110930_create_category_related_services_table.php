<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryRelatedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_related_services', function (Blueprint $table) {
            $table->increments('category_related_service_id');
            $table->unsignedInteger('portfolio_category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->string('position')->nullable();
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
        Schema::dropIfExists('_category_related_services');
    }
}
