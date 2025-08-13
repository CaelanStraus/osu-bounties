<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('claimed_bounties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bounty_id');
            $table->unsignedBigInteger('user_id');
            $table->string('contact_info');
            $table->boolean('verified')->default(false);
            $table->timestamps();

            $table->foreign('bounty_id')->references('id')->on('osu_bounties')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claimed_bounties');
    }
};
