<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CaredByProfessionalIdNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'anti_parasitic',
            function (Blueprint $table) {
                $table->unsignedBigInteger('cared_by_professional_id')->nullable(true)->change();
            }
        );

        Schema::table(
            'deworming',
            function (Blueprint $table) {
                $table->unsignedBigInteger('cared_by_professional_id')->nullable(true)->change();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'anti_parasitic',
            function (Blueprint $table) {
                $table->unsignedBigInteger('cared_by_professional_id')->nullable(false)->change();
            }
        );

        Schema::table(
            'deworming',
            function (Blueprint $table) {
                $table->unsignedBigInteger('cared_by_professional_id')->nullable(false)->change();
            }
        );
    }
}
