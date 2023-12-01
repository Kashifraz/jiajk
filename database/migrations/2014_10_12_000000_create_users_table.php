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
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->integer('cnic')->nullable();
            $table->date('dob')->nullable();
            $table->integer('gender')->nullable();
            $table->string('social_media')->nullable();
            $table->string('referer')->nullable();
            $table->date('membership_date')->nullable();
            $table->string('affiliations')->nullable();
            $table->string('constituency')->nullable();
            $table->string('union_council')->nullable();
            $table->string('ward')->nullable();
            $table->string('geographical_address')->nullable();
            $table->string('local_jamat')->nullable();
            $table->string('city')->nullable();
            $table->string('village')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->integer('home_phone')->nullable();
            $table->integer('office_phone')->nullable();
            $table->integer('mobile_phone')->nullable();
            $table->integer('type');
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
