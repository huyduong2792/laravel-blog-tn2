<?php

use App\Models\Comment;
use App\Models\MediaLibrary;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Roles
        $role_editor = Role::firstOrCreate(['name' => Role::ROLE_EDITOR]);
        $role_author = Role::firstOrCreate(['name' => Role::ROLE_AUTHOR]);
        $role_admin = Role::firstOrCreate(['name' => Role::ROLE_ADMIN]);

        // MediaLibrary
        MediaLibrary::firstOrCreate([]);

        // Users
        $user_admin = User::firstOrCreate(
            ['email' => 'duongquanghuy2792000@gmail.com'],
            [
                'name' => 'huyduong2792000',
                'password' => Hash::make('123@Abca'),
                'email_verified_at' => now()
            ]
        );
        $user_admin->roles()->sync([$role_admin->id]);

        $user_editor = User::firstOrCreate(
            ['email' => 'editor@gmail.com'],
            [
                'name' => 'editor',
                'password' => Hash::make('123@Abca'),
                'email_verified_at' => now()
            ]
        );
        $user_editor->roles()->sync([$role_editor->id]);

        $user_author = User::firstOrCreate(
            ['email' => 'author@gmail.com'],
            [
                'name' => 'author',
                'password' => Hash::make('123@Abca'),
                'email_verified_at' => now()
            ]
        );
        $user_author->roles()->sync([$role_author->id]);

        // Posts
        $post = Post::firstOrCreate(
            [
                'title' => 'Hello World',
                'author_id' => $user_admin->id
            ],
            [
                'posted_at' => now(),
                'content' => "
                    Welcome to Laravel-blog !<br><br>
                    Don't forget to read the README before starting.<br><br>
                    Feel free to add a star on Laravel-blog on Github !<br><br>
                    You can open an issue or (better) a PR if something went wrong."
            ]
        );

        // Comments
        Comment::firstOrCreate(
            [
                'author_id' => $user_admin->id,
                'post_id' => $post->id
            ],
            [
                'posted_at' => now(),
                'content' => "Hey ! I'm a comment as example."
            ]
        );
    }
}
