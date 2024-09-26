
@php
use App\Helpers\Utils;
@endphp
<table class="table table-borderless align-items-left table-flush table-header col-md-6">
    <tbody>
        <tr>
            <td>Nomor Bukti</td>
            <td>:</td>
            <th>{{ @$barangKeluar->nomor_bukti }}</th>
        </tr>
        <tr>
            <td>Tanggal Bukti</td>
            <td>:</td>
            <th>{{ @$barangKeluar->tanggal_bukti }}</th>
        </tr>
        <tr>
            <td>Customer</td>
            <td>:</td>
            <th>{{ @$customer->nama }} <span class="badge badge-default badge-xl ml-2">{{ @$barangKeluar->tipe }}</span></th>
        </tr>
        <tr>
            <td>Negara Tujuan</td>
            <td>:</td>
            <th>{{ @$customer->negara }}</th>
        </tr>
        @if( @$barangKeluar->tipe == "lokal" )
        <tr>
            <td>PPN</td>
            <td>:</td>
            <th>{{ @$barangKeluar->ppn }}</th>
        </tr>
        @else
        <tr>
            <td>Nomor PEB</td>
            <td>:</td>
            <th>{{ @$barangKeluar->nomor_peb }}</th>
        </tr>
        <tr>
            <td>Tanggal PEB</td>
            <td>:</td>
            <th>{{ @$barangKeluar->nomor_peb }}</th>
        </tr>
        @endif
    </tbody>
</table>
<div class=" py-2 ">
    <table class="table display nowrap" style="width:100%" id="table-barangKeluar-item">
        <thead>
            <tr>
                <th>No</th>
                <th class="all">Nama Barang</th>
                <th class="all">Jumlah</th>
                <th class="all">Bruto</th>
                <th class="all">Netto</th>
                <th class="all">Nilai</th>
                @if (@$barangKeluar->tipe == "lokal")
                <th class="none">Nilai PPN</th>
                <th class="none">Nilai Total</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($barangKeluarItems as $item)
            <tr>
                <td></td>
                <td>{{ $item->barang->nama }} {{ $item->barang->warna }} {{ $item->barang->panjang }} x {{ $item->barang->lebar }} x {{ $item->barang->tebal }}</td>
                <td>{{ $item->jumlah }} {{$item->barang->satuan}} ( {!! Utils::decimal($item->jumlah_sqm ?? 0, 3); !!} SQM )</td>
                <td>{!! Utils::decimal($item->bruto ?? 0, 3); !!} KG</td>
                <td>{!! Utils::decimal($item->netto ?? 0, 3); !!} KG</td>
                <td>{{ $item->mata_uang }} {!! Utils::decimal($item->nilai ?? 0, 2); !!} </td>
                @if (@$barangKeluar->tipe == "lokal")
                <td>IDR {!! Utils::decimal($item->nilai_ppn ?? 0, 2); !!} </td>
                <td>IDR {!! Utils::decimal($item->nilai_total ?? 0, 2); !!} </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(() => {
        let table = $("#table-barangKeluar-item").DataTable({
          responsive: {
              details: {
              type: 'column'
              }
          },
          columnDefs: [{
              className: 'control',
              orderable: false,
              targets: 0
          }],
          order: [1, 'asc']
        });
        // table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
    })
</script>