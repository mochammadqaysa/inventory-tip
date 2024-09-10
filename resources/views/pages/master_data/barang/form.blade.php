<div class="row">
    <div class="form-group col-md-6">
        <label>Kode</label>
        <input type="text" name="kode" class="form-control" placeholder="Kode" value="{{ @$data->kode }}">
    </div>
    <div class="form-group col-md-6">
      <label>Satuan</label>
			<select class="form-control" name="satuan" id="select2-satuan">
        <option value="BAG" {{ @$data->satuan == 'BAG' ? 'selected' : '' }}>BAG</option>
        <option value="BALE" {{ @$data->satuan == 'BALE' ? 'selected' : '' }}>BALE</option>
        <option value="BOX" {{ @$data->satuan == 'BOX' ? 'selected' : '' }}>BOX</option>
        <option value="PCS" {{ @$data->satuan == 'PCS' ? 'selected' : '' }}>PCS</option>
        <option value="ROLL" {{ @$data->satuan == 'ROLL' ? 'selected' : '' }}>ROLL</option>
    </select>
      {{-- <input type="text" name="satuan" class="form-control" placeholder="Satuan" value="{{ @$data->satuan }}"> --}}
    </div>
    <div class="form-group col-md-12">
      <label>Nama Barang</label>
      <input type="text" name="nama" class="form-control" placeholder="Nama Barang" value="{{ @$data->nama }}">
    </div>

    <div class="form-group col-md-12">
        <label>Warna</label>
        <input type="text" name="warna" class="form-control" placeholder="Warna" value="{{ @$data->warna }}">
    </div>
		<div class="form-group col-md-4">
				<label>Panjang</label>
				<input type="number" name="panjang" class="form-control" placeholder="Panjang" value="{{ @$data->panjang }}">
		</div>
		<div class="form-group col-md-4">
				<label>Lebar</label>
				<input type="number" name="lebar" class="form-control" placeholder="Lebar" value="{{ @$data->lebar }}">
		</div>
	<div class="form-group col-md-4">
			<label>Tebal</label>
			<input type="number" step=".01" name="tebal" id="tebal" class="form-control" placeholder="Tebal" value="{{ @$data->tebal }}">
	</div>
    
</div>
  
<script>
	$(() => {
		$('#select2-satuan').select2({
      placeholder: 'Choose One',
    });

		$('#tebal').on('blur', function() {
				let value = parseFloat($(this).val());

				// If the input value is a whole number, append '.00'
				if (!isNaN(value) && value % 1 === 0) {
						$(this).val(value.toFixed(2)); // Adds .00 if it's a whole number
				}
		});
	})
</script>