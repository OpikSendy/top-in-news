import './bootstrap';

// ===== LIVE SEARCH =====
const searchInput = document.getElementById('live-search-input');
const searchDropdown = document.getElementById('search-results-dropdown');
let searchTimeout = null;

if (searchInput && searchDropdown) {
    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        const q = this.value.trim();
        if (q.length < 2) {
            searchDropdown.classList.add('hidden');
            searchDropdown.innerHTML = '';
            return;
        }
        searchTimeout = setTimeout(() => {
            fetch(`/all-news?search=${encodeURIComponent(q)}&ajax=1`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                if (!data.results || data.results.length === 0) {
                    searchDropdown.innerHTML = `<div class="px-4 py-6 text-center text-gray-400 text-sm">Tidak ada hasil untuk "<strong class="text-white">${q}</strong>"</div>`;
                } else {
                    searchDropdown.innerHTML = data.results.map(item => `
                        <a href="${item.url}" class="flex gap-3 px-4 py-3 hover:bg-white/10 transition-colors border-b border-white/5 last:border-0">
                            <img src="${item.image}" class="w-12 h-10 rounded-lg object-cover shrink-0" loading="lazy">
                            <div>
                                <span class="text-[10px] font-bold text-red-400 uppercase tracking-wider block">${item.category}</span>
                                <span class="text-sm text-gray-200 font-medium line-clamp-1">${item.title}</span>
                                <span class="text-[11px] text-gray-500">${item.time}</span>
                            </div>
                        </a>
                    `).join('');
                }
                searchDropdown.classList.remove('hidden');
            })
            .catch(() => searchDropdown.classList.add('hidden'));
        }, 300);
    });

    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
            searchDropdown.classList.add('hidden');
        }
    });

    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && this.value.trim()) {
            window.location.href = `/all-news?search=${encodeURIComponent(this.value.trim())}`;
        }
    });
}

// ===== READING PROGRESS BAR =====
window.addEventListener('scroll', function () {
    const bar = document.getElementById('reading-progress');
    if (!bar) return;
    const docH = document.documentElement.scrollHeight - window.innerHeight;
    if (docH > 0) {
        const pct = (window.scrollY / docH) * 100;
        bar.style.width = pct + '%';
    }
});

// ===== SMOOTH FADE-IN ON SCROLL (Intersection Observer) =====
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.news-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(card);
});

// ===== CLOSE FLASH MESSAGE =====
const flash = document.getElementById('flash-msg');
if (flash) {
    setTimeout(() => {
        flash.style.opacity = '0';
        flash.style.transform = 'translateX(100%)';
        flash.style.transition = 'all 0.4s ease';
        setTimeout(() => flash.remove(), 400);
    }, 4000);
}
