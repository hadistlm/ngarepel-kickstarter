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
                "RoleController" => ["POST","PUT","PATCH","GET","DELETE"],
                "DashboardController" => ["POST","PUT","PATCH","GET","DELETE"]
            ]
        ]);

    	$author = Role::create([
            'name' => 'Author', 
            'slug' => 'author',
            'permissions' => ["DashboardController" => ["GET"]]
        ]);
        
        $editor = Role::create([
            'name' => 'Editor', 
            'slug' => 'editor',
            'permissions' => ["DashboardController" => ["GET"]]
        ]);

        $viewer = Role::create([
            'name' => 'Viewer', 
            'slug' => 'viewer',
            'permissions' => ["DashboardController" => ["GET"]]
        ]);
    }
}
