<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call('CategorysTableSeeder');
        //this message shown in your terminal after running db:seed command
        $this->command->info("Categorys table seeded :)");
        
    }
}

class CategorysTableSeeder extends Seeder {
 
       public function run()
       {
         //delete users table records
         DB::table('categorys')->delete();
         //insert some dummy records
         DB::table('categorys')->insert(array(
             array('category'=>'Phone'),
             array('category'=>'Computer & Software'),
             array('category'=>'Electronics & Appliances'),
             array('category'=>'Camera & Camcorder'),
             array('category'=>'Fashion'),
             array('category'=>'Beauty & Personal Care'),
             array('category'=>'Toys & Games'),
             array('category'=>'Cars & Transport'),
             array('category'=>'Watches & Clocks'),
             array('category'=>'Grocery'),
             array('category'=>'Home & Gardening'),
             array('category'=>'Sports & Recretion'),
             array('category'=>'Others'),
          ));
       }

       // DB::table('categorys')->insert([
       //      'category' => 	['Phone',
							// 'Computer & Software',
							// 'Electronics & Appliances',
							// 'Camera & Camcorder',
							// 'Fashion',
							// 'Beauty & Personal Care',
							// 'Toys & Games',
							// 'Cars & Transport',
							// 'Watches & Clocks',
							// 'Food & Beverages',
							// 'Home & Gardening',
							// 'Sports & Recreation',
							// 'Others'],
       //  ]);
 
}
