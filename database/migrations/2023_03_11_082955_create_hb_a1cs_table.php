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
        Schema::create('hb_a1cs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->float('percentage')->comment("Level HbA1c in percentage. Normal 4.5% - 5.7%");
            $table->string("note")->default("");
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
        Schema::dropIfExists('hb_a1cs');
    }
};
