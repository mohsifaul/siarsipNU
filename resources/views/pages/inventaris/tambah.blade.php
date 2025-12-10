@extends('main')
@section('title')
    Tambah Barang Inventaris | IPNU IPPNU
@endsection
@section('main-content')
    <div class="section-header">
        <h1>Tambah Barang Inventaris</h1>
    </div>
    <div class="card">
        <form id="inventarisForm" class="needs-validation" novalidate="" action="{{ route('inventaris.simpan') }}"
            method="POST">
            @csrf
            <div class="card-header">
                <h4>Tambah Barang Inventaris</h4>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" required=""
                            placeholder="Masukkan Nama Barang">
                        <div class="invalid-feedback">
                            What's the name of the item?
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori" required="">
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Perlengkapan Organisasi">Perlengkapan Organisasi</option>
                            <option value="Furnitur">Furnitur</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a category.
                        </div>
                    </div>
                </div>

                <!-- Baris Jumlah, Satuan, Kondisi, Penanggung Jawab -->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" required="" value="1">
                        <div class="invalid-feedback">
                            How many items?
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Satuan</label>
                        <select class="form-control" name="satuan" required="">
                            <option value="" selected disabled>Pilih Satuan</option>
                            <option value="Unit">Unit</option>
                            <option value="Buah">Pcs</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a unit.
                        </div>
                    </div>

                    <!-- Kondisi Umum (Radio Button) -->
                    <div class="form-group col-md-3" id="kondisiUmumContainer">
                        <label>Kondisi</label>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="kondisi" value="Baik" class="selectgroup-input" required>
                                <span class="selectgroup-button">Baik</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kondisi" value="Perlu Perbaikan" class="selectgroup-input">
                                <span class="selectgroup-button">Perbaikan</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input">
                                <span class="selectgroup-button">Rusak</span>
                            </label>
                        </div>
                        <div class="invalid-feedback">
                            Please select the condition.
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Penanggung Jawab</label>
                        <input type="text" class="form-control" name="penanggung_jawab" required=""
                            placeholder="Masukkan Penanggung Jawab">
                        <div class="invalid-feedback">
                            Who is responsible for this item?
                        </div>
                    </div>
                </div>

                <!-- Container untuk jumlah per kondisi -->
                <div class="form-row mt-3" id="kondisiJumlahContainer" style="display: none;">
                    <div class="form-group col-md-12">
                        <label>Jumlah Berdasarkan Kondisi</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text font-weight-bolder">Baik</span>
                                    <input type="number" class="form-control jumlah-kondisi" name="jumlah_baik"
                                        min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text font-weight-bolder">Perlu Perbaikan</span>
                                    <input type="number" class="form-control jumlah-kondisi" name="jumlah_perbaikan"
                                        min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text font-weight-bolder">Rusak</span>
                                    <input type="number" class="form-control jumlah-kondisi" name="jumlah_rusak"
                                        min="0" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="text-danger" id="kondisiJumlahError" style="display: none;">
                            Total jumlah kondisi harus sama dengan jumlah barang.
                        </div>
                    </div>
                </div>
                <div class="text-danger" id="kondisiJumlahError" style="display: none;">
                    Total jumlah kondisi tidak boleh melebihi jumlah barang.
                </div>

                <!-- Keterangan -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" placeholder="Contoh : Bendera Sobek"></textarea>
                        <div class="invalid-feedback">
                            Any additional notes?
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('inventarisForm');
            const jumlahField = form.querySelector('[name="jumlah"]');
            const kondisiJumlahContainer = document.getElementById('kondisiJumlahContainer');
            const kondisiUmumContainer = document.getElementById('kondisiUmumContainer');
            const kondisiJumlahInputs = document.querySelectorAll('.jumlah-kondisi');
            const kondisiJumlahError = document.getElementById('kondisiJumlahError');

            // Fungsi toggle tampilan
            function toggleKondisiInput() {
                const jumlah = parseInt(jumlahField.value) || 0;

                if (jumlah > 1) {
                    kondisiJumlahContainer.style.display = 'block';
                    kondisiUmumContainer.style.display = 'none';
                    document.querySelectorAll('input[name="kondisi"]').forEach(radio => {
                        radio.removeAttribute('required');
                    });
                } else {
                    kondisiJumlahContainer.style.display = 'none';
                    kondisiUmumContainer.style.display = 'block';
                    document.querySelector('input[name="kondisi"]').setAttribute('required', 'required');
                    kondisiJumlahInputs.forEach(input => input.value = 0);
                }

                // Validasi real-time saat jumlah berubah
                validateKondisi();
            }

            // Validasi real-time saat input jumlah per kondisi berubah
            function validateKondisi() {
                const jumlah = parseInt(jumlahField.value) || 0;
                const totalKondisi = Array.from(kondisiJumlahInputs).reduce((sum, input) => {
                    return sum + (parseInt(input.value) || 0);
                }, 0);

                if (totalKondisi > jumlah) {
                    kondisiJumlahError.style.display = 'block';
                    kondisiJumlahError.textContent = 'Total jumlah kondisi tidak boleh melebihi jumlah barang.';
                } else {
                    kondisiJumlahError.style.display = 'none';
                }
            }

            // Jalankan saat halaman dimuat
            toggleKondisiInput();

            // Event listener
            jumlahField.addEventListener('input', toggleKondisiInput);
            kondisiJumlahInputs.forEach(input => {
                input.addEventListener('input', validateKondisi);
            });

            // Validasi saat submit
            form.addEventListener('submit', function(event) {
                const jumlah = parseInt(jumlahField.value) || 0;
                const totalKondisi = Array.from(kondisiJumlahInputs).reduce((sum, input) => {
                    return sum + (parseInt(input.value) || 0);
                }, 0);

                if (jumlah > 1 && totalKondisi > jumlah) {
                    kondisiJumlahError.style.display = 'block';
                    event.preventDefault();
                    event.stopPropagation();
                    return;
                }
            });
        });
    </script>
@endsection
