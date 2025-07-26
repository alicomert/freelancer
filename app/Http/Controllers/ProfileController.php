<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
