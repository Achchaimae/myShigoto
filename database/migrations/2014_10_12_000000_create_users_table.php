<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('confirm_password');
            $table->string('address');
            $table->string('city');
            $table->string('role');
            $table->string('image')->nullable();
            $table->string('phone');
            $table->string('document_validation')->nullable();
            $table->string('status');
            $table->string('validation')->default('pending');
           
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
     

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
