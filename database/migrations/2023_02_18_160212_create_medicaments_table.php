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
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string('name')->comment('Назва препарату');
            $table->string('dose')->comment('Діюча речовина та її доза');
            $table->integer('number')->default(0)->comment('Кількість таблеток в упаковці');
            $table->boolean('sugar_lower')->default(false)->comment('Це цукрознижувальні?');

            $table->string('note')->nullable();
            $table->string('url_shop')->nullable();
            $table->boolean('active')->default(true)->comment('Чи приймаются ці ліки?');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('medicaments');
    }
};
