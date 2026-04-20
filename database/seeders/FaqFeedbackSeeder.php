<?php

namespace Database\Seeders;

use App\Models\FAQ;
use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FaqFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed FAQs
        $faqs = [
            [
                'question' => 'Apa itu JDIH?',
                'answer' => 'JDIH (Jaringan Dokumentasi dan Informasi Hukum) adalah wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan.',
                'order' => 1,
                'is_published' => true,
            ],
            [
                'question' => 'Bagaimana cara mencari dokumen hukum?',
                'answer' => 'Anda dapat menggunakan fitur pencarian di halaman utama dengan memasukkan kata kunci, nomor dokumen, atau tahun.',
                'order' => 2,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah dokumen hukum dapat diunduh?',
                'answer' => 'Ya, sebagian besar dokumen hukum yang tersedia di JDIH dapat diunduh dalam format PDF secara gratis.',
                'order' => 3,
                'is_published' => true,
            ],
            [
                'question' => 'Bagaimana jika saya tidak menemukan dokumen yang dicari?',
                'answer' => 'Anda dapat menghubungi admin melalui fitur feedback atau menu kontak yang tersedia untuk menanyakan ketersediaan dokumen tersebut.',
                'order' => 4,
                'is_published' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }

        // Seed Feedbacks
        $feedbacks = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'rating' => 5,
                'comment' => 'Website sangat membantu dan mudah digunakan. Koleksi dokumennya cukup lengkap.',
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@example.com',
                'rating' => 4,
                'comment' => 'Tampilan sudah bagus, kalau bisa ditambah fitur filter tahun yang lebih detail.',
            ],
            [
                'name' => 'Andi Wijaya',
                'email' => 'andi.w@example.com',
                'rating' => 5,
                'comment' => 'Sangat responsif! Terima kasih JDIH.',
            ],
        ];

        foreach ($feedbacks as $feedback) {
            Feedback::create($feedback);
        }
    }
}
