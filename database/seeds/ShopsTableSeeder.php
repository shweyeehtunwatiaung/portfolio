<?php

use App\Category;
use App\Role;
use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $pictures = collect(range(1,11));
        $users = Role::findOrFail(2)->users;
        $categories = Category::all()->pluck('id');

        $addresses = [
            [
                "name" => "Myitkyina General Hospital",
                "address" => "Myitkyina",
                "latitude" => "25.3949275",
                "longitude" => "97.393135"
            ],
            [
                "name" => "MMcities (MMUA co.,ltd)",
                "address" => "No. 150 47th St, Yangon 11161",
                "latitude" => "16.7775042",
                "longitude" => "96.1667968"
            ],
            [
                "name" => "Ruby Mart",
                "address" => "Bo Gyoke Road, Yangon",
                "latitude" => "16.7790315",
                "longitude" => "96.1600138"
            ],
            [
                "name" => "Alongtaw Kassapa အလောင်းတော်ကဿပ",
                "address" => "Sagaing Division in Myanmar(Burma)",
                "latitude" => "22.3209285",
                "longitude" => "94.4366013"
            ],
            [
                "name" => "Myanmar Plaza",
                "address" => "Kabar Aye Pagoda Road, Yangon",
                "latitude" => "16.8277121",
                "longitude" => "96.1528455"
            ],
            [
                "name" => "General Aung San Park",
                "address" => "Nat Mauk St, Yangon",
                "latitude" => "16.7989170918",
                "longitude" => "96.1641822170"
            ],
            [
                "name" => "AKK Shopping Centre",
                "address" => "Lay Daungkan Road, Yangon",
                "latitude" => "16.8295292",
                "longitude" => "96.1895227"
            ],
            [
                "name" => "Sule Pagoda",
                "address" => "Maha Bandula Yangon",
                "latitude" => "16.7744705798",
                "longitude" => "96.1587319683"
            ],
            [
                "name" => "Yangon Zoological Garden",
                "address" => "Kan Yeik Tha Road, Yangon",
                "latitude" => "16.7952605868",
                "longitude" => "96.1589465450"
            ],
            [
                "name" => "Kandawgyi Lake",
                "address" => "Kan Yeik Tha Road, Yangon",
                "latitude" => "16.7952195021",
                "longitude" => "96.1654696774"
            ],
        ];

        $currentAddress = 0;

        foreach($users as $user)
        {
            $shop = [
                'name' => $faker->name,
                'description' => $faker->paragraph,
                'address' => $faker->address,
                'active' => 1,
            ];
            $shop = $user->shops()->create(array_merge($shop, $addresses[$currentAddress++]));
            $shop->categories()->sync($categories->random(rand(0,3)));

            foreach($pictures->random(rand(1,3)) as $index)
            {
                $shop->addMediaFromUrl(public_path("assets/images/shops/a$index.jpg"))->toMediaCollection('photos');
            }
        }
    }
}
