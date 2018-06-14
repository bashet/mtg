<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ability;

class UserAbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $model = 'User';
        Ability::where('model', $model)->delete();

        Ability::firstOrCreate(['title' => 'See all the users', 'ability' => 'see_all_users', 'model' => $model]);

        Ability::firstOrCreate(['title' => 'Add new user', 'ability' => 'add_new_user', 'model' => $model]);

        Ability::firstOrCreate(['title' => 'Edit user information', 'ability' => 'edit_user', 'model' => $model]);

        Ability::firstOrCreate(['title' => 'Change user status', 'ability' => 'change_user_status', 'model' => $model]);

        Ability::firstOrCreate(['title' => "See other's profile", 'ability' => 'see_user_profile', 'model' => $model]);

        Ability::firstOrCreate(['title' => 'Login as another user', 'ability' => 'login_as', 'model' => $model]);

        Ability::firstOrCreate(['title' => 'Delete user account', 'ability' => 'delete_user', 'model' => $model]);

        Ability::firstOrCreate(['title' => 'Change password for another user', 'ability' => 'change_user_password', 'model' => $model]);

        Ability::firstOrCreate(['title' => 'View user abilities', 'ability' => 'view_user_abilities', 'model' => 'User',]);

        Ability::firstOrCreate(['title' => 'Override user abilities', 'ability' => 'override_user_abilities', 'model' => $model]);

        Ability::firstOrCreate(['title' => 'Manage Site Configuration', 'ability' => 'manage_config', 'model' => $model]);

    }
}
