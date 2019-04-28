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

        $company = new Company();
        $company->name = 'Rich WholeSale';
        $company->abn = '2039929922';
        $company->save();
        $user->companies()->attach($company);
        $user->save();

        $user = new User();
        $user->name = 'Company Admin';
        $user->email = 'company.admin@thompsontech.com.au';
        $user->password = bcrypt('secretsecret');
        $user->role = User::ROLE_COMPANY_ADMIN;
        $user->save();

        $user = new User();
        $user->name = 'Company User';
        $user->email = 'company.user@thompsontech.com.au';
        $user->password = bcrypt('secretsecret');
        $user->role = User::ROLE_COMPANY_USER;
        $user->save();

        $company = new Company();
        $company->name = 'Thompson Tech';
        $company->abn = '2039929922';
        $company->save();
        $user->companies()->attach($company);
        $user->save();
    }
}
