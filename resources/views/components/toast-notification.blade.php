<!-- Toast Notification Component -->
<div id="toast-notification" class="fixed top-4 right-4 z-50 transform translate-x-full opacity-0 transition-all duration-500 ease-in-out pointer-events-none">
    <div id="toast-content" class="px-6 py-4 rounded-lg shadow-lg max-w-sm min-w-80">
        <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
                <div id="toast-icon-container" class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i id="toast-icon" class="text-white"></i>
                </div>
            </div>
            <div class="flex-1">
                <h4 id="toast-title" class="font-semibold text-sm text-white"></h4>
                <p id="toast-message" class="text-sm opacity-90 text-white"></p>
            </div>
            <button onclick="hideToast()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<script>
// Toast Notification System
function showToast(title, message, type = 'success', duration = 4000) {
    const toast = document.getElementById('toast-notification');
    const toastContent = document.getElementById('toast-content');
    const toastIcon = document.getElementById('toast-icon');
    const toastTitle = document.getElementById('toast-title');
    const toastMessage = document.getElementById('toast-message');
    
    if (!toast || !toastContent || !toastIcon || !toastTitle || !toastMessage) {
        console.error('Toast elements not found');
        return;
    }
    
    // Set content
    toastTitle.textContent = title;
    toastMessage.textContent = message;
    
    // Set style based on type
    switch(type) {
        case 'success':
            toastContent.className = 'bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm min-w-80';
            toastIcon.className = 'fas fa-check text-white';
            break;
        case 'error':
            toastContent.className = 'bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm min-w-80';
            toastIcon.className = 'fas fa-times text-white';
            break;
        case 'warning':
            toastContent.className = 'bg-gradient-to-r from-yellow-500 to-orange-600 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm min-w-80';
            toastIcon.className = 'fas fa-exclamation-triangle text-white';
            break;
        case 'info':
            toastContent.className = 'bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm min-w-80';
            toastIcon.className = 'fas fa-info-circle text-white';
            break;
        case 'loading':
            toastContent.className = 'bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm min-w-80';
            toastIcon.className = 'fas fa-spinner fa-spin text-white';
            break;
        default:
            toastContent.className = 'bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm min-w-80';
            toastIcon.className = 'fas fa-info-circle text-white';
    }
    
    // Show toast with smooth animation
    toast.classList.remove('translate-x-full', 'opacity-0', 'pointer-events-none');
    toast.classList.add('translate-x-0', 'opacity-100', 'pointer-events-auto');
    
    // Auto hide after specified duration (unless it's a loading toast)
    if (type !== 'loading' && duration > 0) {
        setTimeout(() => {
            hideToast();
        }, duration);
    }
}

function hideToast() {
    const toast = document.getElementById('toast-notification');
    if (toast) {
        toast.classList.remove('translate-x-0', 'opacity-100', 'pointer-events-auto');
        toast.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
    }
}

// Convenience functions for different types
function showSuccessToast(title, message, duration = 4000) {
    showToast(title, message, 'success', duration);
}

function showErrorToast(title, message, duration = 5000) {
    showToast(title, message, 'error', duration);
}

function showWarningToast(title, message, duration = 4000) {
    showToast(title, message, 'warning', duration);
}

function showInfoToast(title, message, duration = 4000) {
    showToast(title, message, 'info', duration);
}

function showLoadingToast(title, message) {
    showToast(title, message, 'loading', 0); // 0 duration means it won't auto-hide
}

// Education specific toast functions
function showEducationSuccess(action) {
    const messages = {
        'added': { title: 'Başarılı!', message: 'Eğitim bilgisi başarıyla eklendi.' },
        'updated': { title: 'Güncellendi!', message: 'Eğitim bilgisi başarıyla güncellendi.' },
        'deleted': { title: 'Silindi!', message: 'Eğitim bilgisi başarıyla silindi.' },
        'sorted': { title: 'Sıralandı!', message: 'Eğitim sıralaması başarıyla kaydedildi.' }
    };
    
    const msg = messages[action] || { title: 'Başarılı!', message: 'İşlem başarıyla tamamlandı.' };
    showSuccessToast(msg.title, msg.message);
}

function showEducationError(action, errorMessage = null) {
    const messages = {
        'add': { title: 'Ekleme Hatası!', message: errorMessage || 'Eğitim bilgisi eklenirken bir hata oluştu.' },
        'update': { title: 'Güncelleme Hatası!', message: errorMessage || 'Eğitim bilgisi güncellenirken bir hata oluştu.' },
        'delete': { title: 'Silme Hatası!', message: errorMessage || 'Eğitim bilgisi silinirken bir hata oluştu.' },
        'sort': { title: 'Sıralama Hatası!', message: errorMessage || 'Eğitim sıralaması kaydedilirken bir hata oluştu.' },
        'load': { title: 'Yükleme Hatası!', message: errorMessage || 'Eğitim bilgisi yüklenirken bir hata oluştu.' }
    };
    
    const msg = messages[action] || { title: 'Hata!', message: errorMessage || 'Bir hata oluştu.' };
    showErrorToast(msg.title, msg.message);
}

function showEducationLoading(action) {
    const messages = {
        'adding': { title: 'Ekleniyor...', message: 'Eğitim bilgisi ekleniyor, lütfen bekleyin.' },
        'updating': { title: 'Güncelleniyor...', message: 'Eğitim bilgisi güncelleniyor, lütfen bekleyin.' },
        'deleting': { title: 'Siliniyor...', message: 'Eğitim bilgisi siliniyor, lütfen bekleyin.' },
        'sorting': { title: 'Sıralanıyor...', message: 'Eğitim sıralaması kaydediliyor, lütfen bekleyin.' },
        'loading': { title: 'Yükleniyor...', message: 'Eğitim bilgisi yükleniyor, lütfen bekleyin.' }
    };
    
    const msg = messages[action] || { title: 'İşleniyor...', message: 'İşlem devam ediyor, lütfen bekleyin.' };
    showLoadingToast(msg.title, msg.message);
}
</script>