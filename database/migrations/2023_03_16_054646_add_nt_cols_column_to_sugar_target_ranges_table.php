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
        Schema::table('sugar_target_ranges', function (Blueprint $table) {
            Schema::table('sugar_target_ranges', function (Blueprint $table) {
                $table->float('min_nt_glu')->default(3.9)->comment("In mmol/l")->after('max_glu');
                $table->float('max_nt_glu')->default(7.0)->comment("In mmol/l")->after('max_glu');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sugar_target_ranges', function (Blueprint $table) {
            Schema::table('sugar_target_ranges', function (Blueprint $table) {
                $table->dropColumn('min_nt_glu');
                $table->dropColumn('max_nt_glu');
            });
        });
    }
};
