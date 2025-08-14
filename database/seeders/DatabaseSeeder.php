<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Skill;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user with portfolio data embedded
        $user = User::create([
            'name' => 'Brian Yudhistira',
            'email' => 'brian@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            // Portfolio fields moved to user
            'bio' => 'Pengembang web yang passionate dalam menciptakan solusi digital inovatif. Saya memiliki ketertarikan mendalam terhadap teknologi web modern dan selalu antusias untuk mempelajari hal-hal baru dalam dunia IT.',
            'profile_image' => 'image/profile_image/profile.JPG',
            'insta_link' => 'https://www.instagram.com/brian.yudhistira1',
            'git_link' => 'https://github.com/BrianYudhistira',
            'linkedin_link' => 'https://www.linkedin.com/in/brian-yudhistira-95a62b221',
        ]);

        // Create sample projects (directly linked to user)
        Project::create([
            'name' => 'Zee Scraper APP',
            'image' => 'image/profile_image/project_2.png',
            'description' => 'Aplikasi android yang secara otomatis men-scrape dan menampilkan
                  informasi build karakter dari berbagai game, membantu pemain
                  mengakses data penting secara cepat dan praktis.',
            'link' => null,
            'tech_stack' => ['devicon-kotlin-plain', 'devicon-jetpackcompose-plain-wordmark'],
        ]);

        Project::create([
            'name' => 'Arnet Dashboard Web',
            'image' => 'image/profile_image/project_1.png',
            'description' => 'Aplikasi web internal yang dikembangkan di Telkom Indonesia
                  untuk pengumpulan dan visualisasi data agar dapat diakses oleh
                  karyawan secara efisien.',
            'link' => null,
            'tech_stack' => ['devicon-php-plain', 'devicon-laravel-plain', 'devicon-bootstrap-plain', 'devicon-python-plain'],
        ]);

        Project::create([
            'name' => 'Minatku APP',
            'image' => 'image/profile_image/project_3.png',
            'description' => 'MinatKu adalah aplikasi yang dibuat untuk memenuhi proyek
                  capstone dalam program Bangkit. Proyek ini dikerjakan oleh 7
                  peserta dari Bangkit 2023 Batch 2, dengan 3 dari Machine
                  Learning, 2 dari Mobile Development, dan 2 dari Cloud
                  Computing.',
            'link' => null,
            'tech_stack' => ['devicon-kotlin-plain'],
        ]);

        // Create sample skills (directly linked to user)
        $skills = [
            ['name' => 'PHP', 'icon' => 'devicon-php-plain'],
            ['name' => 'Laravel', 'icon' => 'devicon-laravel-plain'],
            ['name' => 'JavaScript', 'icon' => 'devicon-javascript-plain'],
            ['name' => 'Tailwind CSS', 'icon' => 'devicon-tailwindcss-plain'],
            ['name' => 'MySQL', 'icon' => 'devicon-mysql-plain'],
            ['name' => 'Python', 'icon' => 'devicon-python-plain'],
            ['name' => 'Git', 'icon' => 'devicon-git-plain'],
            ['name' => 'VS Code', 'icon' => 'devicon-vscode-plain'],
        ];

        foreach ($skills as $skill) {
            Skill::create([
                'name' => $skill['name'],
                'icon' => $skill['icon'],
            ]);
        }

        // Create some guest users (for future commenting feature)
        User::create([
            'name' => 'Guest User 1',
            'email' => 'guest1@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            // No portfolio fields for guests
        ]);

        User::create([
            'name' => 'Guest User 2',
            'email' => 'guest2@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            // No portfolio fields for guests
        ]);
    }
}
