<?php
/**
 * Web Installer - Setup Laravel via browser (tanpa terminal)
 *
 * HAPUS file ini setelah instalasi selesai!
 * Akses: /installer.php?token=YOUR_SECRET_TOKEN
 */

// ─── KONFIGURASI ──────────────────────────────────────────────────────────────
const INSTALLER_TOKEN = 'base64:MmoTKw125jwKDJN2QZxyEXbjPLda4gbuOCDzxLIMrbU=';

// ─── KEAMANAN ─────────────────────────────────────────────────────────────────
if (!isset($_GET['token']) || $_GET['token'] !== INSTALLER_TOKEN) {
    http_response_code(403);
    exit('403 Forbidden.');
}

// ─── HELPER ───────────────────────────────────────────────────────────────────
$root   = dirname(__DIR__);
$php    = PHP_BINARY ?: 'php';
$token  = htmlspecialchars($_GET['token']);
$action = $_POST['action'] ?? null;
$result = null;

function run(string $cmd, string $cwd): array
{
    if (!function_exists('exec')) {
        return ['ok' => false, 'out' => 'Fungsi exec() tidak tersedia di server ini.'];
    }
    exec(sprintf('cd %s && %s 2>&1', escapeshellarg($cwd), $cmd), $lines, $code);
    return ['ok' => $code === 0, 'out' => implode("\n", $lines)];
}

function artisan(string $cmd, string $root, string $php): array
{
    return run("$php artisan $cmd", $root);
}

// ─── AKSI ─────────────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action) {
    $result = match ($action) {
        'composer'   => run('composer install --no-dev --optimize-autoloader', $root),
        'env'        => (function () use ($root) {
            if (file_exists("$root/.env")) {
                return ['ok' => true, 'out' => '.env sudah ada, dilewati.'];
            }
            if (!file_exists("$root/.env.example")) {
                return ['ok' => false, 'out' => '.env.example tidak ditemukan!'];
            }
            copy("$root/.env.example", "$root/.env");
            return ['ok' => true, 'out' => '.env berhasil dibuat dari .env.example.'];
        })(),
        'key'        => artisan('key:generate --force', $root, $php),
        'link'       => artisan('storage:link', $root, $php),
        'permission' => run('chmod -R 775 storage bootstrap/cache', $root),
        'migrate'    => artisan('migrate --force', $root, $php),
        'seed'       => artisan('db:seed --force', $root, $php),
        'optimize'   => artisan('optimize', $root, $php),
        default      => ['ok' => false, 'out' => 'Aksi tidak dikenal.'],
    };
}

// ─── STATUS ───────────────────────────────────────────────────────────────────
$vendorOk = is_dir("$root/vendor");
$envOk    = file_exists("$root/.env");
$keyOk    = false;
if ($envOk) {
    preg_match('/^APP_KEY=(.+)$/m', file_get_contents("$root/.env"), $m);
    $keyOk = !empty(trim($m[1] ?? ''));
}
$execOk = function_exists('exec');

