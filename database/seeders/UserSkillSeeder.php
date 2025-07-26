<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSkill;
use App\Models\User;

class UserSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // İlk kullanıcı için beceri verileri
        $user = User::first();
        
        if ($user) {
            // Uzmanlık alanları
            UserSkill::create([
                'user_id' => $user->id,
                'name' => 'React',
                'type' => 'expertise',
                'level' => 90,
                'sort_order' => 1
            ]);
            
            UserSkill::create([
                'user_id' => $user->id,
                'name' => 'Laravel',
                'type' => 'expertise',
                'level' => 85,
                'sort_order' => 2
            ]);
            
            UserSkill::create([
                'user_id' => $user->id,
                'name' => 'JavaScript',
                'type' => 'expertise',
                'level' => 95,
                'sort_order' => 3
            ]);
            
            UserSkill::create([
                'user_id' => $user->id,
                'name' => 'PHP',
                'type' => 'expertise',
                'level' => 88,
                'sort_order' => 4
            ]);
            
            // Araçlar
            UserSkill::create([
                'user_id' => $user->id,
                'name' => 'VS Code',
                'type' => 'tool',
                'level' => null,
                'sort_order' => 5
            ]);
            
            UserSkill::create([
                'user_id' => $user->id,
                'name' => 'Git',
                'type' => 'tool',
                'level' => null,
                'sort_order' => 6
            ]);
            
            UserSkill::create([
                'user_id' => $user->id,
                'name' => 'Docker',
                'type' => 'tool',
                'level' => null,
                'sort_order' => 7
            ]);
            
            UserSkill::create([
                'user_id' => $user->id,
                'name' => 'MySQL',
                'type' => 'tool',
                'level' => null,
                'sort_order' => 8
            ]);
        }
    }
}
