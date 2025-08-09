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
        'beatmap_image' => 'sound_chimera.jpg',
        'description' => '$200 for the first HR FC',
        'donators' => 'broiiler',
        'reward' => '$200',
        'completed' => false,
        'completed_by' => null,
        'completed_at' => null,
        ]);

        Bounty::factory()->create([        
        'beatmap_title' => 'Libera',
        'beatmap_url' => 'https://osu.ppy.sh/beatmapsets/755311#osu/1589931',
        'artist' => 'Ne Obliviscaris',
        'difficulty' => 'Lachesismic Armageddon',
        'required_mods' => 'NM',
        'beatmap_image' => 'libera.jpg',
        'description' => '$250 for the first FC + $200 donated by Starlight',
        'donators' => 'antioxidanti, Starlight',
        'reward' => '$450',
        'completed' => false,
        'completed_by' => null,
        'completed_at' => null,
        ]);

        Bounty::factory()->create([        
        'beatmap_title' => 'Kami no Kotoba',
        'beatmap_url' => 'https://osu.ppy.sh/beatmapsets/817667#osu/1714634',
        'artist' => 'Luschka',
        'difficulty' => "Jounzan's Special",
        'required_mods' => 'DT',
        'beatmap_image' => 'kami_no_kotoba.jpg',
        'description' => '$500 for the first DT FC',
        'donators' => 'Feinberg',
        'reward' => '$500',
        'completed' => false,
        'completed_by' => null,
        'completed_at' => null,
        ]);

        Bounty::factory()->create([        
        'beatmap_title' => 'Angreifer',
        'beatmap_url' => 'https://osu.ppy.sh/beatmapsets/897087#osu/1874165',
        'artist' => 'Unlucky Morpheus',
        'difficulty' => "Scharfrichter",
        'required_mods' => 'NM',
        'beatmap_image' => 'angreifer.jpg',
        'description' => '$1,500 for the first FC ',
        'donators' => 'joocy',
        'reward' => '$1500',
        'completed' => false,
        'completed_by' => null,
        'completed_at' => null,
        ]);
    }
}
