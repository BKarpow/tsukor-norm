<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_sugar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->float('glucose')->comment('In mmol/L');
            $table->boolean('before_food')->default(false);
            $table->boolean('after_food')->default(false);
            $table->boolean('stress')->default(false);
            $table->boolean('before_exercise')->default(false);
            $table->boolean('exercise')->default(false);
            $table->boolean('after_exercise')->default(false);
            $table->boolean('disease')->default(false);
            $table->text('comment')->default('');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_sugar');
    }
};
