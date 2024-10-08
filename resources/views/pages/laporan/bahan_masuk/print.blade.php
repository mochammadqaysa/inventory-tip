<!-- resources/views/pdf/report.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Laporan Pemasukan Bahan Baku | PT. Tiara Indoprima</title>
    <link rel="icon" href="{{ asset('argon2/assets/img/logo.png') }}" type="image/png">
    <style>
      @font-face {
          font-family: 'Heebo';
          font-style: normal;
          font-weight: 400;
          src: url('{{ asset('fonts/Heebo-Regular.ttf') }}') format('truetype');
      }
      body {
          /* font-family: Arial, sans-serif; */
          font-family: 'Heebo', sans-serif;
          font-size: 12px;
          margin: 20px;
      }
      table {
          width: 100%;
          border-collapse: collapse;
      }
      th, td {
          border: 1px solid #9CA3AF;
          padding: 5px;
          text-align: center;
      }
      th {
          font-weight: bolder;
      }
      h1, h3 {
          text-align: center;
      }
      .total {
          font-weight: bold;
      }
      @media print {
          @page {
              size: landscape; /* Set the orientation to landscape */
          }
          .print\:hidden {
              display: none;
          }
          body {
            zoom: 60%;
          }
      }

      .header {
          display: flex;
          justify-content: space-between;
          align-items: center;
      }

      .title {
          margin-left: 500px;
          text-align: center;
      }

      .desc {
          text-align: right;
          font-weight: bold;
      }
    </style>
</head>
<body>
  <div class="print:hidden flex gap-1">
      <button size="small" id="excel">Export to excel</button>
      <button size="small" onclick="window.print()" >Print</button>
  </div>
  <div class="header">
      <div class="title">
          <h1>LAPORAN PEMASUKAN BAHAN BAKU</h1>
          <h3>PT. Tiara Indoprima</h3>
      </div>
      <p class="desc">
        LAMPIRAN XXII <br> PERATURAN DIREKTUR JENDERAL BEA DAN CUKAI <br> NOMOR PER-5/BC/2023 <br> TENTANG <br> TATA LAKSANA MONITORING DAN EVALUASI TERHADAP <br> PERUSAHAAN PENERIMA FASILITAS KEMUDAHAN IMPOR TUJUAN EKSPOR
    </p>
  </div>
  <p>Periode: {{$from}} s.d. {{$to}}</p>
  @php use App\Helpers\Utils; @endphp
  <table id="table">
      <thead>
          <tr>
              <th rowspan="2">No.</th>
              <th colspan="2">Bukti Pemasukan</th>
              @if($req_tipe != "lokal")
              <th rowspan="2">Jenis Dokumen</th>
              <th colspan="4">Dokumen Pabean</th>
              @endif
              <th rowspan="2">Kode BB</th>
              <th rowspan="2">Nama Bahan</th>
              <th colspan="2" rowspan="2">QTY</th>
              {{-- <th colspan="2" rowspan="2">Netto</th> --}}
              <th colspan="2" rowspan="2">Nilai Bahan</th>
              {{-- <th colspan="2" rowspan="2">Asuransi</th>
              <th colspan="2" rowspan="2">Ongkos</th>
              <th colspan="2" rowspan="2">Nilai Total</th> --}}
              <th rowspan="2">Gudang</th>
              <th rowspan="2">Subkontrak</th>
              <th colspan="2" rowspan="2">Supplier</th>
          </tr>
          <tr>
              <th>Nomor Bukti</th>
              <th>Tanggal Bukti</th>
              @if($req_tipe != "lokal")
              <th>Nomor PIB</th>
              <th>Tanggal PIB</th>
              <th>Kode HS</th>
              <th>Nomor Seri</th>
              @endif
          </tr>
      </thead>
      <tbody>
        @php
            $lastNomorBukti = null;
            $iteration = 1;
        @endphp
        @foreach ($bahanMasukItems as $item)
        <tr>
          @if($item->bahanMasuk->nomor_bukti != $lastNomorBukti)
            <td>{{ $iteration }}</td>
            <td style="text-align: left">{{ $item->bahanMasuk->nomor_bukti }} (PO :{{ $item->bahanMasuk->nomor_po }})</td>
            @php $iteration++; @endphp
            @else
            <td></td>
            <td style="text-align: left">(PO : {{ $item->bahanMasuk->nomor_po }})</td>
          @endif
          {{-- @if ($item->bahanMasuk->nomor_bukti != $lastNomorBukti)
          @else
              <td></td>
          @endif --}}
          <td>{{ Utils::formatTanggalLaporan($item->bahanMasuk->tanggal_bukti) }}</td>
          @if($req_tipe != "lokal")
          <td>{{ $item->bahanMasuk->tipe == 'impor' ? 'BC 2.0' : '-' }}</td>
          <td>{{ $item->bahanMasuk->nomor_pib ?? "-" }}</td>
          <td>{{ Utils::formatTanggalLaporan($item->bahanMasuk->tanggal_pib) ?? "-" }}</td>
          <td>{{ $item->kode_hs ?? "-" }}</td>
          <td>{{ $item->nomor_seri ?? "-" }}</td>
          @endif
          <td style="text-align: left">{{ $item->bahan->kode }}</td>
          <td style="text-align: left">{{ $item->bahan->nama }}</td>
          <td style="text-align: right" class="digit">{!! Utils::decimal($item->jumlah,3) !!}</td>
          <td style="text-align: left" >{{ $item->bahan->satuan }}</td>
          {{-- <td> $item['netto'] </td> --}}
          <td>{{ !is_null($item->nilai) && $item->nilai != '0.00' ? $item->mata_uang : '' }}</td>
          <td style="text-align: right" class="digit">{!! !is_null($item->nilai) && $item->nilai != '0.00' ? Utils::decimal($item->nilai) : '' !!}</td>
          {{-- <td>{{ !is_null($item->asuransi) && $item->asuransi != '0.00' ? $item->mata_uang : '' }}</td>
          <td>{{ !is_null($item->asuransi) && $item->asuransi != '0.00' ? $item->asuransi : '' }}</td>
          <td>{{ !is_null($item->ongkos) && $item->ongkos != '0.00' ? $item->mata_uang : '' }}</td>
          <td>{{ !is_null($item->ongkos) && $item->ongkos != '0.00' ? $item->ongkos : '' }}</td>
          <td>{{ !is_null($item->nilai_total) && $item->nilai_total != '0.00' ? 'IDR' : '' }}</td>
          <td style="text-align: right">{!! !is_null($item->nilai_total) && $item->nilai_total != '0.00' ? Utils::decimal($item->nilai_total) : '' !!}</td> --}}
          <td>{{ $item->gudang->nama }}</td>
          <td></td>
          <td style="text-align: left">{{ $item->bahanMasuk->supplier->nama }}</td>
          <td style="text-align: left">{{ $item->bahanMasuk->supplier->negara }}</td>
        </tr>
        @php
            $lastNomorBukti = $item->bahanMasuk->nomor_bukti;
        @endphp
        @endforeach
        <tr class="xls-ignore">
          <td colspan="{{ $req_tipe != "lokal" ? "10" : "5"}}" rowspan="2" class="total" style="text-align: end; font-size: 20px; letter-spacing: 20px">TOTAL</td>
          <td rowspan="2" class="digit" style="text-align: right;">
            @foreach($stat['total_jumlah'] as $key => $value)
              {!! Utils::decimal($value,3) !!}<br>
            @endforeach
          </td>
          <td rowspan="2" style="text-align: left">
            @foreach($stat['total_jumlah'] as $key => $value)
              {{ $key }}<br>
            @endforeach
          </td>
          <td rowspan="2">
            @foreach($stat['total_nilai'] as $key => $value)
              {{ $key }}<br>
            @endforeach
          </td>
          <td rowspan="2" class="digit" style="text-align: right">
            @foreach($stat['total_nilai'] as $key => $value)
              {!! Utils::decimal($value) !!}<br>
            @endforeach
          </td>
          {{-- <td rowspan="2" >
            @foreach($stat['total_asuransi'] as $key => $value)
              {{ $key }}<br>
            @endforeach
          </td>
          <td rowspan="2" style="text-align: right">
            @foreach($stat['total_asuransi'] as $key => $value)
              {{ $value }}<br>
            @endforeach
          </td>
          <td rowspan="2" >
            @foreach($stat['total_ongkos'] as $key => $value)
              {{ $key }}<br>
            @endforeach
          </td>
          <td rowspan="2" style="text-align: right">
            @foreach($stat['total_ongkos'] as $key => $value)
              {{ $value }}<br>
            @endforeach
          </td>
          <td rowspan="2">IDR</td>
          <td rowspan="2" style="text-align: right">{!! Utils::decimal($stat['total_nilai_total']) !!}</td>
          <td rowspan="2" colspan="4"></td> --}}
          <td rowspan="2" colspan="4"></td>
        </tr>
      </tbody>
  </table>
{{-- Global js --}}

