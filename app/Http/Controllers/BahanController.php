<?php

namespace App\Http\Controllers;

use App\DataTables\BahanDataTable;
use App\Helpers\AuthCommon;
use App\Models\Bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BahanDataTable $dataTable)
    {

        return $dataTable->render('pages.master_data.bahan.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // dd(count($bahan));
        // $insert = [];
        $data = '[
            {
                "bahan_id" : "02b2a47e-41e7-417f-924e-497a5f6f25cc",
                "created_at" : "2023-02-16 02:53:21",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 02:18:30",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "HD01 (SPL)",
                "nama_bahan" : "PMMA ACRYPLUS WANHUA HD01",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "0460e674-e61a-4922-9df7-fcae80a60908",
                "created_at" : "2024-07-22 09:07:57",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : null,
                "updated_by" : null,
                "kode" : "PEPT925CCLEAR",
                "nama_bahan" : "PE Protection Tape 1240 HIS-925C Clear 0.05mm (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "065484b9-20a7-4e1e-a238-8f1fbd021929",
                "created_at" : "2023-02-16 06:58:02",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:58:06",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "UVP501300",
                "nama_bahan" : "UV, PET 50my,HSL\/1300 (SAMPLE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "0d7813b0-2e30-497b-bbbf-a11599a0768e",
                "created_at" : "2023-02-16 06:41:16",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:58:53",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "UVLP5021220",
                "nama_bahan" : "UV-L, PET 50 Mic2 , AL-Met, Pr, HSL\/1220 (SAMPLE )",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "0e498ee7-780a-4954-a798-fd903e148158",
                "created_at" : "2024-06-19 04:37:59",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:58:22",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF375CLR1900K",
                "nama_bahan" : "Masking Film GH-X-375 Clear 1900X0.06mm (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "11ca95ad-b6d8-4452-bab0-c0df3f123a30",
                "created_at" : "2023-02-17 02:19:48",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:19:09",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(390B)K",
                "nama_bahan" : "PE Protection Tape 1240 HIS-390B Plain (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "1385a518-298d-48ff-a0ac-93834ae725c0",
                "created_at" : "2023-02-16 06:19:09",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 09:27:03",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PB90",
                "nama_bahan" : "F1 PMMA BRILLIANT FOIL 75 PATTERN GS90",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "1417e11d-1630-47da-a290-3725831e4939",
                "created_at" : "2024-03-27 07:38:26",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:54:12",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PS685D",
                "nama_bahan" : "PS STYRON 685 D",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "16002ece-4fc8-43b7-bd7c-9a7667db0d28",
                "created_at" : "2023-02-17 07:11:31",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:39:24",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF4609PRT620",
                "nama_bahan" : "Masking Film 4609 Plain 620",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "1b329aa8-52dd-4462-9af2-78b117e10b06",
                "created_at" : "2023-02-17 07:06:34",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:37:21",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "P70SM",
                "nama_bahan" : "Laminasi Silicure P70 TP330 Supermatt (SPL)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "1bda2323-9ed8-4d46-9cbb-5be542d58be8",
                "created_at" : "2023-02-16 07:04:00",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:54:24",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PVC-1255",
                "nama_bahan" : "PVC-1255",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "1f2fdace-ddd0-4aff-9865-76f318d35b95",
                "created_at" : "2023-02-16 06:14:45",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 09:25:02",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "M8B41220",
                "nama_bahan" : "BRIGHT FILM MITT8BIR4 1220MM (SPL)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "1f3aee4c-628e-439d-89d7-ee5452aa09bf",
                "created_at" : "2023-02-17 02:02:30",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:41:22",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF4609PLN1400",
                "nama_bahan" : "MASKING FILM 4609V PLAIN 1400 (NK)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "20d7eb5f-0a87-4dc8-807a-7c0ff55a3816",
                "created_at" : "2023-02-17 07:19:20",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 04:28:03",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "SK7343SPL",
                "nama_bahan" : "MF 1240 SK7343 CLEAR (SAMPLE)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "22acbe25-9ba7-4654-aa49-798255ce889c",
                "created_at" : "2024-04-24 03:34:32",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:24:38",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT990NPPRTK",
                "nama_bahan" : "PE Protection Tape 1240 HIS-990NP(C)PRINT, 0.06mm (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "25cedb1b-1ea9-43d1-aa68-61cd13b59d54",
                "created_at" : "2023-02-14 02:03:42",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-19 09:20:28",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MTA05",
                "nama_bahan" : "ABS MTA05 MATTE ASA",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "2899ef49-05a3-4a46-b32a-f95da67dd475",
                "created_at" : "2023-02-16 06:37:00",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 02:21:13",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "GS\/90(SPL)",
                "nama_bahan" : "PMMA Glossy Foil 53µ\/1270mm Design GS\/90 (SAMPLE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "2bbcc749-2f3b-4b91-b159-5c65239fabeb",
                "created_at" : "2023-10-04 01:53:00",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:36:56",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "SMPXEX",
                "nama_bahan" : "PMMA SUMIPEX EX NATURAL",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "30d92e9e-ef2c-4919-b563-90f777abc63c",
                "created_at" : "2023-02-16 07:04:15",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:54:37",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PVC-1270",
                "nama_bahan" : "PVC-1270",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "31a229db-ae95-46e1-b299-96cbb8b27f97",
                "created_at" : "2023-02-14 02:00:26",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-19 04:30:33",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "A290XK",
                "nama_bahan" : "ABS MAGNUM A290X (K)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "35ea51f6-aa2d-4f58-be9e-e1899bac46c6",
                "created_at" : "2023-02-16 06:57:15",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:56:14",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "UP23B",
                "nama_bahan" : "UV, PET 23 Brush, Al-Met, HSL\/1220 ( SAMPLE )",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "37f38d9e-6e47-41dd-9320-cb17713c6aaa",
                "created_at" : "2023-02-17 07:15:36",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 06:05:57",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "A3246",
                "nama_bahan" : "MF PM7-TN A3246 BLUE (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "3a6e0e9e-5a7a-48ab-82b1-2dcf050eafb3",
                "created_at" : "2023-02-17 01:43:42",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 08:01:06",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "VM50\/1290 (SPL)",
                "nama_bahan" : "Viscora Mirror 50 mic\/1290 (Sample) Hueck Folien",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "3b31940b-bed7-4403-970a-d8a867497b98",
                "created_at" : "2023-04-10 06:20:30",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:39:16",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "WG8112HG",
                "nama_bahan" : "PMMA WEATHERGUARD 8112 HG CLEAR (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "3d4350bb-8075-4b24-b325-2eee0d1b69bf",
                "created_at" : "2023-02-16 06:19:47",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:24:39",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PB93",
                "nama_bahan" : "F1 PMMA BRILLIANT FOIL 75 PATTERN ZO93",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "3e8992ce-1b40-4082-a7ba-deff1e941831",
                "created_at" : "2023-02-17 07:15:49",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 06:05:43",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "A2242",
                "nama_bahan" : "MF PM7-CT A2242 BLUE (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "405af5a5-cccb-48f7-bb2c-54430cfd07b4",
                "created_at" : "2023-08-01 08:00:23",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:37:20",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "SMPXMH",
                "nama_bahan" : "PMMA SUMIPEX MH NATURAL",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "40eb86e0-8c60-4c11-ac1c-edabfddd79b0",
                "created_at" : "2023-02-17 02:56:12",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:25:34",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT620B(SPL)",
                "nama_bahan" : "PE Protection Tape HIS-620B, 50mic*200mm, Blue (SPL)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "474ee260-8571-498e-951f-f5d769a6da76",
                "created_at" : "2024-01-02 07:09:20",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 04:30:47",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "LGCHEM",
                "nama_bahan" : "ABS LG CHEM SPL",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "4d49a101-0f5c-435f-8f18-ae3f32bd5f3c",
                "created_at" : "2023-02-17 07:09:32",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:39:35",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF4609PRT600",
                "nama_bahan" : "Masking Film 4609 Print 600",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "531d47eb-cc36-4e9b-afc2-78667a75a379",
                "created_at" : "2023-02-16 03:26:25",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:55:50",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "TM",
                "nama_bahan" : "TIARA MIX",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "55941aa7-1489-4347-9299-e23e5440c674",
                "created_at" : "2023-02-17 07:19:56",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:35:28",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PE50MIC*1250MM",
                "nama_bahan" : "PE Surface Protection Tape HIS-990, 50mic*1250mm*190M, Clear (Sample)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "5595fbaf-3a9e-4304-a8c4-b2507c9c7620",
                "created_at" : "2023-02-16 06:20:39",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 02:20:40",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "AF29(SPL)",
                "nama_bahan" : "PMMA GLOSSY 75µ AF29 BATCH P23319 (SPL) UK. 1280MM",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "59e7fe8b-fa24-4702-ba01-dde12892f9c8",
                "created_at" : "2024-07-22 09:08:24",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : null,
                "updated_by" : null,
                "kode" : "PEPT925CPRINT",
                "nama_bahan" : "PE Protection Tape 1240 HIS-925C Print 0.06mm (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "5a34a83d-1a43-4df3-a61f-34288ee14b07",
                "created_at" : "2023-02-16 02:33:16",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 09:20:48",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "HE0110S",
                "nama_bahan" : "ABS STAREX  HE-0110P(SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "5bd288ea-d0ec-4c71-b60c-52d20cc2014e",
                "created_at" : "2023-08-04 08:42:32",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 06:06:30",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "NDT720B",
                "nama_bahan" : "NDT720 BLUE 1250 50MIC",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "60e49020-bc94-4cdf-bb76-9ea68ee13d60",
                "created_at" : "2023-02-16 06:17:05",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 09:26:24",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "EFCIMP",
                "nama_bahan" : "EF1501884 CLASSICO IVORY MIT PRIMER (SPL)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "60f17cd4-2e23-40da-a7cc-c39799966e54",
                "created_at" : "2023-02-16 07:06:20",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:59:49",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "VM50\/1226",
                "nama_bahan" : "Viscora Mirror 50 mic\/1226 (Sample) Hueck Folien",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "6276906e-79b4-4f28-80be-86c92506d7e0",
                "created_at" : "2023-02-14 01:59:24",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-21 02:21:40",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "P8NK",
                "nama_bahan" : "PMMA PLEXIGLAS 8N (K)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "63fb3e51-808b-4864-9fe4-73c54f5a2dda",
                "created_at" : "2023-02-14 02:00:46",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2023-02-16 06:11:00",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : null,
                "nama_bahan" : "MASKING FILM S1Q1 PLAIN 1240x0.05MM (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "64c3e6e8-bcc4-4d29-bd0a-acd9620b120a",
                "created_at" : "2023-06-16 07:16:09",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:44:00",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PF21",
                "nama_bahan" : "Polifilm21\/2\/50DPVIBLUE (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "680d079c-3485-4ae6-95ff-f6ce453242ce",
                "created_at" : "2024-07-09 01:59:34",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : null,
                "updated_by" : null,
                "kode" : "PEPT990NPCLRPRT",
                "nama_bahan" : "PE Protection Tape 1240 HIS-990NP(C)CLEAR PRINT, 0.06mm (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "68e91dea-cb4f-4670-8e2b-da5e7b3433e5",
                "created_at" : "2023-02-13 23:23:25",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-20 06:04:26",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "NDT700BL(SPL)",
                "nama_bahan" : "MF NDT 700 BLUE 50MC (SAMPLE)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "6b53deb0-4280-466d-afd2-9d74190020a3",
                "created_at" : "2023-02-14 02:03:23",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-20 03:57:30",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF375CLR1500",
                "nama_bahan" : "Masking Film GH-X-375 CLEAR 1500X0.06MM (NK)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "6ef30f38-d0fc-4791-b9e0-dfee28f6a771",
                "created_at" : "2023-02-16 06:57:46",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:56:40",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "P50TPR",
                "nama_bahan" : "UV, PET 50 My Transparent, PR \/1220 (SAMPLE )",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "6f4bb634-c16b-41d5-ba6a-826802fe2c90",
                "created_at" : "2023-02-13 23:23:36",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-21 07:50:40",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "4374(SPL)",
                "nama_bahan" : "Protection Film 1240 Clear 4374 (SPL)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "71b7d380-b375-4f13-9220-134339fab153",
                "created_at" : "2023-02-16 06:13:16",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:25:24",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "FASLA107343(SPL)",
                "nama_bahan" : "FOIL ALUFIN SLA107343 LAM 1300MM (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "71d6c9fe-cc1b-47d5-a1b6-3b08a876fb00",
                "created_at" : "2024-08-30 08:46:06",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : null,
                "updated_by" : null,
                "kode" : "3904(K)",
                "nama_bahan" : "ABS MAGNUM 3904 Smooth (K)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "72204291-1bda-4231-8a6c-1b6a2c90ad6f",
                "created_at" : "2023-02-16 02:44:11",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:34:06",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "INFINOSC1060U",
                "nama_bahan" : "INFINO SC-1060U",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "7668011f-6f17-4d11-a4d8-e8c8d54f9e2b",
                "created_at" : "2023-07-17 01:17:14",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:45:55",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MFC1900SPL",
                "nama_bahan" : "Masking Film Clear 1900 SPL 8600",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "77f27a47-30eb-4200-83a4-58febfa3e99f",
                "created_at" : "2023-02-17 07:20:44",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:30:09",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PE5AA-50",
                "nama_bahan" : "PE Protective Film 5AA-50 (Sample)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "78a1d1da-ea5e-40fc-8e17-7e0409eb4244",
                "created_at" : "2023-02-16 07:03:44",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:55:14",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PAD2009",
                "nama_bahan" : "PVC-A-D2009(1) (SAMPLE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "7a67f342-cae1-4419-bb83-6c2fc311f6db",
                "created_at" : "2023-02-16 06:10:00",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:36:43",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PXSF03K",
                "nama_bahan" : "PMMA PLEXIGLAS XF03 (K)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "7c1e34d2-6197-490f-895b-230d2d19453d",
                "created_at" : "2023-02-16 06:34:38",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 02:19:44",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "IW90W3D",
                "nama_bahan" : "PMMA Foil FI116 75µ\/1270mm Pattern IW90 Wood 3 D",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "7effabe2-b646-453f-b8dd-a461f26eae82",
                "created_at" : "2023-02-17 07:05:27",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:35:57",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "K70SM",
                "nama_bahan" : "Laminasi Silicure K70 TP822 Supermatt (SPL)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "7f8bcd33-f291-420c-9b60-d833f0298418",
                "created_at" : "2023-02-14 02:05:49",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : null,
                "updated_by" : null,
                "kode" : null,
                "nama_bahan" : "MF NDT 700 (SAMPLE)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "83201098-47cd-4b31-9cf5-e695dc71e2ca",
                "created_at" : "2023-02-17 02:54:19",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:17:45",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(390B)SPL",
                "nama_bahan" : "PE Protection Tape 1240 HIS-390B NEW Plain (SPL)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "84cad2df-5ce2-46d3-b23c-0cbfc650d965",
                "created_at" : "2023-02-17 01:54:14",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:46:29",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF375CLR1100",
                "nama_bahan" : "MASKING FILM GH-X-374 CLEAR 1100X0.06MM (NK)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "8635b6c4-34d5-42dd-90d1-70eef19fca62",
                "created_at" : "2023-02-16 02:38:05",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 09:22:48",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "XWR9700T",
                "nama_bahan" : "ASA STAREX WR-9700T",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "8a5d65c3-3c7b-450f-bd81-558b188fb744",
                "created_at" : "2023-02-17 02:20:10",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:21:37",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(925B)NK",
                "nama_bahan" : "PE Protection Tape 1240 HIS-925B (NK)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "8cb0d2f0-94fb-49ce-9c73-4ee8e98820b3",
                "created_at" : "2023-02-16 04:20:59",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:36:05",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PPFE70",
                "nama_bahan" : "PMMA PLEXIGLAS PFE70 CLEAR 9V913",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "8e06aca6-68dc-49b4-8759-e11bff3803f1",
                "created_at" : "2023-02-17 07:25:29",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:28:18",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPF1220",
                "nama_bahan" : "PE Protective Film 1220mm Sample",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "900e4b03-ec2e-4416-b8ec-70416f82e911",
                "created_at" : "2023-02-14 02:01:22",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-21 03:54:01",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "P8N",
                "nama_bahan" : "PMMA PLEXIGLAS 8N (NK)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "914dd6d8-35f8-438b-b669-294fb278685f",
                "created_at" : "2023-02-17 07:21:12",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:31:59",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PE5AA-60",
                "nama_bahan" : "PE Protective Film 5AA-60 (Sample)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "94434a09-74d3-4a0c-8a33-8ee49e6f1f9c",
                "created_at" : "2023-02-14 02:05:38",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-19 09:21:12",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "TA30-X01ORG",
                "nama_bahan" : "ABS TA30-X01 ORANGE ASA",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "95be3dda-0753-4861-93fc-cce810f7de7e",
                "created_at" : "2023-02-13 23:23:56",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-20 09:22:41",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(990LH)K",
                "nama_bahan" : "PE PROTECTION TAPE 1240 HIS-990LH BLUE (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "97df32cf-6310-4e9a-a5ba-9e3e99738c77",
                "created_at" : "2023-02-16 07:05:56",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:59:13",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "VM23\/1226",
                "nama_bahan" : "Viscora Mirror 23 mic\/1226 (Sample) Hueck Folien",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "98548ac4-9cf3-4430-9980-22956f779a95",
                "created_at" : "2023-09-25 03:28:41",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 09:20:10",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MATT",
                "nama_bahan" : "ABS MATT NATURAL (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "98e3d121-fdca-4109-8e1a-fec224cac7c6",
                "created_at" : "2024-07-02 06:37:51",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-07-02 06:42:58",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF4609PRT1240(NK)",
                "nama_bahan" : "Masking Film 4609 Printed 1240 (NON KITE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "99eaeea4-ad43-435f-98c3-0848ec8f1e43",
                "created_at" : "2023-02-17 07:12:02",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:38:40",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MFC1240(NOVACEL)",
                "nama_bahan" : "Masking Film 4510V Clear 1240 50mic (Sample)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "9ad11ceb-700b-49ed-acc6-24dbcd5b54bf",
                "created_at" : "2023-02-17 02:14:10",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 04:14:21",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MFS1Q1PRT1240",
                "nama_bahan" : "Masking Film S1 Q1 Printed 1240x0.05mm",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "9ae077fb-7fe0-443a-b0e1-8cdc77e701c1",
                "created_at" : "2023-08-16 04:45:18",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:23:29",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT990NPBLK",
                "nama_bahan" : "PE Protection Tape 1240 HIS-990NP(B)BLUE, 0.06mm (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "9b0b0ec3-83ba-44ef-a644-5ea9668c5b59",
                "created_at" : "2023-02-17 07:01:22",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:53:15",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PFC4174SPL",
                "nama_bahan" : "Protective Film Clear 4174 SPL",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "9f8dccdd-f306-4ef8-a7a3-c39c1607c331",
                "created_at" : "2023-02-17 02:18:30",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 04:13:25",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MFS1Q1PLN1300",
                "nama_bahan" : "Masking Film S1Q1 Plain 1300 50MY",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "a1f9a5e9-da9e-4153-804d-b337fa743980",
                "created_at" : "2023-02-17 02:38:18",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:20:54",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(620B)K",
                "nama_bahan" : "PE Protection Tape 1240 HIS-620B (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "a21ed6d3-47fb-4e74-bd95-82245d1e636c",
                "created_at" : "2023-02-17 07:02:41",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:52:52",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PF4233SPL",
                "nama_bahan" : "Protective Film 4233 SPL",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "a472570b-aac1-42df-95cf-6a5721b02117",
                "created_at" : "2023-02-17 07:00:15",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:33:43",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPFGSL20",
                "nama_bahan" : "PE Protective Film Glossy Surface 0.04mmx600mmx50m Low 20 (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "a6732b41-3938-46b4-9fa5-6577ee252b2b",
                "created_at" : "2023-02-17 02:19:03",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 04:13:39",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MFS1Q1PLN1310",
                "nama_bahan" : "Masking Film S1Q1 Plain 1310 50MY",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "a8c3949d-83d5-44a7-9342-b7049d124189",
                "created_at" : "2023-02-16 06:18:15",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:25:06",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "FSAED",
                "nama_bahan" : "F4239006P STR ARONA ELM DARKBROWN (SPL)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "ab7d2f4e-a05e-4f60-99e7-3a1f5fc9ed91",
                "created_at" : "2023-02-17 07:15:20",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:38:12",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MFB1400(NOVACEL)",
                "nama_bahan" : "Masking Film 4508 Bleu 1400mm 50mic DL14732 (Sample)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "ac6e1c55-cd0a-43f2-88d9-5d6d7c8c8690",
                "created_at" : "2023-02-16 06:58:33",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:57:34",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "UVP50PS1310",
                "nama_bahan" : "UV, PET 50 My, Print Design Stein\/1310 (SAMPLE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "ae151c60-018e-45c9-8691-d84ffff4b7d9",
                "created_at" : "2023-02-16 06:21:35",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:38:14",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "DBK90",
                "nama_bahan" : "PMMA TEXTURED FOIL 75µ\/1270MM DESIGN  BK90 BLACK (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "b44c9709-43b2-4e84-b38f-790046392aa7",
                "created_at" : "2023-02-16 06:37:17",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:28:03",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "GTGC13",
                "nama_bahan" : "Gross Type Gross C1-3 ( SAMPLE )",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "b621c737-bca8-463f-b48a-ed6739f27fa0",
                "created_at" : "2023-02-14 02:06:04",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-19 09:19:32",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "A460K",
                "nama_bahan" : "ABS MAGNUM A460 (K)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "b7e79e9c-abb2-4470-9634-24bd215ffbc1",
                "created_at" : "2024-04-24 03:34:03",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 09:22:00",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "ACLEAN400",
                "nama_bahan" : "Adhesive Clean Roll 3\" 1400x20M, 400g",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "ba7725fa-870d-451f-8702-48bfa87f9a42",
                "created_at" : "2023-06-23 03:02:32",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 06:04:55",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "NDT700BV.4",
                "nama_bahan" : "MF NDT700 BLUE(V.4) SPL",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "bb0c7abf-44ef-48fe-b39b-5da914f4f470",
                "created_at" : "2023-02-17 01:43:22",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 08:01:14",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "VM50\/1290",
                "nama_bahan" : "Viscora Mirror 50 mic\/1290 Hueck Folien",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "bd9c868c-bd15-49c6-9c02-653b6d255fc1",
                "created_at" : "2023-02-14 01:50:23",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-20 08:00:45",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(925B)K",
                "nama_bahan" : "PE PROTECTION TAPE 1240 925B (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "c1b5b3c4-0a82-452b-8130-aa867af99c7b",
                "created_at" : "2024-04-24 03:34:18",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 09:22:13",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "ACLEAN600",
                "nama_bahan" : "Adhesive Clean Roll 3\" 1400x20M, 600g",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "c2fd41f1-bcd0-4833-8b75-696e1d53c175",
                "created_at" : "2023-02-14 01:58:07",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-19 04:30:57",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "A440K",
                "nama_bahan" : "ABS MAGNUM A440 (K)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "c3457ba3-0515-465a-a444-42d60986baab",
                "created_at" : "2023-06-16 07:16:24",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:49:47",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PF23",
                "nama_bahan" : "Polifilm23\/50DBHSPVIBLUE (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "c70db624-f02b-4f6d-b786-7d34af33488b",
                "created_at" : "2023-02-17 07:11:46",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:41:51",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(925B)",
                "nama_bahan" : "Masking Film Blue 1240*50mic 925B(Sample HIS)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "c7f0685e-9894-4184-bbb1-78104b7dc9d4",
                "created_at" : "2023-02-16 06:58:20",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:57:23",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "UVP50PR1310",
                "nama_bahan" : "UV, PET 50 My, Print Design Rost\/1310 (SAMPLE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "c82b31c6-8020-4955-8499-01b144a41b7f",
                "created_at" : "2023-09-19 02:15:20",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:53:28",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PFC9556",
                "nama_bahan" : "Protective Film Clear 9556x1240mm",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "c93eea24-3997-4e7d-a16f-261c3c4e02a4",
                "created_at" : "2023-02-16 06:57:33",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:58:28",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "UVP50P1220",
                "nama_bahan" : "UV, PET 50my,Print \/1220 (SAMPLE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "cb94783b-e7c1-4002-8388-2480cd13b605",
                "created_at" : "2023-02-14 05:49:48",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-19 09:19:23",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "A440NK",
                "nama_bahan" : "ABS MAGNUM A440 NK",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "cd23e1aa-e124-4b86-895d-b388e295233d",
                "created_at" : "2023-11-29 07:39:47",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:18:44",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(390B)",
                "nama_bahan" : "PE Protection Tape 1240 HIS-390B Plain",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "cf4d90c6-2b82-454c-9b9e-ee8fdd03cc75",
                "created_at" : "2023-02-16 07:03:26",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:55:27",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PLG007",
                "nama_bahan" : "PVC-LG007(1) (SAMPLE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "d15d6df7-e174-4534-9a0d-db3219b51fc5",
                "created_at" : "2023-02-16 06:40:56",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 04:14:47",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MTSE130",
                "nama_bahan" : "Matte Type Satin E -130 ( SAMPLE )",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "d25c2c09-8773-40f9-985b-ff93818f9bc2",
                "created_at" : "2023-02-14 02:04:59",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-21 07:39:51",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "XL553(K)",
                "nama_bahan" : "PMMA XL553 (K)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "d3d6eb1f-bf62-4853-8e64-f0f3533034b0",
                "created_at" : "2023-02-16 06:56:47",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:30:03",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "HLMAAB1L1070",
                "nama_bahan" : "Hairline MITTAAB1L (1070mmx50m) (SAMPLE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "d5a5c1e2-7c4f-4390-a949-539239413ef0",
                "created_at" : "2023-02-17 07:19:39",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 04:28:34",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "B2K7PSPL",
                "nama_bahan" : "MF 1250 B2-K7P CLEAR (SAMPLE)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "d7356fd2-0664-411f-b9ac-81416c5c9930",
                "created_at" : "2023-02-14 01:59:45",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-20 03:58:28",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF375CLR1900",
                "nama_bahan" : "Masking Film GH-X-375 CLEAR 1900X0.06MM (NK)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "d87c238f-39a3-40a5-a865-132f1d0caeec",
                "created_at" : "2024-03-07 01:58:49",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:42:21",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MFCLEAR1240",
                "nama_bahan" : "Masking Film Clear 1240 (Sample Bischof)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "d88a7156-7830-4608-a3ef-1909ef03dd0f",
                "created_at" : "2023-02-16 06:34:13",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 02:20:00",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "GS90FM",
                "nama_bahan" : "PMMA Foil FI116 75µ\/1270mm Pattern GS90 Fabrics Metal",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "d8fa6d72-03ac-42a8-a815-74add69a7443",
                "created_at" : "2023-02-16 02:53:03",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 02:19:08",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "HD08L (SPL)",
                "nama_bahan" : "PMMA ACRYPLUS WANHUA HD08L",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "d9fe7beb-98f8-4bb1-ada4-52853a130507",
                "created_at" : "2023-02-16 02:40:00",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:33:48",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "INFINO1100N",
                "nama_bahan" : "INFINO SC-1100UR NP NATURAL",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "dca577b2-f840-4913-a086-125043ba3225",
                "created_at" : "2023-08-16 04:45:45",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:23:51",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT990NPCLRK",
                "nama_bahan" : "PE Protection Tape 1240 HIS-990NP(C)CLEAR, 0.06mm (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "ddcd6388-9ee7-4200-96b8-7fa63e9ce2e3",
                "created_at" : "2023-11-29 07:37:42",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:59:26",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MFS1Q1PLN1240",
                "nama_bahan" : "Masking Film S1Q1 Plain 1240x0.05mm",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "e2e1a07c-2af0-4f0e-abc2-2c8ad027a7ae",
                "created_at" : "2023-02-17 07:10:27",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:39:44",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF4609PRT750",
                "nama_bahan" : "Masking Film 4609 Print 750",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "e395b27a-e512-4db0-a5bd-cc80f4c7f9e5",
                "created_at" : "2023-02-16 07:04:40",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:59:32",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "VM50",
                "nama_bahan" : "Viscora Mirror 50 mic\/1220 (Sample)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "e4556f44-9cb1-4b2c-8ffe-d64c6315b680",
                "created_at" : "2023-02-17 07:25:42",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 02:17:47",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PPF1223",
                "nama_bahan" : "Plastic Protective Film Plain 1223 (Sample)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "e50ec4fe-c9b0-4334-9f47-75cebfabedab",
                "created_at" : "2024-01-04 06:57:16",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-19 09:19:48",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "ABSMATT",
                "nama_bahan" : "ABS MAGNUM MATT",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "e51d34bf-352e-4364-8e57-7d64eb40c5b5",
                "created_at" : "2023-10-04 02:09:25",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 07:37:40",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "SMPXSM2",
                "nama_bahan" : "PMMA SUMIPEX SM2 (SPL)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "e5358bef-27bf-4879-af76-3daf68e341d6",
                "created_at" : "2023-02-17 07:08:09",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:40:48",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF4609PRT580",
                "nama_bahan" : "Masking Film 4609 Printed 580",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "e633e3ba-6ae7-4584-b356-4b7beffe07df",
                "created_at" : "2023-02-14 02:05:20",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-21 02:21:27",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "XM553",
                "nama_bahan" : "PMMA LX XM553 (K)",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "ed041b66-e29c-4f64-8870-ec52da6687c5",
                "created_at" : "2023-02-16 06:41:40",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:27:23",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "GCM8B1240",
                "nama_bahan" : "Gloss Chrome MITT8BIR4 (1240mmx50m) (SAMPLE)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "edb22d55-6872-4ae4-933e-11cdb3117ea5",
                "created_at" : "2024-05-31 03:09:05",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:26:16",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "HIS-DT750(SPL)",
                "nama_bahan" : "PE Protection Tape HIS-DT750, 50mic*600mm*200m,Clear Sample",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "ee440847-ce7b-4287-b2bc-124316bce6b9",
                "created_at" : "2023-02-17 02:13:20",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:59:04",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MFS1Q1PLN1223",
                "nama_bahan" : "Masking Film S1Q1 Plain 1223 50MY",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "eeee130c-a69b-42ef-a60b-5d0039c84d76",
                "created_at" : "2023-02-17 06:55:21",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:22:06",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(990B)",
                "nama_bahan" : "PE Protection Tape 1240 HIS-990B Blue",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "eefc27e8-0bb1-4de2-85fd-e5634af765e4",
                "created_at" : "2023-02-13 23:23:46",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-19 09:21:33",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "T100N",
                "nama_bahan" : "ABS TOYOLAC T-100 (322) NATURAL",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "f02324c0-f819-4ed8-84c6-648a33a80245",
                "created_at" : "2023-02-14 02:06:14",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-20 09:22:18",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(990B)K",
                "nama_bahan" : "PE PROTECTION TAPE 1240 HIS-990L BLUE (K)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "f292e71b-3074-4935-82c8-f8b41062e4cd",
                "created_at" : "2023-02-17 07:04:33",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 03:37:39",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "P180SM",
                "nama_bahan" : "Laminasi Structal P180 1360mm 330 SUPERMATT(SPL)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "f360e088-06a4-4e5f-8034-7687b18ff740",
                "created_at" : "2023-02-17 07:20:25",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 06:03:26",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "INCOLORE1900(SPL)",
                "nama_bahan" : "MF De Protection Incolore 1900 CLEAR KODE 9872(Sample Novacel)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "f83c32f9-9b64-4c02-9cfd-97351db24a5f",
                "created_at" : "2023-06-12 07:02:56",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-21 02:18:50",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "HD03",
                "nama_bahan" : "PMMA Acryplus Wanhua HD03",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "f902d48b-0861-4c62-82da-4c85aae9e174",
                "created_at" : "2023-02-17 02:51:05",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 09:21:05",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "PEPT1240(620B)",
                "nama_bahan" : "PE Protection Tape 1240 HIS-620B (NK)",
                "satuan" : "SQM"
            },
            {
                "bahan_id" : "f9e9d697-d44b-493a-98cc-cf6306944510",
                "created_at" : "2023-08-04 08:42:47",
                "created_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "updated_at" : "2024-06-20 06:02:45",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF63N",
                "nama_bahan" : "MF 63N CLEAR 124*13*13CM",
                "satuan" : "KG"
            },
            {
                "bahan_id" : "ffd0b286-7c20-4de4-a11f-774bda25b3ca",
                "created_at" : "2023-02-13 23:23:14",
                "created_by" : "a9467865-37c1-4104-bd63-b26a33c915db",
                "updated_at" : "2024-06-20 03:40:10",
                "updated_by" : "3b74fb60-1027-4612-b559-98cecb8e7a78",
                "kode" : "MF4609PRT1240(K)",
                "nama_bahan" : "MASKING FILM 4609 PRINTED 1240 (K)",
                "satuan" : "SQM"
            }
        ]';

        $bahan = json_decode($data);
        // dd(json_decode($data));

        $user = AuthCommon::getUser();
        $insert = [];
        foreach ($bahan as $key => $value) {
            $insert[] = [
                'uid' => Str::uuid()->toString(),
                'nama' => $value->nama_bahan,
                'kode' => $value->kode,
                'satuan' => $value->satuan,
                'created_by' => $user->uid,
            ];
        }
        // dd($insert);
        Bahan::insert($insert);
        $body = view('pages.master_data.bahan.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Create Bahan Baku',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'satuan' => 'required',
        ]);
        $data = $request->except('_token');
        try {

            $user = AuthCommon::getUser();
            $trx = Bahan::create([
                'uid' => Str::uuid()->toString(),
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'satuan' => $data['satuan'],
                'created_by' => $user->uid,
            ]);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Berhasil Membuat Bahan Baku'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Bahan Baku'
                ], 400);
            }
        } catch (\Throwable $th) {
            throw $th;
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal'
            ], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bahan $bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bahan $bahan)
    {
        if ($bahan) {
            $uid = $bahan->uid;
            $data = $bahan;
            $body = view('pages.master_data.bahan.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Bahan Baku',
                'body' => $body,
                'footer' => $footer
            ];
        } else {
            return response([
                'status' => false,
                'message' => 'Failed Connect to Server'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bahan $bahan)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'satuan' => 'required',
        ]);
        $formData = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();
            $formData['updated_by'] = $user->uid;
            $trx = $bahan->update($formData);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Data Berhasil Diubah'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Data Gagal Diubah'
                ], 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => false,
                'message' => 'Kesalahan Internal'
            ], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bahan $bahan)
    {
        try {
            $delete = $bahan->delete();
            if ($delete) {
                return response()->json([
                    'message' => 'Berhasil Menghapus Data'
                ]);
            } else {
                return response()->json([
                    'message' => 'Gagal Menghapus Data'
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Data Failed, this data is still used in other modules !'
            ]);
        }
    }
}
