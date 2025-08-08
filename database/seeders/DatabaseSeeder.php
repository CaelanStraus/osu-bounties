<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bounty;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => 'Password!321',
            'usertype' => 'admin',
        ]);

        Bounty::factory()->create([        
        'beatmap_title' => 'Sound Chimera',
        'beatmap_url' => 'https://osu.ppy.sh/beatmapsets/813569#osu/1706210',
        'artist' => 'Laur',
        'difficulty' => 'Chimera',
        'required_mods' => 'HR',
        'beatmap_image' => 'eyes.jpg',
        'description' => '$200 for the first HR FC',
        'donators' => 'broiiler',
        'reward' => '$200',
        'completed' => false,
        'completed_by' => null,
        'completed_at' => null,
        ]);
    }
}
