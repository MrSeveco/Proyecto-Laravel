<?php
// Cross-platform dev runner: includes Pail on non-Windows, skips on Windows

$commands = [
    'php artisan serve',
    'php artisan queue:listen --tries=1',
    'npm run dev',
];

$names = ['server', 'queue', 'vite'];
$colors = ['#93c5fd', '#c4b5fd', '#fdba74'];

if (stripos(PHP_OS_FAMILY, 'Windows') === false) {
    // Non-Windows: include Pail logs
    array_splice($commands, 2, 0, 'php artisan pail --timeout=0');
    array_splice($names, 2, 0, 'logs');
    array_splice($colors, 2, 0, '#fb7185');
}

$cmdParts = [];
foreach ($commands as $cmd) {
    // Quote each command for shell
    $cmdParts[] = '"' . $cmd . '"';
}
$namesArg = implode(',', $names);
$colorArg = implode(',', $colors);
$cmd = 'npx concurrently -c "' . $colorArg . '" ' . implode(' ', $cmdParts) . ' --names=' . $namesArg . ' --kill-others';

// Pass through stdout/stderr
$descriptorSpec = [
    0 => STDIN,
    1 => STDOUT,
    2 => STDERR,
];

$process = proc_open($cmd, $descriptorSpec, $pipes);
if (!is_resource($process)) {
    fwrite(STDERR, "Failed to start dev processes.\n");
    exit(1);
}

$status = proc_close($process);
exit($status);
