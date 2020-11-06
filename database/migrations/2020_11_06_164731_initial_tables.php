<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'user',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('active_dog_id')->nullable();
                $table->string('email', 180)->nullable(false);
                $table->string('password', 255)->nullable(false);
                $table->string('firstname', 255)->nullable(false);
                $table->string('lastname', 255)->nullable(false);
            }
        );

        Schema::create(
            'dog',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->string('name', 100)->nullable(false);
                $table->string('breed', 255)->nullable(false);
                $table->date('birthday')->nullable(false);
                $table->multiLineString('comments')->nullable();
            }
        );

        Schema::table(
            'user',
            function (Blueprint $table) {
                $table->foreign('active_dog_id')->references('id')->on('dog');
            }
        );

        Schema::create(
            'professional_type',
            function (Blueprint $table) {
                $table->id();
                $table->string('internal_label', 45)->nullable(false);
                $table->string('display_label', 45)->nullable(false);
            }
        );

        Schema::create(
            'professional',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('professional_type_id');
                $table->foreignId('user_id');
                $table->string('name', 255)->nullable(false);
                $table->string('phone_number', 15)->nullable();
                $table->string('mobile_number', 15)->nullable();
                $table->string('address', 255)->nullable();
                $table->string('city', 45)->nullable();
                $table->string('zip_code', 10)->nullable();
                $table->string('email', 180)->nullable();
                $table->multiLineString('notes')->nullable();
            }
        );

        Schema::create(
            'weight',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('dog_id');
                $table->date('date')->nullable(false);
                $table->decimal('weight', 4, 2)->nullable(false);
            }
        );

        Schema::create(
            'anti_parasitic',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('dog_id');
                $table->foreignId('cared_by_professional_id')->constrained('professional');
                $table->date('date');
                $table->string('anti_parasitic_name', 255)->nullable(false);
                $table->boolean('cared_by_owner')->nullable(false)->default(false);;
                $table->multiLineString('notes')->nullable();
            }
        );

        Schema::create(
            'deworming',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('dog_id');
                $table->foreignId('cared_by_professional_id')->constrained('professional');
                $table->date('date');
                $table->string('deworming_name', 255)->nullable(false);
                $table->boolean('cared_by_owner')->nullable(false)->default(false);
                $table->multiLineString('notes')->nullable();
            }
        );

        Schema::create(
            'time_interval',
            function (Blueprint $table) {
                $table->id();
                $table->string('internal_label', 45)->nullable(false);
                $table->string('display_label', 45)->nullable(false);
                $table->string('format', 10)->nullable(false);
            }
        );

        Schema::create(
            'reminder',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('time_interval_id');
                $table->foreignId('dog_id');
                $table->integer('number_time_interval')->nullable(false);
                $table->string('table_name', 255)->nullable(false);
                $table->date('next_reminder')->nullable(false);
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
        Schema::drop('user');
        Schema::drop('dog');
        Schema::drop('professional_type');
        Schema::drop('professional');
        Schema::drop('weight');
        Schema::drop('anti_parasitic');
        Schema::drop('deworming');
        Schema::drop('time_interval');
        Schema::drop('reminder');
    }
}
