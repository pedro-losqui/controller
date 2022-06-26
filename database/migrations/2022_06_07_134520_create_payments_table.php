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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('consultant_id');
            $table->enum('type_service', ['0', '1'])->nullable()->default('0');
            $table->string('customer', 100);
            $table->integer('value')->unsigned();
            $table->integer('hours')->unsigned();
            $table->float('payment')->nullable();
            $table->enum('status', ['0', '1', '2'])->nullable()->default('0');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('consultant_id')->references('id')->on('consultants')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
