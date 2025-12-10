@extends('main')
@section('title')
    Tambah Anggota | IPNU IPPNU
@endsection
@section('main-content')
    <div class="section-header">
        <h1>Tambah Anggota</h1>
    </div>
    <div class="card">
        <form id="anggotaForm" class="needs-validation" novalidate="" action="{{ route('anggota.simpan') }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>Tambah Anggota</h4>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" required="">
                        <div class="invalid-feedback">
                            What's your name?
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Nomor Telepon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <strong>+ 62</strong>
                                </div>
                            </div>
                            <input type="text" class="form-control phone-number" name="nomor_telepon">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12" id="jabatan-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan" id="jabatan" required="">
                            <option value="" selected disabled>Pilih Jabatan</option>
                            <option value="Ketua">Ketua</option>
                            <option value="Wakil Ketua">Wakil Ketua</option>
                            <option value="Sekretaris">Sekretaris</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Koordinator">Koordinator</option>
                            <option value="Anggota">Anggota</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a position.
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="departemen-group" style="display: none;">
                        <label>Departemen</label>
                        <select class="form-control" name="departemen">
                            <option value="" selected disabled>Pilih Departemen</option>
                            <option value="Organisasi">Departemen Organisasi</option>
                            <option value="Kaderisasi">Departemen Kaderisasi</option>
                            <option value="Seni Budaya dan Olahraga">Departemen Seni Budaya dan Olahraga</option>
                            <option value="Dakwah">Departemen Dakwah</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki"
                                value="Laki-laki" required="">
                            <label class="form-check-label" for="laki_laki">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                value="Perempuan" required="">
                            <label class="form-check-label" for="perempuan">
                                Perempuan
                            </label>
                        </div>
                        <div class="invalid-feedback">
                            Please select a gender.
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" required="">
                        <div class="invalid-feedback">
                            Where were you born?
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control datepicker" name="tanggal_lahir" required="">
                        <div class="invalid-feedback">
                            When were you born?
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat" required=""></textarea>
                    <div class="invalid-feedback">
                        What's your address?
                    </div>
                </div>
                <div class="form-group">
                    <label>Keahlian</label>
                    <textarea class="form-control" name="keahlian" required=""></textarea>
                    <div class="invalid-feedback">
                        What are your skills?
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
            const jabatanSelect = document.getElementById('jabatan');
            const jabatanGroup = document.getElementById('jabatan-group');
            const departemenGroup = document.getElementById('departemen-group');
            const form = document.getElementById('anggotaForm');

            jabatanSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                if (selectedValue === 'Koordinator' || selectedValue === 'Anggota') {
                    jabatanGroup.classList.remove('col-md-12');
                    jabatanGroup.classList.add('col-md-6');
                    departemenGroup.style.display = 'block';
                } else {
                    jabatanGroup.classList.remove('col-md-6');
                    jabatanGroup.classList.add('col-md-12');
                    departemenGroup.style.display = 'none';
                }
            });

            form.addEventListener('submit', function(event) {
                // Basic validation
                const requiredFields = form.querySelectorAll('[required]');
                let allFilled = true;

                requiredFields.forEach(function(field) {
                    if (!field.value) {
                        allFilled = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                        field.classList.add('is-valid');
                    }
                });

                if (!allFilled) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });
        });
    </script>
@endsection
