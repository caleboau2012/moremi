<?php

use Illuminate\Database\Seeder;

class ProfilePhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Faker\Factory::create();
        for ($i = 0; $i < 20;$i++) {
            $profile = new \App\Profile();
            $profile->first_name = $faker->firstName;
            $profile->last_name = $faker->lastName;
            $profile->email = $faker->email;
            $profile->phone = $faker->phoneNumber;
            $profile->facebook_id = $faker->randomNumber(8);
            $profile->show_private_info = 0;

            $profile->save();
            for ($a = 0; $a < 6; $a++) {
                $full = $faker->image(config('photo.uploads.full_path'), 600, 400, 'cats');  // 'tmp/13b73edae8443990be1aa8f1a483bc27.jpg' it's a cat!
                $thumb = $faker->image(config('photo.uploads.full_path').DIRECTORY_SEPARATOR.'thumbs', 200, 200, 'cats');  // 'tmp/13b73edae8443990be1aa8f1a483bc27.jpg' it's a cat!
                $photo = \App\Photo::create([
                    'profile_id' => $profile->id,
                    'full_path' => $full,
                    'thumb_path' => $thumb

                ]);
            }
            $profile->update(['photo_id'=>$photo->id]);
        }

    }
}
