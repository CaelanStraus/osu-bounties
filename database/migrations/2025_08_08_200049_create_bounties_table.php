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
        Schema::create('osu_bounties', function (Blueprint $table) {
            $table->id();
            $table->string('beatmap_title');   
            $table->string('beatmap_url');
            $table->string('artist');
            $table->string('difficulty');
            $table->string('required_mods')->default('NM');
            $table->string('beatmap_image')->nullable();
            $table->string('description')->nullable();
            $table->string('donators')->default('Anonymous');
            $table->string('reward');
            $table->boolean('completed')->default(false);
            $table->string('completed_by')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bounties');
    }
};
