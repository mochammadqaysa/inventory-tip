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

    public static function totalBahanMasukSampai($id, $tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('bahan_masuk_item')
            ->join('bahan_masuk', 'bahan_masuk_item.' . 'bahan_masuk_uid', '=', 'bahan_masuk.uid')
            ->where('bahan_masuk_item.' . 'bahan_uid', $id)
            ->where('bahan_masuk.tanggal_bukti', $operator, $tanggal)
            ->sum($column);
    }

    public static function totalBahanKeluarSampai($id, $tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('bahan_keluar_item')
            ->join('bahan_keluar', 'bahan_keluar_item.bahan_keluar_uid', '=', 'bahan_keluar.uid')
            ->where('bahan_keluar_item.' . 'bahan_uid', $id)
            ->where('bahan_keluar.tanggal_bukti', $operator, $tanggal)
            ->where('bahan_keluar.transaksi', 'keluar')
            ->sum($column);
    }

    public static function totalBahanReturSampai($id, $tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('bahan_keluar_item')
            ->join('bahan_keluar', 'bahan_keluar_item.bahan_keluar_uid', '=', 'bahan_keluar.uid')
            ->where('bahan_keluar_item.bahan_uid', $id)
            ->where('bahan_keluar.tanggal_bukti', $operator, $tanggal)
            ->where('bahan_keluar.transaksi', 'retur')
            ->sum($column);
    }

    public static function totalBarangMasukSampai($id, $tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('barang_masuk_item')
            ->join('barang_masuk', 'barang_masuk_item.barang_masuk_uid', '=', 'barang_masuk.uid')
            ->where('barang_masuk_item.barang_uid', $id)
            ->where('barang_masuk.tanggal_bukti', $operator, $tanggal)
            ->sum($column);
    }

    public static function totalBarangKeluarSampai($id, $tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('barang_keluar_item')
            ->join('barang_keluar', 'barang_keluar_item.barang_keluar_uid', '=', 'barang_keluar.uid')
            ->where('barang_keluar_item.barang_uid', $id)
            ->where('barang_keluar.tanggal_bukti', $operator, $tanggal)
            ->sum($column);
    }

    public static function saldoAkhir($bahan, $tipe)
    {
        try {
            if ($tipe == "bahan") {
                $now = now()->toDateString(); // Get the current date in SQL format
                $bahanId = $bahan->uid;

                // Retrieve total 'masuk', 'keluar', and 'retur' values
                $masuk = Utils::totalBahanMasukSampai($bahanId, $now);
                $keluar = Utils::totalBahanKeluarSampai($bahanId, $now);
                $retur = Utils::totalBahanReturSampai($bahanId, $now);

                // Calculate the total: (masuk + retur) - keluar
                $total = ($masuk + $retur) - $keluar;

                return $total;
            } else if ($tipe == "barang") {
                $now = now()->toDateString(); // Get the current date in SQL format
                $bahanId = $bahan->uid;

                // Retrieve total 'masuk', 'keluar', and 'retur' values
                // DB::enableQueryLog();
                $masuk = Utils::totalBarangMasukSampai($bahanId, $now);
                // $query = DB::getQueryLog();
                // dd($query);
                $keluar = Utils::totalBarangKeluarSampai($bahanId, $now);

                // Calculate the total: (masuk + retur) - keluar
                $total = $masuk - $keluar;

                return $total;
            } else {
                $now = now()->toDateString(); // Get the current date in SQL format
                $bahanId = $bahan->uid;

                // Retrieve total 'masuk', 'keluar', and 'retur' values
                // $masuk = Utils::totalMasukSampai($bahanId, $now, 'waste');
                // $keluar = Utils::totalKeluarSampai($bahanId, $now, 'waste');
                // $retur = Utils::totalReturSampai($bahanId, $now, 'waste');

                // // Calculate the total: (masuk + retur) - keluar
                // $total = ($masuk + $retur) - $keluar;

                // return $total;
            }
        } catch (\Throwable $th) {
            throw $th;
            return 0;
        }
    }
}