<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script>
  function tableToExcel(content, filename) {
      $.ajax({
          url: "{{ route('excel-report.bahan-masuk') }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "POST",  // Switch to POST
          data: {
              content: content,
              filename: filename
          },
          xhrFields: {
              responseType: 'blob'  // Ensure we handle the file as a blob for download
          },
          success: (res, status, xhr) => {
              // Create a temporary link element to trigger the download
              const blob = new Blob([res], { type: xhr.getResponseHeader('Content-Type') });
              const url = window.URL.createObjectURL(blob);
              const a = document.createElement('a');
              a.href = url;
              a.download = filename + '.xls'; // The filename to be downloaded
              document.body.appendChild(a);
              a.click();
              a.remove();
              window.URL.revokeObjectURL(url);
          },
          error: (err) => {
              console.error(err);  // Handle the error
          }
      });
  }
  function handleExport() {
    const content = Ryuna.tableToString('table'); // Correct usage of the class method
    var today = new Date();
    var h = String(today.getHours()).padStart(2, '0');
    var i = String(today.getMinutes()).padStart(2, '0');
    var s = String(today.getSeconds()).padStart(2, '0');
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    const filename = `LAPORAN-PEMASUKAN-BAHAN-BAKU-${yyyy}${mm}${dd}${h}${i}${s}`; // Add your desired filename here
    tableToExcel(content, filename);
  }

  $(document).ready(function() {
    // This will ensure handleExport is ready to be used
    $('#excel').on('click', handleExport);
  }); 
</script>
</body>
</html>
