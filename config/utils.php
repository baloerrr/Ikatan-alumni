<?php


$pushedContents = [
    'css' => [],
    'js' => [],
];

if (!function_exists('push')) {
    function push($section, $content)
    {
        global $pushedContents;

        // Validasi parameter
        if (!is_string($section)) {
            throw new InvalidArgumentException('Parameter $section harus berupa string.');
        }

        // Tambahkan validasi lain sesuai kebutuhan

        if (!isset($pushedContents[$section])) {
            $pushedContents[$section] = [];
        }

        $pushedContents[$section][] = $content;
    }
}

if (!function_exists('stack')) {
    function stack($section)
    {
        global $pushedContents;

        // Validasi parameter
        if (!is_string($section)) {
            throw new InvalidArgumentException('Parameter $section harus berupa string.');
        }

        if (isset($pushedContents[$section]) && is_array($pushedContents[$section])) {
            return implode("\n", $pushedContents[$section]);
        }

        return '';
    }
}

if (!function_exists('formatWaktu')) {
    function formatWaktu($timestamp)
    {
        $selisihDetik = time() - $timestamp;

        // Hitung selisih waktu dalam satuan detik, menit, dan jam
        $selisihJam = floor($selisihDetik / 3600);
        $selisihMenit = floor(($selisihDetik % 3600) / 60);
        $selisihDetik = $selisihDetik % 60;

        if ($selisihJam > 0) {
            return $selisihJam . ' jam yang lalu';
        } elseif ($selisihMenit > 0) {
            return $selisihMenit . ' menit yang lalu';
        } else {
            return $selisihDetik . ' detik yang lalu';
        }
    }
}
