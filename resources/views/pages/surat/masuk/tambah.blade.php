@extends('main')
@section('title')
    Tambah Surat Masuk | IPNU IPPNU
@endsection
@section('main-content')
    <style>
        .card-body {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        #suratMasukForm {
            flex: 1;
            margin-right: 20px;
        }

        #preview-image {
            max-width: 100%;
            max-height: 300px;
            display: none;
        }
    </style>
    <div class="section-header">
        <h1>Tambah Surat Masuk</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Tambah Surat Masuk</h4>
        </div>
        <div class="card-body d-flex justify-content-between">
            <form id="suratMasukForm" class="needs-validation" novalidate="" action="{{ route('surat.store') }}" method="POST"
                enctype="multipart/form-data" style="flex: 1; margin-right: 20px;">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nomor Surat</label>
                        <input type="text" class="form-control" name="nomor_surat" required="">
                        <div class="invalid-feedback">
                            Please enter the letter number.
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tanggal Surat</label>
                        <input type="date" class="form-control" name="tanggal_surat" required="">
                        <div class="invalid-feedback">
                            Please select the letter date.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Pengirim</label>
                        <input type="text" class="form-control" name="pengirim" required="">
                        <div class="invalid-feedback">
                            Please enter the sender's name.
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Perihal</label>
                        <input type="text" class="form-control" name="perihal" required="">
                        <div class="invalid-feedback">
                            Please enter the subject of the letter.
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Lampiran (Optional)</label>
                    <input type="file" class="form-control" name="lampiran" accept=".jpg,.png,.pdf,.doc,.docx"
                        id="lampiran">
                    <div class="invalid-feedback">
                        Please upload a valid attachment.
                    </div>
                </div>
                <input type="hidden" class="form-control" name="type" required="" value="masuk">
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

            <!-- Tempat untuk pratinjau gambar dengan label Preview di atasnya -->
            <div class="d-flex flex-column align-items-start" style="flex: 0 0 300px;">
                <h5>Preview</h5>
                <img id="preview-image" src="{{asset('/assets/img/example-image.jpg')}}" alt="Preview" style="max-width: 100%; max-height: 100%; display: block;" />
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('suratMasukForm');
            const lampiranInput = document.getElementById('lampiran');
            const previewImage = document.getElementById('preview-image');

            lampiranInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block'; // Tampilkan gambar
                    }
                    reader.readAsDataURL(file);
                } else {
                    previewImage.src = "{{asset('/assets/img/example-image.jpg')}}";
                    previewImage.style.display = 'block'; // Sembunyikan jika bukan gambar
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
