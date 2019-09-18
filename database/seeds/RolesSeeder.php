<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin	= Role::create([
            'name' => 'Administrator', 
            'slug' => 'admin',
            'permissions' => [
                "HomeController" => ["POST","PUT","PATCH","GET","DELETE"],
                "RoleController" => ["POST","PUT","PATCH","GET","DELETE"]
            ]
        ]);

    	$author = Role::create([
            'name' => 'Author', 
            'slug' => 'author',
            'permissions' => ["HomeController" => ["GET"]]
        ]);
        
        $editor = Role::create([
            'name' => 'Editor', 
            'slug' => 'editor',
            'permissions' => ["HomeController" => ["GET"]]
        ]);

        $viewer = Role::create([
            'name' => 'Viewer', 
            'slug' => 'viewer',
            'permissions' => ["HomeController" => ["GET"]]
        ]);
    }
}
