<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil role konsumen
        $memberRole = Role::where('name', 'member')->first();

        $member = Member::create([
            'nama' => 'Member 1',
            'sapaan' => 'Pak',
            'email' => 'member@gmail.com',
            'telepon' => '0812345678',
            'password' => Hash::make('member123'),
        ]);

        // Tambahkan role konsumen ke user
        $member->addRole($memberRole);
    }
}
