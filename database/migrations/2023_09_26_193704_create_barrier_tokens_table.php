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
        Schema::create('barrier_tokens', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->longText('token');
            $table->string('reg_ip');
            $table->string('last_login_ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barrier_tokens');
    }
};
