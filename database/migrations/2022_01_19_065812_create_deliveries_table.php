<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->enum('address_type',['A','H','O'])->default(Null)->nullable()->comment('A = Admin','H = Home,O = Office');
            $table->unsignedBigInteger('user_id')->nullable(false)->comment('added by');
            $table->string('full_name');
            $table->string('address');
            $table->string('phone');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('zip_code');
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
        Schema::dropIfExists('deliveries');
    }
}
