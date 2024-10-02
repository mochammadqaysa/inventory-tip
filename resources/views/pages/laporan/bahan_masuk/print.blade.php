<!-- resources/views/pdf/report.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemasukan Bahan Baku</title>
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
    </style>
</head>
<body>

    <h1>LAPORAN PEMASUKAN BAHAN BAKU</h1>
    <h3>PT. Tiara Indoprima</h3>
    <p>Periode: {{$from}} s.d. {{$to}}</p>
    @php use App\Helpers\Utils; @endphp
    <table>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th colspan="2">Bukti Pemasukan</th>
                <th colspan="4">Dokumen Pabean</th>
                <th rowspan="2">Kode BB</th>
                <th rowspan="2">Nama Bahan</th>
                <th colspan="2" rowspan="2">QTY</th>
                {{-- <th colspan="2" rowspan="2">Netto</th> --}}
                <th colspan="2" rowspan="2">Nilai Bahan</th>
                <th colspan="2" rowspan="2">Asuransi</th>
                <th colspan="2" rowspan="2">Ongkos</th>
                <th colspan="2" rowspan="2">Nilai Total</th>
                <th rowspan="2">Gudang</th>
                <th rowspan="2">Subkontrak</th>
                <th colspan="2" rowspan="2">Supplier</th>
            </tr>
            <tr>
                <th>Nomor Bukti</th>
                <th>Tanggal Bukti</th>
                <th>Nomor PIB</th>
                <th>Tanggal PIB</th>
                <th>Kode HS</th>
                <th>Nomor Seri</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($bahanMasukItems as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$item->bahanMasuk->nomor_bukti}}</td>
            <td>{{ Utils::formatTanggalLaporan($item->bahanMasuk->tanggal_bukti) }}</td>
            <td>{{ $item->bahanMasuk->nomor_pib ?? "-" }}</td>
            <td>{{ Utils::formatTanggalLaporan($item->bahanMasuk->tanggal_pib) ?? "-" }}</td>
            <td>{{ $item->kode_hs ?? "-" }}</td>
            <td>{{ $item->nomor_seri ?? "-" }}</td>
            <td style="text-align: left">{{ $item->bahan->kode }}</td>
            <td style="text-align: left">{{ $item->bahan->nama }}</td>
            <td style="text-align: right" >{!! Utils::decimal($item->jumlah,3) !!}</td>
            <td style="text-align: left" >{{ $item->bahan->satuan }}</td>
            {{-- <td> $item['netto'] </td> --}}
            <td>{{ $item->mata_uang }}</td>
            <td style="text-align: right">{!! Utils::decimal($item->nilai) !!}</td>
            <td>{{ !is_null($item->asuransi) && $item->asuransi != '0.00' ? $item->mata_uang : '' }}</td>
            <td>{{ !is_null($item->asuransi) && $item->asuransi != '0.00' ? $item->asuransi : '' }}</td>
            <td>{{ !is_null($item->ongkos) && $item->ongkos != '0.00' ? $item->mata_uang : '' }}</td>
            <td>{{ !is_null($item->ongkos) && $item->ongkos != '0.00' ? $item->ongkos : '' }}</td>
            <td>{{ !is_null($item->nilai_total) && $item->nilai_total != '0.00' ? 'IDR' : '' }}</td>
            <td style="text-align: right">{!! !is_null($item->nilai_total) && $item->nilai_total != '0.00' ? Utils::decimal($item->nilai_total) : '' !!}</td>
            <td>{{ $item->gudang->nama }}</td>
            <td></td>
            <td>{{ $item->bahanMasuk->supplier->nama }}</td>
            <td>{{ $item->bahanMasuk->supplier->negara }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" rowspan="2" class="total" style="text-align: end; font-size: 20px; letter-spacing: 20px">TOTAL</td>
                <td rowspan="2" style="text-align: right;">
                  @foreach($stat['total_jumlah'] as $key => $value)
                    {{ $value }}<br>
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
                <td rowspan="2" style="text-align: right">
                  @foreach($stat['total_nilai'] as $key => $value)
                    {{ $value }}<br>
                  @endforeach
                </td>
                <td rowspan="2" >
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
                <td rowspan="2" colspan="4"></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
