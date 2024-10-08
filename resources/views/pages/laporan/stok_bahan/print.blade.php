<!-- resources/views/pdf/report.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Laporan Stok Bahan Baku | PT. Tiara Indoprima</title>
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
          font-size: 18px;
          margin: 20px;
      }
      table {
        margin-left: 10%;
        width: 55%;
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
          
      }
      .total {
          font-weight: bold;
      }
      @media print {
          @page {
              size: potrait; /* Set the orientation to landscape */
          }
          .print\:hidden {
              display: none;
          }
          body {
            zoom: 60%;

          }
      }

      .header {
        margin-left: 10%;
          /* display: flex;
          justify-content: space-between; */
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
      <button size="small" id="hide" >Sembunyikan Stok Kosong</button>
  </div>
  <div class="header">
    <p class="desc">
      LAMPIRAN XXII <br> PERATURAN DIREKTUR JENDERAL BEA DAN CUKAI <br> NOMOR PER-5/BC/2023 <br> TENTANG <br> TATA LAKSANA MONITORING DAN EVALUASI TERHADAP <br> PERUSAHAAN PENERIMA FASILITAS KEMUDAHAN IMPOR TUJUAN EKSPOR
    </p>
    <div class="title">
        <h1>LAPORAN STOK BAHAN BAKU</h1>
        <h3>PT. Tiara Indoprima</h3>
    </div>
      
    <p>Per Tanggal: {{$today}}</p>
  </div>
  @php use App\Helpers\Utils; @endphp
  <table id="table">
      <thead>
          <tr>
              <th>No.</th>
              <th>Nama Bahan</th>
              <th>Stok</th>
              <th>Satuan</th>
          </tr>
      </thead>
      <tbody>
          @foreach($bahans as $item)
        <tr class="{{ is_null($item->getSaldoAkhir()) || $item->getSaldoAkhir() == '0.00' || $item->getSaldoAkhir() < 0 ? 'hide-row' : '' }}">
            <td class="row-number">{{ $loop->iteration }}</td>
            <td style="text-align: left">{{ $item->nama }}</td>
            <td style="text-align: right">{!! !is_null($item->getSaldoAkhir()) && $item->getSaldoAkhir() != '0.00' ? Utils::decimal($item->getSaldoAkhir(),3) : "" !!}</td>
            <td style="text-align: left">{{ $item['satuan'] }}</td>
        </tr>
        @endforeach
        <tr class="xls-ignore">
            <td colspan="2" rowspan="2" class="total" style="text-align: end; font-size: 20px; letter-spacing: 20px">TOTAL</td>
            <td rowspan="2" class="digit" style="text-align: right;">
            @foreach($stat['total'] as $key => $value)
                {!! Utils::decimal($value,3) !!}<br>
            @endforeach
            </td>
            <td rowspan="2" style="text-align: left">
            @foreach($stat['total'] as $key => $value)
                {{ $key }}<br>
            @endforeach
            </td>
        </tr>
      </tbody>
  </table>
{{-- Global js --}}

<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script>
  function tableToExcel(content, filename) {
      $.ajax({
          url: "{{ route('excel-report.stok-bahan') }}",
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
    const filename = `LAPORAN-STOK-BAHAN-BAKU-${yyyy}${mm}${dd}${h}${i}${s}`; // Add your desired filename here
    tableToExcel(content, filename);
  }

  $(document).ready(function() {
    // This will ensure handleExport is ready to be used
    $('#excel').on('click', handleExport);
    let hidden = false;
    updateRowNumbers();
    $('#hide').on('click', function() {
        if (hidden) {
            $('.hide-row').show();
            $(this).text('Sembunyikan Stok Kosong');
        } else {
            $('.hide-row').hide();
            $('.hide-row').addClass('xls-ignore');
            $(this).text('Tampilkan Stok Kosong');
        }
        hidden = !hidden;
        updateRowNumbers();
    });
  }); 
  function updateRowNumbers() {
      let rowNumber = 1;
      $('#table tbody tr:visible').each(function() {
          $(this).find('.row-number').text(rowNumber++);
      });
  }
</script>
</body>
</html>
