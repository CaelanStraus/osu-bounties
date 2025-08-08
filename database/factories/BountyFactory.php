<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bounty>
 */
class BountyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'beatmap_title'   => 'Test Beatmap',
            'beatmap_url'     => 'https://osu.ppy.sh/beatmapsets/813569#osu/1706210',
            'artist'          => 'Test Artist',
            'difficulty'      => 'Insane',
            'required_mods'   => 'NM',
            'beatmap_image'   => null,
            'description'     => 'Test bounty description.',
            'donators'        => 'Anonymous',
            'reward'          => '10$',
            'completed'       => false,
            'completed_by'    => null,
            'completed_at'    => null,
        ];
    }
}