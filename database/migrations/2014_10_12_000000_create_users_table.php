<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userid')->unique();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('role_as')->default('0');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('subscription_id')->nullable();
            $table->date('subcribe_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('users')->insert
        ([
            'userid' => rand(1111, 9999),
            'username' => 'Admin',
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'status' => 1,
            'role_as' => 1,
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now()
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
