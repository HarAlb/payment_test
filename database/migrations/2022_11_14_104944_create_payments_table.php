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
            $table->foreignIdFor(\App\Models\User::class);
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedTinyInteger('status_id');
            $table->string('payment_id')->comment('Payment id must be uuid');
            $table->string('amount')->comment('For disable problems with float');
            $table->string('amount_paid')->comment('For disable problems with float');
            $table->string('signature')->nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('payment_statuses');
            $table->foreign('user_id')->references('id')->on('users');
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
