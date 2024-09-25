
@php
use App\Helpers\Utils;
@endphp
<table class="table table-borderless align-items-left table-flush table-header col-md-6">
    <tbody>
        <tr>
            <td>Nomor Bukti</td>
            <td>:</td>
            <th>{{ @$barangMasuk->nomor_bukti }}</th>
        </tr>
        <tr>
            <td>Tanggal Bukti</td>
            <td>:</td>
            <th>{{ @$barangMasuk->tanggal_bukti }}</th>
        </tr>
        <tr>
            <td>Gudang Penyimpanan</td>
            <td>:</td>
            <th>{{ @$gudang->nama }}</th>
        </tr>
    </tbody>
</table>
<div class=" py-2 ">
    <table class="table display nowrap" style="width:100%" id="table-bahanKeluar-item">
        <thead>
            <tr>
                <th></th>
                <th class="all">Nomor SPK</th>
                <th class="all">Nama Barang</th>
                <th class="all">Jumlah</th>
                <th class="all">KG / Item</th>
                <th class="all">Netto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangMasukItems as $item)
            <tr>
                <td></td>
                <td>{{ $item->nomor_spk }}</td>
                <td>{{ $item->barang->nama }}</td>
                <td>{{ $item->jumlah }} {{$item->barang->satuan}} ( {!! Utils::decimal($item->jumlah_sqm ?? 0, 3); !!} SQM )</td>
                <td>{!! Utils::decimal($item->kg_per_item ?? 0, 3); !!} KG</td>
                <td>{!! Utils::decimal($item->netto ?? 0, 3); !!} KG</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(() => {
        let table = $("#table-bahanKeluar-item").DataTable({
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