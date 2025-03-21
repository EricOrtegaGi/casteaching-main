<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function isSuperAdmin(): void
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@casteaching.com',
            'password' => Hash::make('12345678'),
            'super_admin' => true
         ]);

        $this->assertEquals($user->isSuperAdmin(), false);
        $user->super_admin = true;
        $user->save();
        $this->assertEquals($user->isSuperAdmin(), true);
    }
}
