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
            <td>Nomor PO</td>
            <td>:</td>
            <th>{{ @$bahanMasuk->nomor_po }}</th>
        </tr>
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
    </tbody>
</table>
<div class=" py-2 ">
    <table class="table display nowrap" style="width:100%" id="table-bahanmasuk-item">
        <thead>
            <tr>
                <th></th>
                <th class="all">Kode HS</th>
                <th class="all">Nomor Seri</th>
                <th class="all">Nomor Lot</th>
                <th class="all">Nama Bahan</th>
                <th class="none">Jumlah</th>
                <th class="none">Nilai Total</th>
                <th class="none">Fasilitas</th>
                <th class="none">Penyimpanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bahanMasukItems as $item)
            <tr>
                <td></td>
                <td>{{ $item->kode_hs }}</td>
                <td>{{ $item->nomor_seri }}</td>
                <td>{{ $item->nomor_lot }}</td>
                <td>{{ $item->bahan->nama }}</td>
                <td>{{ $item->jumlah_kg }} {{$item->bahan->satuan}}</td>
                <td>{{ $item->nilai_total }}</td>
                <td>{{ $item->fasilitas == 1 ? "Ya" : "Tidak" }} </td>
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