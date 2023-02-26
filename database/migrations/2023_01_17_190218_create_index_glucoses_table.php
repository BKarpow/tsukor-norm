<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_glucoses', function (Blueprint $table) {
            $table->id();
            $table->string('food');
            $table->string('alias');
            $table->string('url');
            $table->integer('ig');
            $table->integer('one_ho_count')->comment("Одна хлібна одиниця дорівнює ці кількості");
            $table->string('one_ho_unit')->default("г.")->comment("Одиниця виміру для кількості 1 ХО");
            $table->float('protein')->nullable()->comment("Білок в 100г.");
            $table->float('fats')->nullable()->comment("Жири в 100г.");
            $table->float('carbohydrates')->comment("Вуглеводи в 100г.");
            $table->float('calories')->nullable()->comment("Калоріїї (ккал) в 100г.");
            $table->boolean("cellulose")->default(false)->comment("Чи містить продукт клітковину");
            $table->boolean('public')->default(false);
            $table->text('description_food')->nullable();
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
        Schema::dropIfExists('index_glucoses');
    }
};
