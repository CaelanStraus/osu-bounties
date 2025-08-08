<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bounty extends Model
{
    use HasFactory;

    protected $table = 'osu_bounties';

    protected $fillable = [
        'beatmap_title',     
        'beatmap_url',
        'artist',
        'difficulty',
        'required_mods',
        'beatmap_image',
        'description',
        'donators',
        'reward',
        'completed',
        'completed_by',
        'completed_at',
    ];
}