<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Company;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company1 = new Company();
        $company1->name = 'Company Two';
        $company1->abn = '1111111111';
        $company1->save();

        $company2 = new Company();
        $company2->name = 'Company One';
        $company2->abn = '2222222222';
        $company2->save();

        $user = new User();
        $user->name = 'Wholesale Admin';
        $user->email = 'wholesale.admin@thompsontech.com.au';
        $user->password = bcrypt('secretsecret');
        $user->role = User::ROLE_WHOLESALE_ADMIN;
        $user->save();

        $user = new User();
        $user->name = 'Wholesale User';
        $user->email = 'wholesale.user@thompsontech.com.au';
        $user->password = bcrypt('secretsecret');
        $user->role = User::ROLE_WHOLESALE_USER;
        $user->save();

        $user = new User();
        $user->name = 'Company Admin';
        $user->email = 'company.admin@thompsontech.com.au';
        $user->password = bcrypt('secretsecret');
        $user->role = User::ROLE_COMPANY_ADMIN;
        $user->save();
        $user->companies()->saveMany([$company1, $company2]);

        $user = new User();
        $user->name = 'Company User';
        $user->email = 'company.user@thompsontech.com.au';
        $user->password = bcrypt('secretsecret');
        $user->role = User::ROLE_COMPANY_USER;
        $user->save();
        $user->companies()->saveMany([$company1, $company2]);
    }
}
