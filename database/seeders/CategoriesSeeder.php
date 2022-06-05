<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array('id' => '1','title' => 'Tableau de bord','link' => 'admin.dashboard','icon' => 'ri-dashboard-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','title' => 'Utilisateurs','link' => 'users','icon' => 'ri-contacts-book-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','title' => 'System','link' => 'system','icon' => 'ri-settings-line','created_at' => NULL,'updated_at' => NULL)

        );
        DB::table('categories')->insert($categories);
    }
}
