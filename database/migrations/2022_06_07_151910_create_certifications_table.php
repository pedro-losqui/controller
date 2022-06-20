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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultant_id');
            $table->unsignedBigInteger('block_id');
            $table->unsignedBigInteger('iten_id');
            $table->integer('percent_block')->unsigned()->nullable()->default(0);
            $table->enum('status_block', ['0', '1'])->nullable()->default('0');
            $table->enum('status_iten', ['0', '1'])->nullable()->default('0');
            $table->timestamps();

            $table->foreign('consultant_id')->references('id')->on('consultants')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('block_id')->references('id')->on('blocks')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('iten_id')->references('id')->on('itens')
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
        Schema::dropIfExists('certifications');
    }
};
