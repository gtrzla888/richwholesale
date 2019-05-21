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
        $company1->name = 'Company One';
        $company1->abn = '1111111111';
        $company1->save();

        $company2 = new Company();
        $company2->name = 'Company Two';
        $company2->abn = '2222222222';
        $company2->save();

        $company3 = new Company();
        $company3->name = 'Company Three';
        $company3->abn = '333333333';
        $company3->save();

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

        $user = new User();
        $user->name = 'Company3 Admin';
        $user->email = 'company3.admin@thompsontech.com.au';
        $user->password = bcrypt('secretsecret');
        $user->role = User::ROLE_COMPANY_ADMIN;
        $user->save();
        $user->companies()->saveMany([$company3]);

        $user = new User();
        $user->name = 'Company3 User';
        $user->email = 'company3.user@thompsontech.com.au';
        $user->password = bcrypt('secretsecret');
        $user->role = User::ROLE_COMPANY_USER;
        $user->save();
        $user->companies()->saveMany([$company3]);

    }
}
