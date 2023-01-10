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
        Schema::table('active_plans', function (Blueprint $table) {
            $table->tinyInteger('expired_at')->nullable();
            $table->string('transaction_reference')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('active_plans', function (Blueprint $table) {
            $table->dropColumn('expired_at');
            $table->dropColumn('transaction_reference');
            $table->dropColumn('payment_type');
            $table->dropColumn('amount');
        });
    }
};
