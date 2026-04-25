<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Comment;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Technology', 'Business', 'Lifestyle', 'Sports', 'Health', 'Politics', 'Entertainment', 'Science'];

        $articles = [
            // Technology
            ['title' => 'Apple Luncurkan iPhone 17 dengan Chip A19 Bionic, Performa 40% Lebih Cepat', 'category' => 'Technology', 'is_trending' => true, 'is_live' => false, 'views' => 12450],
            ['title' => 'Google DeepMind Rilis AI Model Terbaru yang Bisa Memahami Video Real-time', 'category' => 'Technology', 'is_trending' => true, 'is_live' => true, 'views' => 9800],
            ['title' => 'Microsoft Akuisisi Startup AI Indonesia Senilai 500 Juta Dolar', 'category' => 'Technology', 'is_trending' => false, 'is_live' => false, 'views' => 7200],
            ['title' => 'Meta Quest 4 Hadir dengan Fitur Mixed Reality yang Mengubah Cara Kerja Tim Remote', 'category' => 'Technology', 'is_trending' => false, 'is_live' => false, 'views' => 5100],
            ['title' => 'Indonesia Masuk 10 Besar Negara dengan Pertumbuhan Startup Tercepat di Asia', 'category' => 'Technology', 'is_trending' => true, 'is_live' => false, 'views' => 8300],

            // Business
            ['title' => 'IHSG Tembus 8.000, Analis Prediksi Bull Run Akhir Tahun yang Kuat', 'category' => 'Business', 'is_trending' => true, 'is_live' => true, 'views' => 15200],
            ['title' => 'Bank Indonesia Tahan Suku Bunga di Level 5.75%, Rupiah Menguat ke 15.400', 'category' => 'Business', 'is_trending' => false, 'is_live' => false, 'views' => 6800],
            ['title' => 'Gojek dan Tokopedia Merger: GoTo Siap IPO di Bursa New York Tahun Ini', 'category' => 'Business', 'is_trending' => true, 'is_live' => false, 'views' => 11300],
            ['title' => 'Harga Minyak Dunia Naik 3% Setelah OPEC+ Umumkan Pemangkasan Produksi', 'category' => 'Business', 'is_trending' => false, 'is_live' => false, 'views' => 4500],
            ['title' => 'Investasi Asing di Indonesia Capai Rekor 1.200 Triliun Rupiah di Kuartal Pertama', 'category' => 'Business', 'is_trending' => false, 'is_live' => false, 'views' => 3900],

            // Sports
            ['title' => 'Timnas Indonesia Lolos ke Piala Dunia 2026! Garuda Taklukkan Australia 2-1', 'category' => 'Sports', 'is_trending' => true, 'is_live' => true, 'views' => 48000],
            ['title' => 'Real Madrid Juara Liga Champions, Mbappe Cetak Hat-trick di Final', 'category' => 'Sports', 'is_trending' => true, 'is_live' => false, 'views' => 32000],
            ['title' => 'BRI Liga 1: Persib Bandung Kembali Puncak Klasemen Setelah Hajar Persija 3-0', 'category' => 'Sports', 'is_trending' => false, 'is_live' => false, 'views' => 9800],
            ['title' => 'Kevin Sanjaya dan Marcus Fernaldi Raih Emas di BWF World Championships', 'category' => 'Sports', 'is_trending' => true, 'is_live' => false, 'views' => 14500],
            ['title' => 'MotoGP Mandalika 2026 Dibuka, Tiket Ludes dalam 6 Jam', 'category' => 'Sports', 'is_trending' => false, 'is_live' => false, 'views' => 7200],

            // Health
            ['title' => 'WHO Keluarkan Panduan Baru: 8.000 Langkah Per Hari Sudah Cukup untuk Kesehatan Optimal', 'category' => 'Health', 'is_trending' => true, 'is_live' => false, 'views' => 18700],
            ['title' => 'Vaksin HIV Fase 3 Berhasil: Efektivitas 89% pada Uji Klinis Global', 'category' => 'Health', 'is_trending' => true, 'is_live' => false, 'views' => 22400],
            ['title' => 'Studi Harvard: Tidur 7 Jam Lebih Efektif dari Suplemen Mahal untuk Imunitas', 'category' => 'Health', 'is_trending' => false, 'is_live' => false, 'views' => 8900],
            ['title' => 'BPJS Kesehatan Kini Cover Operasi Bariatric untuk Penderita Obesitas Ekstrem', 'category' => 'Health', 'is_trending' => false, 'is_live' => false, 'views' => 5600],

            // Lifestyle
            ['title' => '10 Destinasi Wisata Tersembunyi di Nusa Tenggara yang Wajib Dikunjungi 2026', 'category' => 'Lifestyle', 'is_trending' => true, 'is_live' => false, 'views' => 11200],
            ['title' => 'Tren "Slow Living" Menyebar di Kalangan Gen Z: Bosan dengan Hustle Culture', 'category' => 'Lifestyle', 'is_trending' => false, 'is_live' => false, 'views' => 6700],
            ['title' => 'Resep Viral: Nasi Goreng Truffle ala Chef Renatta yang Bisa Dibuat di Rumah', 'category' => 'Lifestyle', 'is_trending' => false, 'is_live' => false, 'views' => 9300],
            ['title' => 'Batik Kontemporer Indonesia Pukau Paris Fashion Week, Desainer Lokal Mendunia', 'category' => 'Lifestyle', 'is_trending' => true, 'is_live' => false, 'views' => 7800],

            // Politics
            ['title' => 'Presiden Prabowo Resmikan Ibu Kota Nusantara sebagai Pusat Pemerintahan Penuh', 'category' => 'Politics', 'is_trending' => true, 'is_live' => true, 'views' => 34500],
            ['title' => 'DPR Sahkan RUU Perlindungan Data Pribadi yang Lama Ditunggu', 'category' => 'Politics', 'is_trending' => false, 'is_live' => false, 'views' => 8200],
            ['title' => 'ASEAN Summit 2026 di Jakarta: 10 Poin Kesepakatan Penting yang Ditandatangani', 'category' => 'Politics', 'is_trending' => false, 'is_live' => false, 'views' => 5400],

            // Entertainment
            ['title' => 'Film "Gundala 2" Pecahkan Rekor Box Office Indonesia, Raup 200 Miliar di Pekan Pertama', 'category' => 'Entertainment', 'is_trending' => true, 'is_live' => false, 'views' => 19800],
            ['title' => 'BLACKPINK Umumkan World Tour 2026, Jakarta Jadi Salah Satu Kota yang Disambangi', 'category' => 'Entertainment', 'is_trending' => true, 'is_live' => false, 'views' => 41000],
            ['title' => 'Joyland Festival 2026: Lineup Lengkap Diumumkan, 80 Artis dari 20 Negara', 'category' => 'Entertainment', 'is_trending' => false, 'is_live' => false, 'views' => 8700],

            // Science
            ['title' => 'NASA Konfirmasi: Teleskop James Webb Temukan Tanda-tanda Kehidupan di Planet K2-18b', 'category' => 'Science', 'is_trending' => true, 'is_live' => false, 'views' => 55000],
            ['title' => 'BRIN Indonesia Berhasil Kembangkan Baterai Natrium yang Lebih Murah dari Lithium', 'category' => 'Science', 'is_trending' => true, 'is_live' => false, 'views' => 12300],
            ['title' => 'Ilmuwan Berhasil Cetak Organ Jantung 3D Pertama yang Berfungsi Penuh', 'category' => 'Science', 'is_trending' => false, 'is_live' => false, 'views' => 29000],
        ];

        $descriptions = [
            'Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.',
            'Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.',
            'Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.',
            'Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.',
            'Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.',
        ];

        foreach ($articles as $i => $article) {
            $desc = $descriptions[$i % count($descriptions)];
            $content = "<p>{$desc}</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>";

            News::create([
                'title'       => $article['title'],
                'slug'        => \Illuminate\Support\Str::slug($article['title']) . '-' . ($i + 1),
                'description' => $desc,
                'content'     => $content,
                'image'       => 'https://picsum.photos/800/500?random=' . ($i + 10),
                'category'    => $article['category'],
                'type'        => 'news',
                'is_live'     => $article['is_live'],
                'is_trending' => $article['is_trending'],
                'views'       => $article['views'],
                'status'      => 'published',
                'user_id'     => null,
            ]);
        }

        // Seed some comments
        $newsIds = News::pluck('id')->take(5);
        $names = ['Budi Santoso', 'Ani Rahayu', 'Dian Kusuma', 'Rizky Pratama', 'Siti Nurhaliza'];
        $comments = [
            'Berita yang sangat informatif! Terima kasih Top In News.',
            'Wah, mengejutkan sekali! Tidak menyangka bisa secepat ini.',
            'Sumber berita terpercaya. Terus berkarya Top In News!',
            'Informasi yang sangat berguna. Langsung saya share ke grup.',
            'Mantap beritanya, semoga terus update ya kak!',
        ];

        foreach ($newsIds as $i => $newsId) {
            Comment::create([
                'news_id' => $newsId,
                'name'    => $names[$i % count($names)],
                'comment' => $comments[$i % count($comments)],
            ]);
        }

        $this->command->info('✅ ' . count($articles) . ' berita dan komentar berhasil di-seed!');
    }
}
