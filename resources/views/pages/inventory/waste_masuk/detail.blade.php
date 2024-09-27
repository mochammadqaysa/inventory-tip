
@php
use App\Helpers\Utils;
@endphp
<table class="table table-borderless align-items-left table-flush table-header col-md-6">
    <tbody>
        <tr>
            <td>Nomor Bukti</td>
            <td>:</td>
            <th>{{ @$wasteMasuk->nomor_bukti }}</th>
        </tr>
        <tr>
            <td>Tanggal Bukti</td>
            <td>:</td>
            <th>{{ @$wasteMasuk->tanggal_bukti }}</th>
        </tr>
    </tbody>
</table>
<div class=" py-2 ">
    <table class="table display nowrap" style="width:100%" id="table-wasteMasuk-item">
        <thead>
            <tr>
                <th></th>
                <th class="all">Nama Barang</th>
                <th class="all">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wasteMasukItems as $item)
            <tr>
                <td></td>
                <td>{{ $item->waste->nama }}</td>
                <td>{{ $item->jumlah }} KG </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(() => {
        let table = $("#table-wasteMasuk-item").DataTable({
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