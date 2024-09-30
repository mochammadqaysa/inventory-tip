
@php
use App\Helpers\Utils;
@endphp
<div class="row">
  <table class="table table-borderless align-items-left table-flush table-header col-md-6">
      <tbody>
          <tr>
              <td>Customer</td>
              <td>:</td>
              <th>{{ $wasteKeluar->customer->nama }}</th>
          </tr>
          <tr>
              <td>Nomor Invoice</td>
              <td>:</td>
              <th>{{ $wasteKeluar->nomor_invoice }}</th>
          </tr>
          <tr>
              <td>Tanggal Invoice</td>
              <td>:</td>
              <th>{{ $wasteKeluar->tanggal_invoice }}</th>
          </tr>
      </tbody>
  </table>
  <table class="table table-borderless align-items-left table-flush table-header col-md-6">
    <tbody>
        <tr>
            <td>Nomor SPPB</td>
            <td>:</td>
            <th>{{ $wasteKeluar->nomor_sppb }}</th>
        </tr>
        <tr>
            <td>Tanggal SPPB</td>
            <td>:</td>
            <th>{{ $wasteKeluar->tanggal_sppb }}</th>
        </tr>
        <tr>
            <td>Nilai</td>
            <td>:</td>
            <th>{{ $wasteKeluar->nilai }}</th>
        </tr>
    </tbody>
  </table>
</div>
<hr>
<div class="py-2">
<h5>Informasi Item</h5>
    <div class="row" id="list-items">
      @foreach($wasteKeluarItems as $key => $item)
      <div class="card shadow col-md-6">
        <div class="card-body">
          <h4>Data {{ $key+1 }}</h4>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive py-2">
                <table class="table align-items-center table-flush table-header" style="width: 100% !important;">
                  <tbody>
                    <tr>
                      <td>Jenis Waste</td>
                      <td> : </td>
                      <td> {{ $item->jenis }} </td>
                    </tr>
                    <tr>
                      <td>Waste</td>
                      <td> : </td>
                      <td>{{ $item->waste->nama }}</td>
                    </tr>
                    <tr>
                      <td>Nomor PIB</td>
                      <td> : </td>
                      <td>{{ $item->nomor_pib }}</td>
                    </tr>
                    <tr>
                      <td>Qty</td>
                      <td> : </td>
                      <td>{{ $item->qty }}</td>
                    </tr>
                  </tbody>
                </table>

                <table class="table table-bordered table-info table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Nomor Packing</th>
                            <th>Jumlah (KGM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor_packing = explode(',',$item->nomor_packing);
                            $jumlah_kgm = explode(',',$item->jumlah);
                        @endphp
                        @foreach($nomor_packing as $i => $packing)
                        <tr>
                          <td>{{ $packing }}</td>
                          <td>{{ $jumlah_kgm[$i] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      
    </div>
</div>

<script>
</script>