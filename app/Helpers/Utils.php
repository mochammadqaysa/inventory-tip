<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Utils
{

    public static function rupiah($nominal, $decimals = 2)
    {
        return 'Rp ' . number_format((float) $nominal, $decimals, ',', '.');
    }

    public static function decimal($nominal = 0, $decimals = 2)
    {
        $parse = number_format((float) $nominal, $decimals, ',', '.');
        $expParse = explode(',', $parse);
        $decimal = end($expParse);
        $nominal = array_shift($expParse);
        return $nominal . '<small>' . ",$decimal" . '</small>';
    }

    public static function formatSlug($string)
    {
        $string = preg_replace('/[ -]+/', '_', $string);
        $string = preg_replace('/([a-z])([A-Z])/', '$1_$2', $string);
        return strtolower($string);
    }

    public static function sum($items = [], $operator = '+')
    {
        if (empty($items)) {
            return 0;
        }

        if (count($items) === 1) {
            return $items[0];
        }

        // Join the items with the specified operator
        $expression = implode(" $operator ", $items);

        // Use Laravel's DB::raw to sum the expression
        $result = DB::select(DB::raw("SELECT SUM($expression) AS sum"))[0]->sum;

        return is_numeric($result) ? (float) $result : $result;
    }

    public static function totalMasukSampai($id, $tanggal, $table, $column = 'jumlah', $operator = '<=')
    {
        return DB::table($table . '_masuk_item')
            ->join($table . '_masuk', $table . '_masuk_item.' . $table . '_masuk_uid', '=', $table . '_masuk.uid')
            ->where($table . '_masuk_item.' . $table . '_uid', $id)
            ->where($table . '_masuk.tanggal_bukti', $operator, $tanggal)
            ->sum($column);
    }

    public static function totalKeluarSampai($id, $tanggal, $table, $column = 'jumlah', $operator = '<=')
    {
        return DB::table($table . '_keluar_item')
            ->join($table . '_keluar', $table . '_keluar_item.bahan_keluar_uid', '=', $table . '_keluar.uid')
            ->where($table . '_keluar_item.' . $table . '_uid', $id)
            ->where($table . '_keluar.tanggal_bukti', $operator, $tanggal)
            ->where($table . '_keluar.transaksi', 'keluar')
            ->sum($column);
    }

    public static function totalReturSampai($id, $tanggal, $table, $column = 'jumlah', $operator = '<=')
    {
        return DB::table($table . '_keluar_item')
            ->join($table . '_keluar', $table . '_keluar_item.bahan_keluar_uid', '=', $table . '_keluar.uid')
            ->where($table . '_keluar_item.' . $table . '_uid', $id)
            ->where($table . '_keluar.tanggal_bukti', $operator, $tanggal)
            ->where($table . '_keluar.transaksi', 'retur')
            ->sum($column);
    }

    public static function saldoAkhir($bahan, $tipe)
    {
        try {
            if ($tipe == "bahan") {
                $now = now()->toDateString(); // Get the current date in SQL format
                $bahanId = $bahan->uid;

                // Retrieve total 'masuk', 'keluar', and 'retur' values
                $masuk = Utils::totalMasukSampai($bahanId, $now, 'bahan');
                $keluar = Utils::totalKeluarSampai($bahanId, $now, 'bahan');
                $retur = Utils::totalReturSampai($bahanId, $now, 'bahan');

                // Calculate the total: (masuk + retur) - keluar
                $total = ($masuk + $retur) - $keluar;

                return $total;
            } else if ($tipe == "barang") {
                $now = now()->toDateString(); // Get the current date in SQL format
                $bahanId = $bahan->uid;

                // Retrieve total 'masuk', 'keluar', and 'retur' values
                $masuk = Utils::totalMasukSampai($bahanId, $now, 'barang');
                $keluar = Utils::totalKeluarSampai($bahanId, $now, 'barang');
                $retur = Utils::totalReturSampai($bahanId, $now, 'barang');

                // Calculate the total: (masuk + retur) - keluar
                $total = ($masuk + $retur) - $keluar;

                return $total;
            } else {
                $now = now()->toDateString(); // Get the current date in SQL format
                $bahanId = $bahan->uid;

                // Retrieve total 'masuk', 'keluar', and 'retur' values
                $masuk = Utils::totalMasukSampai($bahanId, $now, 'waste');
                $keluar = Utils::totalKeluarSampai($bahanId, $now, 'waste');
                $retur = Utils::totalReturSampai($bahanId, $now, 'waste');

                // Calculate the total: (masuk + retur) - keluar
                $total = ($masuk + $retur) - $keluar;

                return $total;
            }
        } catch (\Throwable $th) {
            // throw $th;
            return 0;
        }
    }
}
