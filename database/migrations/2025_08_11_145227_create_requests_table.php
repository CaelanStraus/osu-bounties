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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('beatmap_url');
            $table->string('difficulty');
            $table->string('required_mods')->default('NM');
            $table->string('description')->nullable();
            $table->string('donators')->default('Anonymous');
            $table->string('reward');
            $table->string('contact_info');
            $table->timestamps();           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
