@extends('layouts.app')

@section('title', 'Kayıt Ol - FreelancerHub')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-blue-100">
                <i class="fas fa-user-plus text-blue-600 text-2xl"></i>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Hesap oluşturun
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Zaten hesabınız var mı?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Giriş yapın
                </a>
            </p>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div id="progressBar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 50%"></div>
        </div>
        <div class="flex justify-between text-sm text-gray-600">
            <span id="step1Label" class="font-medium text-blue-600">1. Temel Bilgiler</span>
            <span id="step2Label" class="text-gray-400">2. Şifre & Doğum Tarihi</span>
        </div>

        <!-- Step 1 Form -->
        <form id="step1Form" class="mt-8 space-y-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">Ad *</label>
                    <input type="text" name="first_name" id="first_name" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Adınızı girin">
                </div>
                
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Soyad *</label>
                    <input type="text" name="last_name" id="last_name" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Soyadınızı girin">
                </div>
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Kullanıcı Adı *</label>
                    <input type="text" name="username" id="username" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Benzersiz kullanıcı adı">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-posta *</label>
                    <input type="email" name="email" id="email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="ornek@email.com">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-arrow-right text-blue-500 group-hover:text-blue-400"></i>
                    </span>
                    İleri
                </button>
            </div>

            <div id="step1Error" class="hidden mt-3 text-sm text-red-600 bg-red-50 border border-red-200 rounded-md p-3"></div>
        </form>

        <!-- Step 2 Form -->
        <form id="step2Form" class="mt-8 space-y-6 hidden">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700">Doğum Tarihi *</label>
                    <input type="date" name="birth_date" id="birth_date" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Şifre *</label>
                    <input type="password" name="password" id="password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="En az 8 karakter">
                    <p class="mt-1 text-sm text-gray-500">Şifreniz en az 8 karakter olmalıdır.</p>
                </div>
            </div>

            <div class="flex space-x-3">
                <button type="button" id="backButton"
                        class="flex-1 py-3 px-4 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Geri
                </button>
                <button type="submit" 
                        class="flex-1 py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-user-plus mr-2"></i>
                    Kayıt Ol
                </button>
            </div>

            <div id="step2Error" class="hidden mt-3 text-sm text-red-600 bg-red-50 border border-red-200 rounded-md p-3"></div>
        </form>
    </div>
</div>

<script>
// Step 1 form submission
document.getElementById('step1Form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const errorDiv = document.getElementById('step1Error');
    
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Kontrol ediliyor...';
    errorDiv.classList.add('hidden');
    
    try {
        const response = await fetch('{{ route("register.step1") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // İkinci adıma geç
            document.getElementById('step1Form').classList.add('hidden');
            document.getElementById('step2Form').classList.remove('hidden');
            
            // Progress bar güncelle
            document.getElementById('progressBar').style.width = '100%';
            document.getElementById('step1Label').classList.remove('font-medium', 'text-blue-600');
            document.getElementById('step1Label').classList.add('text-green-600');
            document.getElementById('step2Label').classList.remove('text-gray-400');
            document.getElementById('step2Label').classList.add('font-medium', 'text-blue-600');
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
        submitButton.innerHTML = '<span class="absolute left-0 inset-y-0 flex items-center pl-3"><i class="fas fa-arrow-right text-blue-500 group-hover:text-blue-400"></i></span>İleri';
    }
});

// Step 2 form submission
document.getElementById('step2Form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const errorDiv = document.getElementById('step2Error');
    
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
        submitButton.innerHTML = '<i class="fas fa-user-plus mr-2"></i>Kayıt Ol';
    }
});

// Back button
document.getElementById('backButton').addEventListener('click', function() {
    document.getElementById('step2Form').classList.add('hidden');
    document.getElementById('step1Form').classList.remove('hidden');
    
    // Progress bar güncelle
    document.getElementById('progressBar').style.width = '50%';
    document.getElementById('step1Label').classList.add('font-medium', 'text-blue-600');
    document.getElementById('step1Label').classList.remove('text-green-600');
    document.getElementById('step2Label').classList.add('text-gray-400');
    document.getElementById('step2Label').classList.remove('font-medium', 'text-blue-600');
    
    // Hataları temizle
    document.getElementById('step2Error').classList.add('hidden');
});
</script>
@endsection