<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $directory = 'avatars';

        Storage::disk('public')->deleteDirectory($directory);

        $users = [
            'john-doe',
            'ryland-ibarra',
            'madilynn-correa',
            'zakai-edwards',
            'ivy-grant',
            'leon-lambert'
        ];

        foreach ($users as $key => $user) {
            $name = Str::of($user)->replace('-', ' ')->title()->toString();
            $email = Str::of($user)->replace('-', '.')->append('@example.com')->toString();
            $imageUrl = database_path('fixtures/images/user-' . $key + 1 . '.jpg');
            $avatar = Storage::disk('public')->putFile($directory, $imageUrl);

            User::factory()->create([
                'name' => $name,
                'email' => $email,
                'avatar' => $avatar
            ]);
        }
    }
}
