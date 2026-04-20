<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$settings = [
    'app_name' => 'JDIH UIN Siber',
    'app_tagline' => 'Syekh Nurjati Cirebon',
    'footer_description' => 'Portal resmi Jaringan Dokumentasi dan Informasi Hukum UIN Siber Syekh Nurjati Cirebon. Menyajikan pusaka dokumen legal, produk hukum, dan regulasi kampus secara tertib, transparan, dan terintegrasi secara siber.',
    'contact_email' => 'info@syekhnurjati.ac.id',
    'contact_phone' => '(0231) 481264',
    'contact_address' => "Gedung Pusat Administrasi Biro (Rektorat)\nUIN Siber Syekh Nurjati Cirebon\nJl. Perjuangan By Pass Sunyaragi, Kesambi,\nKota Cirebon, Jawa Barat 45131",
];

foreach ($settings as $key => $value) {
    Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
}

echo "Settings synced successfully.\n";
