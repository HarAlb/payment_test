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
        Schema::create('past_pone_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Payment::class);
            $table->unsignedTinyInteger('status_id');
            $table->string('signature')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('status_id')->references('id')->on('payment_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('past_pone_payments');
    }
};
