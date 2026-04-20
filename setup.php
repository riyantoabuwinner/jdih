<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function saveSet($k, $v) {
  $s = \App\Models\Setting::where('key', $k)->first() ?? new \App\Models\Setting();
  $s->key = $k;
  $s->value = $v;
  $s->group = 'general';
  $s->save();
}

saveSet('logo', 'logos/logo-uin.png');
saveSet('favicon', 'logos/favicon-uin.png');
echo "Saved.\n";
