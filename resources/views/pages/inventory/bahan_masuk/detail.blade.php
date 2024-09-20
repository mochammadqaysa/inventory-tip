
@php
use App\Helpers\Utils;
@endphp
<table class="table table-borderless align-items-left table-flush table-header col-md-6">
    <tbody>
        <tr>
            <td>Supplier</td>
            <td>:</td>
            <th>{{ @$supplier->nama }} <span class="badge badge-default ml-2">{{ @$bahanMasuk->tipe }}</span></th>
        </tr>
        <tr>
            <td>Negara Asal</td>
            <td>:</td>
            <th>{{ @$supplier->negara }}</th>
        </tr>
        <tr>
            <td>Nomor Bukti</td>
            <td>:</td>
            <th>{{ @$bahanMasuk->nomor_bukti }}</th>
        </tr>
        <tr>
            <td>Tanggal Bukti</td>
            <td>:</td>
            <th>{{ @$bahanMasuk->tanggal_bukti }}</th>
        </tr>
        <tr>
            <td>Nomor PO</td>
            <td>:</td>
            <th>{{ @$bahanMasuk->nomor_po }}</th>
        </tr>
        @if (@$bahanMasuk->tipe == "impor")
            <tr>
                <td>Nomor PIB</td>
                <td>:</td>
                <th>{{ @$bahanMasuk->nomor_pib }}</th>
            </tr>
            <tr>
                <td>Tanggal PIB</td>
                <td>:</td>
                <th>{{ @$bahanMasuk->tanggal_pib }}</th>
            </tr>
            <tr>
                <td>Kurs</td>
                <td>:</td>
                <th>Rp. {!! Utils::decimal($bahanMasuk->kurs ?? 0 , 3); !!}</small></th>
            </tr>
        @endif
    </tbody>
</table>
<div class=" py-2 ">
    <table class="table display nowrap" style="width:100%" id="table-bahanmasuk-item">
        <thead>
            <tr>
                <th></th>
                @if (@$bahanMasuk->tipe == "impor")
                <th class="all">Kode HS</th>
                <th class="all">Nomor Seri</th>
                @endif
                <th class="all">Nomor Lot</th>
                <th class="all">Nama Bahan</th>
                <th class="{{ @$bahanMasuk->tipe == "impor" ? "none" : "all"}}">Jumlah</th>
                @if (@$bahanMasuk->tipe == "impor")
                <th class="none">Nilai</th>
                <th class="none">Nilai Total</th>
                <th class="none">Fasilitas</th>
                @endif
                <th class="{{ @$bahanMasuk->tipe == "impor" ? "none" : "all"}}">Penyimpanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bahanMasukItems as $item)
            <tr>
                <td></td>
                @if (@$bahanMasuk->tipe == "impor")
                <td>{{ $item->kode_hs }}</td>
                <td>{{ $item->nomor_seri }}</td>
                @endif
                <td>{{ $item->nomor_lot }}</td>
                <td>{{ $item->bahan->nama }}</td>
                <td>{!! Utils::decimal($item->jumlah_kg ?? 0 , 3); !!} {{$item->bahan->satuan}}</td>
                @if (@$bahanMasuk->tipe == "impor")
                <td>{{ $item->mata_uang }} {!! Utils::decimal($item->nilai ?? 0 , 2); !!}</td>
                <td>IDR {!! Utils::decimal($item->nilai_total ?? 0, 2) !!}</td>
                <td>{{ $item->fasilitas == 1 ? "Ya" : "Tidak" }} </td>
                @endif
                <td>{{ $item->gudang->nama}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(() => {
        let table = $("#table-bahanmasuk-item").DataTable({
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