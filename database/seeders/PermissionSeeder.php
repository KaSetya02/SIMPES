<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'super-admin']);
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'walisantri']);
        Permission::create(['name' => 'santri']);

        //create roles and assign existing permissions
        $superadminRole = Role::create(['name' => 'super-admin']);
        $superadminRole->givePermissionTo('super-admin');
        $superadminRole->givePermissionTo('admin');
        $superadminRole->givePermissionTo('walisantri');
        $superadminRole->givePermissionTo('santri');

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('admin');
        $adminRole->givePermissionTo('walisantri');
        $adminRole->givePermissionTo('santri');

        $waliRole = Role::create(['name' => 'walisantri ']);
        $waliRole->givePermissionTo('walisantri');
        $waliRole->givePermissionTo('santri');

        $santriRole = Role::create(['name' => 'santri ']);
        $santriRole->givePermissionTo('santri');

        // gets all permissions via Gate::before rule

        // create demo users
        $userSuper = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@superadmin.com',
            'password' => bcrypt('123123123'),
            'pesantren_id' => 1,
            'pegawai_id' => 1
        ]);
        $userSuper->assignRole($superadminRole);

        $userAdmin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123123'),
            'pesantren_id' => 1,
            'pegawai_id' => 1
        ]);
        $userAdmin->assignRole($adminRole);

        $userWaliSantri = User::factory()->create([
            'name' => 'Wali Murid',
            'email' => 'walimurid@walimurid.com',
            'password' => bcrypt('123123123'),
            'pesantren_id' => 1,
            'pegawai_id' => 1
        ]);
        $userWaliSantri->assignRole($waliRole);

        $usersantri = User::factory()->create([
            'name' => 'Santri',
            'email' => 'santri@santri.com',
            'password' => bcrypt('123123123'),
            'pesantren_id' => 1,
            'pegawai_id' => 1
        ]);
        $usersantri->assignRole($santriRole);


    }
}
