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
        Schema::table('medicament_takes', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
        });
        Schema::table('insulin_takes', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
        });
        Schema::table('insulins', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
        });
        Schema::table('hb_a1cs', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
        });
        Schema::table('medicaments', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
        });
        Schema::table('blood_pressures', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
        });
        Schema::table('my_sugar', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
        });
        Schema::table('ketons', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
        });
        Schema::table('index_glucoses', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('alias');
            $table->index('ig');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicament_takes', function (Blueprint $table) {
            $table->dropIndex(['created_at', 'user_id']);
        });
        Schema::table('insulin_takes', function (Blueprint $table) {
            $table->dropIndex(['created_at', 'user_id']);
        });
        Schema::table('insulins', function (Blueprint $table) {
            $table->dropIndex(['created_at', 'user_id']);
        });
        Schema::table('hb_a1cs', function (Blueprint $table) {
            $table->dropIndex(['created_at', 'user_id']);
        });
        Schema::table('medicaments', function (Blueprint $table) {
            $table->dropIndex(['created_at', 'user_id']);
        });
        Schema::table('blood_pressures', function (Blueprint $table) {
            $table->dropIndex(['created_at', 'user_id']);
        });
        Schema::table('my_sugar', function (Blueprint $table) {
            $table->dropIndex(['created_at', 'user_id']);
        });
        Schema::table('ketons', function (Blueprint $table) {
            $table->dropIndex(['created_at', 'user_id']);
        });
        Schema::table('index_glucoses', function (Blueprint $table) {
            $table->dropIndex(['created_at', 'alias', 'ig']);
        });
    }
};
