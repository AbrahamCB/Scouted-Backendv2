<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            Social::create([
                'facebook_url'  => 'facebook',
                'twitter_url' => 'twitter',
                'linkedin_url' => 'linkedin',
                'instagram_url' => 'instagram',
            ]);
        }
    }
}
