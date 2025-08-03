import './bootstrap';
import Alpine from 'alpinejs';

// Alpine.js'i global olarak erişilebilir yap
window.Alpine = Alpine;

// Hızlı Sayfa Geçişi Sistemi (SEO Güvenli)
window.pageNavigation = () => ({
    currentUrl: window.location.pathname,
    
    navigateToPage(event, url) {
        event.preventDefault();
        
        // Eğer aynı sayfadaysak, hiçbir şey yapma
        if (this.currentUrl === url) return;
        
        // Loading göster
        window.dispatchEvent(new CustomEvent('show-loading'));
        
        // AJAX ile sayfa içeriğini yükle
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => response.text())
        .then(html => {
            // Sayfa içeriğini güncelle
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.querySelector('main').innerHTML;
            
            // İçeriği değiştir
            document.querySelector('main').innerHTML = newContent;
            
            // Yeni içeriğin içindeki <script> taglerini çalıştır
            doc.querySelectorAll('script').forEach((oldScript) => {
                const newScript = document.createElement('script');
                // Tüm attribute'ları kopyala (src, type vs.)
                Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                // Inline script içeriğini kopyala
                newScript.textContent = oldScript.textContent;
                document.body.appendChild(newScript);
            });
            
            // URL'yi güncelle
            history.pushState({}, '', url);
            this.currentUrl = url;
            
            // Loading gizle
            window.dispatchEvent(new CustomEvent('hide-loading'));
            
            // Sayfa yüklendiğini bildir
            window.dispatchEvent(new CustomEvent('page-loaded', {
                detail: { url: url }
            }));
            
            // Scroll'u en üste al
            window.scrollTo(0, 0);
        })
        .catch(error => {
            console.error('Sayfa yüklenirken hata:', error);
            // Hata durumunda normal yönlendirme yap
            window.location.href = url;
        });
    },
    
    updateActiveLink(url) {
        this.currentUrl = url;
    }
});

window.pageLoader = () => ({
    loading: false,
    
    init() {
        // Loading event'lerini dinle
        window.addEventListener('show-loading', () => {
            this.loading = true;
        });
        
        window.addEventListener('hide-loading', () => {
            this.loading = false;
        });
    }
});

// Dark Mode Sistemi
window.darkMode = () => ({
    isDark: false,
    
    init() {
        // LocalStorage'dan dark mode durumunu al
        const darkMode = localStorage.getItem('darkMode');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        // Dark mode durumunu belirle
        this.isDark = darkMode === 'true' || (darkMode === null && prefersDark);
        
        // İlk yüklemede dark class'ını uygula
        this.updateDarkClass();
        
        // isDark değişkenini izle ve değiştiğinde DOM'u güncelle
        this.$watch('isDark', (value) => {
            this.updateDarkClass();
            localStorage.setItem('darkMode', value.toString());
        });
    },
    
    updateDarkClass() {
        if (this.isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    },
    
    toggle() {
        this.isDark = !this.isDark;
    }
});

// Alpine.js'i başlat
Alpine.start();