<?php

use App\Models\User;
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
        Schema::create('form_a_s', function (Blueprint $table) {
            $table->id();
            $table->longText('form_a')->nullable();
            $table->foreignIdFor(User::class);
            $table->integer('sg_id')->nullable();
            $table->string('sg_approval')->nullable();
            $table->text('sg_comment')->nullable();
            $table->date('sg_approval_date')->nullable();
            $table->integer('president_id')->nullable();
            $table->string('president_approval')->nullable();
            $table->text('president_comment')->nullable();
            $table->date('president_approval_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_a_s');
    }
};
