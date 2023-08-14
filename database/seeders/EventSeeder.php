<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'          =>  'GCES Expo 9th Edition',
                'slug'          =>  'gces-expo-9th-edition',
                'description'   =>  'hello world this is new world',
                'photo'         =>  'gces-expo-9th-1690299468.jpg',
                'location'      =>  'Pokhara-9',
                'cat_id'        =>  4,
                'organize_by'   =>  1,
                'start'         =>  '2021-07-28 15:00:00',
                'created_at'    =>  Carbon::now(),
                'updated_at'    =>  Carbon::now(),
            ],
            [
                'name'          =>  'PU Quiz Competition',
                'slug'          =>  'pu-quiz-competition',
                'description'   =>  'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste ad molestias, suscipit cum exercitationem quia quod vel illum officiis eligendi reiciendis quaerat incidunt! Eveniet ea iusto perferendis vitae nam libero doloribus iure a. Pariatur nihil minima beatae, temporibus quisquam porro, consectetur autem repellat, explicabo in id sapiente rerum ducimus iusto veritatis architecto placeat nobis dignissimos? Vitae quam deleniti odit aut minima perspiciatis exercitationem vel dolor reiciendis mollitia, laudantium id voluptatem harum laboriosam? Eum, repellat ut voluptatibus rerum illo neque facilis ex dolor beatae harum, nulla at corrupti? Nobis ea iusto aperiam accusantium mollitia error id quaerat expedita necessitatibus, adipisci laborum!',
                'photo'         =>  'gces-expo-9th-1690299468.jpg',
                'location'      =>  'Pokhara-2',
                'cat_id'        =>  3,
                'organize_by'   =>  2,
                'start'         =>  '2021-08-28 15:00:00',
                'created_at'    =>  Carbon::now(),
                'updated_at'    =>  Carbon::now(),
            ],
            [
                'name'          =>  'InfoMax Spelling Competition',
                'slug'          =>  'infomax-spelling-competition',
                'description'   =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident, numquam? Aperiam libero ipsa vero nemo ipsum, ad id soluta odit!',
                'photo'         =>  'gces-expo-9th-1690299468.jpg',
                'location'      =>  'Pokhara-4',
                'cat_id'        =>  4,
                'organize_by'   =>  1,
                'start'         =>  '2021-08-28 15:00:00',
                'created_at'    =>  Carbon::now(),
                'updated_at'    =>  Carbon::now(),
            ]
        ];

        \App\Models\Event::insert($data);
    }
}
