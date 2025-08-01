<?php

namespace App\Http\Controllers;

use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        // Eğer user_id parametresi varsa o kullanıcının becerilerini getir
        $userId = $request->input('user_id');
        
        if ($userId) {
            $user = \App\Models\User::findOrFail($userId);
            $skills = $user->skills()->orderBy('sort_order')->get();
        } else {
            // Parametresi yoksa giriş yapan kullanıcının becerilerini getir
            $user = Auth::user();
            $skills = $user->skills()->orderBy('sort_order')->get();
        }

        return response()->json([
            'expertise' => $skills->where('type', 'expertise')->values(),
            'tools' => $skills->where('type', 'tool')->values(),
            'can_edit' => Auth::check() && Auth::id() === $user->id,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|in:expertise,tool',
            'level' => 'required_if:type,expertise|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $sortOrder = $user->skills()->where('type', $request->type)->max('sort_order') + 1;

        $skill = $user->skills()->create([
            'name' => $request->name,
            'type' => $request->type,
            'level' => $request->type === 'expertise' ? $request->level : null,
            'sort_order' => $sortOrder,
        ]);

        return response()->json(['success' => true, 'skill' => $skill]);
    }

    public function update(Request $request, UserSkill $skill)
    {
        if (Gate::denies('update', $skill)) {
            return response()->json([
                'success' => false,
                'message' => 'Bu işlem için yetkiniz yok.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'level' => 'required_if:type,expertise|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $skill->update($request->only('level'));

        return response()->json(['success' => true, 'skill' => $skill]);
    }

    public function destroy(UserSkill $skill)
    {
        try {
            // Policy kontrolü
            if (Gate::denies('delete', $skill)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bu işlem için yetkiniz yok.'
                ], 403);
            }
            
            // Beceriyi sil
            $skill->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Beceri başarıyla silindi.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Skill deletion error: ' . $e->getMessage(), [
                'skill_id' => $skill->id,
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Beceri silinirken bir hata oluştu.'
            ], 500);
        }
    }

    public function updateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'skills' => 'required|array',
            'skills.*.id' => 'required|exists:user_skills,id',
            'skills.*.sort_order' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        foreach ($request->skills as $skillData) {
            $skill = UserSkill::find($skillData['id']);
            if ($skill && $skill->user_id === Auth::id()) {
                $skill->update(['sort_order' => $skillData['sort_order']]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('query', '');
            $skillsPath = resource_path('data/skills.json');

            if (!File::exists($skillsPath)) {
                $this->generateSkillsJson();
            }

            $allSkills = json_decode(File::get($skillsPath), true);
            
            // Ensure we have a valid array
            if (!is_array($allSkills)) {
                $allSkills = [];
            }
            
            if (empty($query)) {
                return response()->json(array_slice($allSkills, 0, 15));
            }

            $filteredSkills = array_filter($allSkills, function ($skill) use ($query) {
                return stripos($skill, $query) !== false;
            });

            return response()->json(array_values($filteredSkills));
        } catch (\Exception $e) {
            \Log::error('Skills search error: ' . $e->getMessage(), [
                'query' => $request->input('query', ''),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([], 500);
        }
    }

    private function generateSkillsJson()
    {
        $htmlPath = base_path('Freelancer/uzmanliklar.html');
        if (!File::exists($htmlPath)) {
            return;
        }

        $htmlContent = File::get($htmlPath);
        preg_match_all('/<span class="text">(.*?)<\/span>/', $htmlContent, $matches);
        
        $skills = $matches[1] ?? [];
        
        $skills = array_map('trim', $skills);
        $skills = array_unique($skills);
        sort($skills);

        $dataDir = resource_path('data');
        if (!File::isDirectory($dataDir)) {
            File::makeDirectory($dataDir, 0755, true);
        }

        File::put(resource_path('data/skills.json'), json_encode(array_values($skills), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}