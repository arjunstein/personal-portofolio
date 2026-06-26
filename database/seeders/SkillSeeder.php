<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'Laravel', 'level' => 95, 'category' => 'Backend', 'sort_order' => 1],
            ['name' => 'PHP', 'level' => 90, 'category' => 'Backend', 'sort_order' => 2],
            ['name' => 'React', 'level' => 85, 'category' => 'Frontend', 'sort_order' => 3],
            ['name' => 'Vue.js', 'level' => 80, 'category' => 'Frontend', 'sort_order' => 4],
            ['name' => 'Tailwind CSS', 'level' => 90, 'category' => 'Frontend', 'sort_order' => 5],
            ['name' => 'JavaScript', 'level' => 85, 'category' => 'Frontend', 'sort_order' => 6],
            ['name' => 'TypeScript', 'level' => 75, 'category' => 'Frontend', 'sort_order' => 7],
            ['name' => 'MySQL', 'level' => 85, 'category' => 'Database', 'sort_order' => 8],
            ['name' => 'PostgreSQL', 'level' => 75, 'category' => 'Database', 'sort_order' => 9],
            ['name' => 'MongoDB', 'level' => 70, 'category' => 'Database', 'sort_order' => 10],
            ['name' => 'Docker', 'level' => 80, 'category' => 'DevOps', 'sort_order' => 11],
            ['name' => 'Git', 'level' => 90, 'category' => 'DevOps', 'sort_order' => 12],
            ['name' => 'AWS', 'level' => 65, 'category' => 'DevOps', 'sort_order' => 13],
            ['name' => 'Redis', 'level' => 70, 'category' => 'Backend', 'sort_order' => 14],
            ['name' => 'Livewire', 'level' => 85, 'category' => 'Backend', 'sort_order' => 15],
            ['name' => 'Alpine.js', 'level' => 80, 'category' => 'Frontend', 'sort_order' => 16],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
