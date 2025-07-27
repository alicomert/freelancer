<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Epigra\TcKimlik;
use App\Models\User;

class ProfileController extends Controller
{
    public function show($username)
    {
        // Protected routes that cannot be used as usernames
        $protectedRoutes = [
            'search', 'projects', 'services', 'community', 'posts', 'categories', 
            'messages', 'notifications', 'wallet', 'auctions', 'settings', 
            'freelancers', 'profile', 'dashboard', 'login', 'register', 
            'logout', 'site-settings', 'admin', 'api', 'storage', 'public'
        ];
        
        // Check if the username is a protected route
        if (in_array($username, $protectedRoutes)) {
            abort(404);
        }
        
        // Find user by username with educations and skills
        $user = User::with(['educations', 'skills' => function($query) {
            $query->orderBy('sort_order', 'asc');
        }])->where('username', $username)->first();
        
        if (!$user) {
            abort(404);
        }
        
        // Check if the current user can edit this profile
        $canEdit = auth()->check() && auth()->id() === $user->id;
        
        return view('profile.index', compact('user', 'canEdit'));
    }

    public function updateBio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bio' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            $user = Auth::user();
            $user->bio = $request->bio;
            $user->save();

            return response()->json([
                'success' => true, 
                'message' => 'Biyografi başarıyla güncellendi.',
                'bio' => $user->bio
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Biyografi güncellenirken bir hata oluştu.'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        // Check if user can edit this profile
        if (!auth()->check() || auth()->id() != $id) {
            return response()->json([
                'success' => false,
                'message' => 'Bu profili düzenleme yetkiniz yok.'
            ], 403);
        }

        $user = User::findOrFail($id);

        // Validation rules
        $rules = [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
        ];

        // If password fields are provided, add password validation
        if ($request->filled('current_password') || $request->filled('password')) {
            $rules['current_password'] = 'required|string';
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            // Check current password if password change is requested
            if ($request->filled('current_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Mevcut şifre yanlış.'
                    ], 422);
                }
            }

            // Update basic info
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;

            $passwordChanged = false;
            
            // Update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
                $passwordChanged = true;
            }

            $user->save();

            // If password changed, logout user from all sessions except current
            if ($passwordChanged) {
                // Delete all other sessions for this user
                DB::table('sessions')
                    ->where('user_id', $user->id)
                    ->where('id', '!=', request()->session()->getId())
                    ->delete();
            }

            $response = [
                'success' => true,
                'message' => 'Profil bilgileri başarıyla güncellendi.',
                'user' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name
                ]
            ];

            // Add password change info if password was changed
            if ($passwordChanged) {
                $response['password_changed'] = true;
                $response['message'] = 'Profil bilgileri güncellendi. Şifreniz değiştirildi, güvenlik nedeniyle otomatik çıkış yapılacak.';
            }

            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Profil güncellenirken bir hata oluştu.'
            ], 500);
        }
    }

    public function verifyIdentity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tc_no' => 'required|tckimlik',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_year' => 'required|numeric|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $data = [
            'tcno'      => $request->tc_no,
            'isim'      => $request->first_name,
            'soyisim'   => $request->last_name,
            'dogumyili' => $request->birth_year,
        ];

        if (TcKimlik::validate($data)) {
            $user = Auth::user();
            $user->tc_identity = $request->tc_no; // Mutator şifreleyecek
            $user->tc_verified = true;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Kimlik başarıyla doğrulandı.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Kimlik bilgileri doğrulanamadı. Lütfen bilgilerinizi kontrol edin.']);
        }
    }

}
