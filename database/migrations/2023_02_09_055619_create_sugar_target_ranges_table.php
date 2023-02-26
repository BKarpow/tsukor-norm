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
        Schema::create('sugar_target_ranges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->float('min_glu')->default(3.9)->comment("in mmol/l");
            $table->float('max_glu')->default(8.9)->comment("in mmol/l");
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
        Schema::dropIfExists('sugar_target_ranges');
    }
};
