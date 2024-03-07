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
        Schema::create('form_b_s', function (Blueprint $table) {
            $table->id();
            $table->longText('form_b')->nullable();
            $table->foreignIdFor(User::class);
            $table->integer('dpd_id')->nullable();
            $table->string('dpd_approval')->nullable();
            $table->text('dpd_comment')->nullable();
            $table->date('dpd_approval_date')->nullable();
            $table->integer('sg_id')->nullable();
            $table->string('sg_approval')->nullable();
            $table->text('sg_comment')->nullable();
            $table->date('sg_approval_date')->nullable();
            $table->integer('pd_id')->nullable();
            $table->string('pd_approval')->nullable();
            $table->text('pd_comment')->nullable();
            $table->date('pd_approval_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_b_s');
    }
};
