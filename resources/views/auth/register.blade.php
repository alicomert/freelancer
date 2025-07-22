@extends('layouts.app')

@section('title', 'Kayıt Ol - ProConnect')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8">
        <div>
            <div class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-blue-100">
                <i class="fas fa-user-plus text-blue-600 text-2xl"></i>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Hesap oluşturun
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Zaten hesabınız var mı?
                <button onclick="openLoginModal()" class="font-medium text-blue-600 hover:text-blue-500">
                    Giriş yapın
                </button>
            </p>
        </div>
        
        <form id="registerForm" class="mt-8 space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">Ad *</label>
                    <input type="text" name="first_name" id="first_name" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Soyad *</label>
                    <input type="text" name="last_name" id="last_name" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Kullanıcı Adı *</label>
                <input type="text" name="username" id="username" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-posta *</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Şifre *</label>
                    <input type="password" name="password" id="password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Şifre Tekrar *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telefon</label>
                    <input type="tel" name="phone" id="phone"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700">Doğum Tarihi</label>
                    <input type="date" name="birth_date" id="birth_date"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            
            <div>
                <label for="tc_identity" class="block text-sm font-medium text-gray-700">TC Kimlik No</label>
                <input type="text" name="tc_identity" id="tc_identity" maxlength="11"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Kimlik doğrulaması için (isteğe bağlı)">
                <p class="mt-1 text-sm text-gray-500">TC kimlik numaranızı girerek hesabınızı doğrulayabilirsiniz.</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex items-center">
                    <input type="checkbox" name="is_company" id="is_company" 
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_company" class="ml-2 block text-sm font-medium text-gray-900">
                        Şirket hesabı olarak kayıt ol
                    </label>
                </div>
                <p class="mt-1 text-sm text-gray-500">Şirket hesabı ile proje yayınlayabilir ve freelancer'larla çalışabilirsiniz.</p>
                
                <div id="companyFields" class="hidden mt-4">
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Şirket Adı *</label>
                    <input type="text" name="company_name" id="company_name"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-user-plus text-blue-500 group-hover:text-blue-400"></i>
                    </span>
                    Hesap Oluştur
                </button>
            </div>

            <div id="registerError" class="hidden mt-3 text-sm text-red-600 bg-red-50 border border-red-200 rounded-md p-3"></div>
        </form>
    </div>
</div>

<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Giriş Yap</h3>
                <button onclick="closeLoginModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="loginForm" class="space-y-4">
                @csrf
                <div>
                    <label for="login_email" class="block text-sm font-medium text-gray-700">E-posta</label>
                    <input type="email" name="email" id="login_email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="login_password" class="block text-sm font-medium text-gray-700">Şifre</label>
                    <input type="password" name="password" id="login_password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Beni hatırla
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                            Şifrenizi mi unuttunuz?
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeLoginModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                        İptal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                        Giriş Yap
                    </button>
                </div>
                
                <div id="loginError" class="hidden mt-3 text-sm text-red-600 bg-red-50 border border-red-200 rounded-md p-3"></div>
            </form>
        </div>
    </div>
</div>

<script>
// Modal functions
function openLoginModal() {
    document.getElementById('loginModal').classList.remove('hidden');
}

function closeLoginModal() {
    document.getElementById('loginModal').classList.add('hidden');
    document.getElementById('loginForm').reset();
    document.getElementById('loginError').classList.add('hidden');
}

// Company fields toggle
document.getElementById('is_company').addEventListener('change', function() {
    const companyFields = document.getElementById('companyFields');
    const companyNameInput = document.getElementById('company_name');
    
    if (this.checked) {
        companyFields.classList.remove('hidden');
        companyNameInput.required = true;
    } else {
        companyFields.classList.add('hidden');
        companyNameInput.required = false;
    }
});

// Register form submission
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const errorDiv = document.getElementById('registerError');
    
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Kayıt yapılıyor...';
    errorDiv.classList.add('hidden');
    
    try {
        const response = await fetch('{{ route("register") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            let errorMessage = data.message;
            if (data.errors) {
                errorMessage += '<ul class="mt-2 list-disc list-inside">';
                Object.values(data.errors).forEach(errors => {
                    errors.forEach(error => {
                        errorMessage += `<li>${error}</li>`;
                    });
                });
                errorMessage += '</ul>';
            }
            errorDiv.innerHTML = errorMessage;
            errorDiv.classList.remove('hidden');
        }
    } catch (error) {
        errorDiv.textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        errorDiv.classList.remove('hidden');
    } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = '<span class="absolute left-0 inset-y-0 flex items-center pl-3"><i class="fas fa-user-plus text-blue-500 group-hover:text-blue-400"></i></span>Hesap Oluştur';
    }
});

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
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            errorDiv.textContent = data.message;
            errorDiv.classList.remove('hidden');
        }
    } catch (error) {
        errorDiv.textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        errorDiv.classList.remove('hidden');
    } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = 'Giriş Yap';
    }
});

// Close modals when clicking outside
document.getElementById('loginModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLoginModal();
    }
});
</script>
@endsection