$steps = [
    ['id' => 'composer',   'no' => 1,    'title' => 'Composer Install',        'desc' => 'Download semua dependency PHP. Jalankan pertama setelah clone.',                         'btn' => 'Jalankan', 'danger' => false],
    ['id' => 'env',        'no' => 2,    'title' => 'Buat File .env',           'desc' => 'Salin .env.example → .env. Setelah ini, edit .env di file manager hosting.',            'btn' => 'Buat .env', 'danger' => false],
    ['id' => 'key',        'no' => 3,    'title' => 'Generate APP_KEY',         'desc' => 'Buat kunci enkripsi aplikasi. Wajib sebelum app bisa diakses.',                         'btn' => 'Generate', 'danger' => false],
    ['id' => 'link',       'no' => 4,    'title' => 'Storage Link',             'desc' => 'Buat symlink public/storage agar file upload bisa diakses publik.',                     'btn' => 'Buat Link', 'danger' => false],
    ['id' => 'permission', 'no' => 5,    'title' => 'Set Permission',           'desc' => 'Set chmod 775 pada folder storage & bootstrap/cache.',                                  'btn' => 'Set', 'danger' => false],
    ['id' => 'migrate',    'no' => 6,    'title' => 'Migrate Database',         'desc' => 'Jalankan migration. Pastikan koneksi DB sudah diisi di .env terlebih dahulu.',          'btn' => 'Migrate', 'danger' => true],
    ['id' => 'seed',       'no' => '6b', 'title' => 'Seed Database (opsional)', 'desc' => 'Isi data awal via seeder. Jalankan setelah migrate jika diperlukan.',                   'btn' => 'Seed', 'danger' => true],
    ['id' => 'optimize',   'no' => 7,    'title' => 'Optimize',                 'desc' => 'Cache config, route & view untuk production. Jalankan terakhir setelah semua selesai.', 'btn' => 'Optimize', 'danger' => false],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel Installer</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Segoe UI', system-ui, sans-serif;
      background: #09090b;
      color: #e4e4e7;
      min-height: 100vh;
      padding: 2.5rem 1rem;
    }

    .wrap { max-width: 680px; margin: 0 auto; }

    /* Header */
    .header { margin-bottom: 2rem; }
    .header h1 { font-size: 1.5rem; font-weight: 700; color: #fafafa; letter-spacing: -0.02em; }
    .header p  { font-size: 0.875rem; color: #71717a; margin-top: 0.25rem; }

    /* Alert */
    .alert {
      display: flex; gap: 0.75rem; align-items: flex-start;
      background: #1c0a00; border: 1px solid #92400e;
      border-radius: 8px; padding: 0.875rem 1rem;
      font-size: 0.8rem; color: #fcd34d; margin-bottom: 2rem; line-height: 1.5;
    }
    .alert-icon { font-size: 1rem; flex-shrink: 0; margin-top: 0.05rem; }

    /* Status bar */
    .status-bar {
      display: flex; flex-wrap: wrap; gap: 0.5rem;
      margin-bottom: 2rem;
    }
    .chip {
      display: flex; align-items: center; gap: 0.4rem;
      background: #18181b; border: 1px solid #27272a;
      border-radius: 999px; padding: 0.3rem 0.75rem;
      font-size: 0.75rem; color: #a1a1aa;
    }
    .dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .dot-g { background: #22c55e; box-shadow: 0 0 5px #22c55e88; }
    .dot-r { background: #ef4444; box-shadow: 0 0 5px #ef444488; }
    .dot-y { background: #eab308; box-shadow: 0 0 5px #eab30888; }

    /* Card */
    .card {
      background: #18181b;
      border: 1px solid #27272a;
      border-radius: 10px;
      margin-bottom: 0.875rem;
      overflow: hidden;
    }
    .card-head {
      display: flex; align-items: center; gap: 0.875rem;
      padding: 0.875rem 1.125rem;
      border-bottom: 1px solid #27272a;
    }
    .step-badge {
      width: 26px; height: 26px; border-radius: 50%;
      background: #27272a; color: #a1a1aa;
      font-size: 0.7rem; font-weight: 700;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .card-title { font-size: 0.9rem; font-weight: 600; color: #fafafa; flex: 1; }
    .tag {
      font-size: 0.68rem; font-weight: 600; padding: 0.2rem 0.55rem;
      border-radius: 4px; text-transform: uppercase; letter-spacing: 0.04em;
    }
    .tag-ok  { background: #14532d; color: #4ade80; }
    .tag-err { background: #450a0a; color: #f87171; }

    .card-body { padding: 0.875rem 1.125rem; }
    .card-desc { font-size: 0.8rem; color: #71717a; margin-bottom: 0.875rem; line-height: 1.55; }

    /* Buttons */
    .btn {
      display: inline-flex; align-items: center; gap: 0.4rem;
      border: none; border-radius: 6px; cursor: pointer;
      font-size: 0.8rem; font-weight: 600; padding: 0.45rem 1rem;
      transition: opacity 0.15s, background 0.15s;
    }
    .btn:hover { opacity: 0.85; }
    .btn-primary { background: #3b82f6; color: #fff; }
    .btn-danger  { background: #dc2626; color: #fff; }

    /* Output */
    .output { margin-top: 0.875rem; border-radius: 6px; overflow: hidden; }
    .output-label {
      padding: 0.35rem 0.75rem;
      font-size: 0.68rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 0.06em;
    }
    .output-ok  .output-label { background: #14532d; color: #4ade80; }
    .output-err .output-label { background: #450a0a; color: #f87171; }
    pre {
      background: #09090b; color: #a1a1aa;
      padding: 0.75rem 0.9rem;
      font-size: 0.76rem; line-height: 1.65;
      white-space: pre-wrap; word-break: break-all;
      max-height: 260px; overflow-y: auto;
      border: 1px solid #27272a; border-top: none;
    }
  </style>
</head>
<body>
<div class="wrap">

  <div class="header">
    <h1>Laravel Installer</h1>
    <p>Setup aplikasi via browser &mdash; tidak perlu akses terminal</p>
  </div>

  <div class="alert">
    <span class="alert-icon">&#9888;</span>
    <span><strong>Peringatan:</strong> Hapus file <code>public/installer.php</code> dari server setelah instalasi selesai. File ini memberikan akses eksekusi perintah di server Anda.</span>
  </div>

  <!-- Status -->
  <div class="status-bar">
    <div class="chip"><span class="dot <?= $vendorOk ? 'dot-g' : 'dot-r' ?>"></span> vendor/</div>
    <div class="chip"><span class="dot <?= $envOk    ? 'dot-g' : 'dot-r' ?>"></span> .env</div>
    <div class="chip"><span class="dot <?= $keyOk    ? 'dot-g' : 'dot-r' ?>"></span> APP_KEY</div>
    <div class="chip"><span class="dot <?= $execOk   ? 'dot-g' : 'dot-y' ?>"></span> exec()</div>
    <div class="chip"><span class="dot dot-g"></span> PHP <?= PHP_VERSION ?></div>
  </div>

  <?php if (!$execOk): ?>
  <div class="alert" style="margin-bottom:1.5rem;">
    <span class="alert-icon">&#128683;</span>
    <span>Fungsi <code>exec()</code> dinonaktifkan di server ini. Hubungi provider hosting untuk mengaktifkannya, atau jalankan perintah secara manual.</span>
  </div>
  <?php endif; ?>

  <!-- Steps -->
  <?php foreach ($steps as $step):
    $active = ($action === $step['id']);
  ?>
  <div class="card">
    <div class="card-head">
      <div class="step-badge"><?= $step['no'] ?></div>
      <span class="card-title"><?= $step['title'] ?></span>
      <?php if ($active && $result): ?>
        <span class="tag <?= $result['ok'] ? 'tag-ok' : 'tag-err' ?>">
          <?= $result['ok'] ? 'Berhasil' : 'Gagal' ?>
        </span>
      <?php endif; ?>
    </div>
    <div class="card-body">
      <p class="card-desc"><?= $step['desc'] ?></p>
      <form method="POST" action="?token=<?= $token ?>">
        <input type="hidden" name="action" value="<?= $step['id'] ?>">
        <button type="submit" class="btn <?= $step['danger'] ? 'btn-danger' : 'btn-primary' ?>">
          <?= $step['btn'] ?>
        </button>
      </form>
      <?php if ($active && $result): ?>
        <div class="output <?= $result['ok'] ? 'output-ok' : 'output-err' ?>">
          <div class="output-label"><?= $result['ok'] ? 'Output' : 'Error' ?></div>
          <pre><?= htmlspecialchars($result['out']) ?></pre>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endforeach; ?>

</div>
</body>
</html>
