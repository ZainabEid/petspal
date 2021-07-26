<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
 
    public function run()
    {
        Page::truncate();
        $pages = [
            0=>[
                'page'=> ['en' => 'Support', 'ar' => 'الدعم'],
                'title' => 'title goes here',
                'body' => 'body type some body',
            ],
            1=>[
                'page'=> ['en' => 'Help', 'ar' => 'مساعدة'],
                 'title' => 'title goes here',
                'body' => 'body type some body',
            ],
            2=>[
                'page'=> ['en' => 'Privacy', 'ar' => 'الأمان'],
                'title' => 'title goes here',
                'body' => 'body type some body',
            ],
            3=>[
                'page'=>  ['en' => 'Terms', 'ar' => 'الشروط'],
                'title' => 'title goes here',
                'body' => 'body type some body',
            ],
        ];
        
        foreach ($pages as  $page) {
            
            Page::create($page);
        }
    }
}
