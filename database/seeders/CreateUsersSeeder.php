<?php
  
use Illuminate\Database\Seeder;
use App\Models\User;
   
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'gender'=>'female',
               'email'=>'admin@laravelia.com',
                'type'=>'1',
                'date_of_birth'=>'1000-01-01',
               'password'=> bcrypt('secret'),
            ],
            [
               'name'=>'User',
               'gender'=>'female',
               'email'=>'user@laravelia.com',
                'type'=>'0',
                'date_of_birth'=>'1000-01-01',
               'password'=> bcrypt('secret'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
