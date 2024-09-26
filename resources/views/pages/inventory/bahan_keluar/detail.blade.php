
@php
use App\Helpers\Utils;
@endphp
<table class="table table-borderless align-items-left table-flush table-header col-md-6">
    <tbody>
        <tr>
            <td>Nomor Bukti</td>
            <td>:</td>
            <th>{{ @$bahanKeluar->nomor_bukti }}</th>
        </tr>
        <tr>
            <td>Tanggal Bukti</td>
            <td>:</td>
            <th>{{ @$bahanKeluar->tanggal_bukti }}</th>
        </tr>
        <tr>
            <td>Transaksi</td>
            <td>:</td>
            <th><span class="badge badge-default badge-xl">{{ @$bahanKeluar->transaksi }}</span></th>
        </tr>
        <tr>
            <td>Penerima</td>
            <td>:</td>
            <th>{{ @$bagian->nama }}</th>
        </tr>
        <tr>
            <td>Nomor SPK</td>
            <td>:</td>
            <th>{{ @$bahanKeluar->nomor_spk }}</th>
        </tr>
    </tbody>
</table>
<div class=" py-2 ">
    <table class="table display nowrap" style="width:100%" id="table-bahanKeluar-item">
        <thead>
            <tr>
                <th></th>
                <th class="all">Nama Bahan</th>
                <th class="all">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bahanKeluarItems as $item)
            <tr>
                <td></td>
                <td>{{ $item->bahan->nama }}</td>
                <td>{!! Utils::decimal($item->jumlah ?? 0 , 3); !!} {{$item->bahan->satuan}} @if(strtolower($item->bahan->satuan) != "kg") ( {!! Utils::decimal($item->jumlah_kg, 3) !!} KG ) @endif </td>
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