<?php

namespace Database\Seeders;

use App\Models\Display;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Michael Jones',
            'email' => 'michael@bluesignage.co.uk',
        ]);

        //https://lightfind.uk/geojson
        $jsonDisplays = json_decode(file_get_contents('https://lightfind.uk/geojson'));
        foreach ($jsonDisplays->features as $display) {
            $images = [];
            foreach ($display->properties->img as $image) {
                $url = 'https://lightfind.uk/' . $image;
                $file = explode('/', $image);
                $filename_image = end($file);
                $img = public_path('display_images/' . $filename_image);
                if (!file_exists($img)) {
                    file_put_contents($img, file_get_contents($url));
                }
                $images[] = $filename_image;
            }

            $displayName = str_replace(["&#039;", "&amp;"], ["'", "&"], $display->properties->name);
            Display::create([
                'name' => $displayName,
                'image' => isset($display->properties->img[0]) ? 'https://lightfind.uk/' . $display->properties->img[0] : 'https://placehold.co/600x400',
                'longitude' => $display->geometry->coordinates[1],
                'latitude' => $display->geometry->coordinates[0],
                'approved' => $display->properties->approved,
                'verified' => $display->properties->verified,
                'images' => $images,
            ]);
            $this->command->info('Display added: ' . $displayName);
        }
    }
}
