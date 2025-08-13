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
        
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => 'Password!321',
            'usertype' => 'admin',
            'profile_picture' => null,
            'about_me' => 'null',
            'dob' => 'null',
        ]);

        User::factory(10)->create();

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

        Bounty::factory()->create([        
        'beatmap_title' => 'Summer Of The Occult',
        'beatmap_url' => 'https://osu.ppy.sh/beatmapsets/797590#osu/1675085',
        'artist' => 'Seven Lions',
        'difficulty' => "Divine Empire Of The Supernatural",
        'required_mods' => 'DT',
        'beatmap_image' => 'summer_of_the_occult.png',
        'description' => '$20 for the first FC https://youtu.be/sbh3rUaK_6E',
        'donators' => 'Alphabet',
        'reward' => '$20',
        'completed' => true,
        'completed_by' => "mrekk",
        'completed_at' => "9/28/2020",
        ]);

        Bounty::factory()->create([        
        'beatmap_title' => 'Hold Your Colour',
        'beatmap_url' => 'https://osu.ppy.sh/beatmapsets/702272#osu/1485947 ',
        'artist' => 'Pendulum',
        'difficulty' => "Iridescence",
        'required_mods' => 'DT',    
        'beatmap_image' => 'hold_your_colour.jpg', 
        'description' => '$200 for the first FC https://youtu.be/qGtRX9T5Sxc',
        'donators' => 'Unknown',
        'reward' => '$200',
        'completed' => true,
        'completed_by' => "RyuK",
        'completed_at' => "8/17/2020",
        ]);
    }
}
