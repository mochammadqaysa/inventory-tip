<!-- resources/views/pdf/report.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Laporan Pengeluaran Waste / Scrap | PT. Tiara Indoprima</title>
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
          <h1>LAPORAN PENGELUARAN WASTE / SCRAP</h1>
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
              <th>No.</th>
              <th>Nomor Invoice</th>
              <th>Tanggal Invoice</th>
              <th>Nomor SPPB BC 2.4</th>
              <th>Tanggal SPPB BC 2.4</th>
              <th>Nomor PIB</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Nilai</th>
              <th>Pembeli / Penerima</th>
          </tr>
      </thead>
      <tbody>
        @php
            $lastNomorBukti = null;
            $iteration = 1;
        @endphp
        @foreach ($wasteKeluarItems as $item)
        <tr>
          @if($item->wasteKeluar->nomor_invoice != $lastNomorBukti)
            <td>{{ $iteration }}</td>
            <td style="text-align: left">{{ $item->wasteKeluar->nomor_invoice }} </td>
            <td>{{ Utils::formatTanggalLaporan($item->wasteKeluar->tanggal_invoice) }}</td>
            <td>{{ $item->wasteKeluar->nomor_sppb }}</td>
            <td>{{ Utils::formatTanggalLaporan($item->wasteKeluar->tanggal_sppb) }}</td>
            @php $iteration++; @endphp
            @else
            <td></td>
            <td style="text-align: left"></td>
            <td></td>
            <td></td>
            <td></td>
          @endif
          <td>{{ $item->nomor_pib }}</td>
          <td style="text-align: left">{{ $item->kode }}</td>
          <td style="text-align: left">AFVAL {{ $item->jenis }} {{$item->waste->nama}}</td>
          <td style="text-align: right" >{!! Utils::decimal($item->jumlah_kg,3) !!}</td>
          @if($item->wasteKeluar->nomor_invoice != $lastNomorBukti)
          <td style="text-align: right" >{!! Utils::decimal($item->wasteKeluar->nilai,2) !!}</td>
          @else
          <td></td>
          @endif
          <td style="text-align: left">{{$item->wasteKeluar->customer->nama}}</td>
        </tr>
        @php
            $lastNomorBukti = $item->wasteKeluar->nomor_invoice;
        @endphp
        @endforeach
        <tr class="xls-ignore">
            <td colspan="8" rowspan="2" class="total" style="text-align: end; font-size: 20px; letter-spacing: 20px">TOTAL</td>
            <td rowspan="2" class="digit" style="text-align: right;">
            {!! Utils::decimal($stat['total_jumlah'],3) !!}
            </td>
            <td rowspan="2" class="digit" style="text-align: right;">
            {!! Utils::decimal($stat['total_nilai'],3) !!}
            </td>
            <td></td>
        </tr>
      </tbody>
  </table>
{{-- Global js --}}

<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script>
  function tableToExcel(content, filename) {
      $.ajax({
          url: "{{ route('excel-report.waste-keluar') }}",
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
    const filename = `LAPORAN-PENGELUARAN-WASTE-SCRAP-${yyyy}${mm}${dd}${h}${i}${s}`; // Add your desired filename here
    tableToExcel(content, filename);
  }

  $(document).ready(function() {
    // This will ensure handleExport is ready to be used
    $('#excel').on('click', handleExport);
  }); 
</script>
</body>
</html>
