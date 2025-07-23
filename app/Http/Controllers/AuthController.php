<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        // Input sanitization and XSS protection
        $loginField = strip_tags(trim($request->input('login_field')));
        $password = $request->input('password');
        
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'login_field' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ], [
            'login_field.required' => 'Kullanıcı adı veya e-posta adresi zorunludur.',
            'password.required' => 'Şifre zorunludur.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lütfen tüm alanları doldurun.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check for potential XSS attacks
        if (preg_match('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', $loginField) ||
            preg_match('/javascript:/i', $loginField) ||
            preg_match('/on\w+\s*=/i', $loginField)) {
            return response()->json([
                'success' => false,
                'message' => 'Geçersiz karakter tespit edildi.'
            ], 422);
        }

        // Determine if login field is email or username
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        // Attempt login with either email or username
        $credentials = [
            $fieldType => $loginField,
            'password' => $password
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            return response()->json([
                'success' => true,
                'message' => 'Giriş başarılı!',
                'user' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'full_name' => $user->first_name . ' ' . $user->last_name
                ],
                'redirect' => route('home')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Kullanıcı adı/e-posta veya şifre hatalı.'
        ], 422);
    }

    public function registerStep1(Request $request)
    {
        // Input sanitization and XSS protection
        $firstName = strip_tags(trim($request->input('first_name')));
        $lastName = strip_tags(trim($request->input('last_name')));
        $username = strip_tags(trim($request->input('username')));

        // Check for potential XSS attacks in all fields
        $fields = [$firstName, $lastName, $username];
        foreach ($fields as $field) {
            if (preg_match('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', $field) ||
                preg_match('/javascript:/i', $field) ||
                preg_match('/on\w+\s*=/i', $field) ||
                preg_match('/<[^>]*>/i', $field)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Geçersiz karakter tespit edildi.'
                ], 422);
            }
        }

        $validator = Validator::make([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $username
        ], [
            'first_name' => 'required|string|max:255|regex:/^[a-zA-ZğüşıöçĞÜŞİÖÇ\s]+$/',
            'last_name' => 'required|string|max:255|regex:/^[a-zA-ZğüşıöçĞÜŞİÖÇ\s]+$/',
            'username' => 'required|string|max:255|unique:users|regex:/^[a-zA-Z0-9_]+$/',
        ], [
            'first_name.required' => 'Ad alanı zorunludur.',
            'first_name.regex' => 'Ad sadece harf içerebilir.',
            'last_name.required' => 'Soyad alanı zorunludur.',
            'last_name.regex' => 'Soyad sadece harf içerebilir.',
            'username.required' => 'Kullanıcı adı zorunludur.',
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'username.regex' => 'Kullanıcı adı sadece harf, rakam ve alt çizgi içerebilir.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lütfen tüm alanları doğru şekilde doldurun.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Session'a kaydet
        session([
            'register_step1' => [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'İlk adım başarıyla tamamlandı.'
        ]);
    }

    public function register(Request $request)
    {
        // Session'dan ilk adım verilerini al
        $step1Data = session('register_step1');
        
        if (!$step1Data) {
            return response()->json([
                'success' => false,
                'message' => 'Kayıt işlemi baştan başlatılmalı.'
            ], 400);
        }

        // Input sanitization and XSS protection
        $email = strip_tags(trim($request->input('email')));
        $birthDate = strip_tags(trim($request->input('birth_date')));
        $password = $request->input('password'); // Password should not be stripped

        // Check for potential XSS attacks in email and birth_date
        $fields = [$email, $birthDate];
        foreach ($fields as $field) {
            if (preg_match('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', $field) ||
                preg_match('/javascript:/i', $field) ||
                preg_match('/on\w+\s*=/i', $field) ||
                preg_match('/<[^>]*>/i', $field)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Geçersiz karakter tespit edildi.'
                ], 422);
            }
        }

        $validator = Validator::make([
            'email' => $email,
            'birth_date' => $birthDate,
            'password' => $password
        ], [
            'email' => 'required|string|email|max:255|unique:users',
            'birth_date' => 'required|date|before:today',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'email.required' => 'E-posta adresi zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi girin.',
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
            'birth_date.required' => 'Doğum tarihi zorunludur.',
            'birth_date.date' => 'Geçerli bir tarih girin.',
            'birth_date.before' => 'Doğum tarihi bugünden önce olmalıdır.',
            'password.required' => 'Şifre zorunludur.',
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'password.regex' => 'Şifre en az bir büyük harf, bir küçük harf ve bir rakam içermelidir.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lütfen tüm alanları doğru şekilde doldurun.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Kullanıcıyı oluştur
            $user = User::create([
                'first_name' => $step1Data['first_name'],
                'last_name' => $step1Data['last_name'],
                'username' => $step1Data['username'],
                'email' => $email,
                'birth_date' => $birthDate,
                'password' => Hash::make($password),
                'joined_date' => now(),
                'status' => 'active',
            ]);

            // Session'ı temizle
            session()->forget('register_step1');

            // Kullanıcıyı giriş yaptır
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Kayıt başarıyla tamamlandı!',
                'user' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'full_name' => $user->first_name . ' ' . $user->last_name
                ],
                'redirect' => route('home')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kayıt sırasında bir hata oluştu. Lütfen tekrar deneyin.'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}