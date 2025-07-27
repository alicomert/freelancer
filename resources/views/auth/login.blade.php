@extends('layouts.app')

@section('title', 'Giriş Yap - ProConnect')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                <i class="fas fa-user-circle text-blue-600 dark:text-blue-400 text-2xl"></i>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                Hesabınıza giriş yapın
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                Hesabınız yok mu?
                <button onclick="openAuthModal('register')" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
                    Hemen kayıt olun
                </button>
            </p>
        </div>

        @if(session('banned_message'))
        <div class="bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                        Hesabınız Banlandı
                    </h3>
                    <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                        <p>{{ session('banned_message') }}</p>
                        <p class="mt-2">Bir yanlışlık olduğunu düşünüyorsanız bizimle iletişime geçin.</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <form id="loginForm" class="mt-8 space-y-6">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="login_field" class="sr-only">Kullanıcı adı veya e-posta</label>
                    <input id="login_field" name="login_field" type="text" autocomplete="email" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-700 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm transition-colors" 
                           placeholder="Kullanıcı adı veya e-posta">
                </div>
                <div>
                    <label for="password" class="sr-only">Şifre</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-700 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm transition-colors" 
                           placeholder="Şifre">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" 
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700">
                    <label for="remember" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                        Beni hatırla
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
                        Şifrenizi mi unuttunuz?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt text-blue-500 group-hover:text-blue-400"></i>
                    </span>
                    Giriş Yap
                </button>
            </div>

            <div id="loginError" class="hidden mt-3 text-sm text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 rounded-md p-3"></div>
        </form>
    </div>
</div>

<script>
// Login form submission
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const errorDiv = document.getElementById('loginError');
    
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Giriş yapılıyor...';
    errorDiv.classList.add('hidden');
    
    try {
        const response = await fetch('{{ route("login") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            if (data.redirect) {
                window.location.href = data.redirect;
            } else {
                window.location.reload();
            }
        } else {
            errorDiv.textContent = data.message || 'Giriş başarısız!';
            errorDiv.classList.remove('hidden');
        }
    } catch (error) {
        console.error('Error:', error);
        errorDiv.textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        errorDiv.classList.remove('hidden');
    } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = '<span class="absolute left-0 inset-y-0 flex items-center pl-3"><i class="fas fa-sign-in-alt text-blue-500 group-hover:text-blue-400"></i></span>Giriş Yap';
    }
});
</script>
@endsection