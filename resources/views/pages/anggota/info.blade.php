<div class="modal fade" tabindex="-1" role="dialog" id="infoModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Info Data Anggota</h5>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">Nama Lengkap</dt>
                        <dd class="col-sm-7" id="tampilNama"></dd>

                        <dt class="col-sm-5">Nomor Telepon</dt>
                        <dd class="col-sm-7" id="tampilTelepon"></dd>

                        <dt class="col-sm-5">Jabatan</dt>
                        <dd class="col-sm-7" id="tampilJabatan"></dd>

                        <dt class="col-sm-5">Jenis Kelamin</dt>
                        <dd class="col-sm-7" id="tampilJenisKelamin"></dd>

                        <dt class="col-sm-5">Tempat, Tanggal Lahir</dt>
                        <dd class="col-sm-7" id="tampilTTL"></dd>

                        <dt class="col-sm-5">Alamat</dt>
                        <dd class="col-sm-7" id="tampilAlamat"></dd>

                        <dt class="col-sm-5">Keahlian</dt>
                        <dd class="col-sm-7" id="tampilKeahlian"></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="{{ asset('assets/modules/jquery.min.js') }}"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentId = null;

        $('.info-btn').on('click', function() {
            currentId = $(this).data('id');

            $.get(`/anggota/${currentId}`, function(data) {
                $('#tampilNama').text(data.nama || '-');
                $('#tampilTelepon').text(data.nomor_telepon || '-');
                // $('#tampilJabatan').text(data.jabatan || '-');
                // $('#tampilDepartemen').text(data.departemen || '-');
                const jabatan = data.jabatan || '-';
                const departemen = data.departemen || '-';

                if (jabatan === 'Koordinator' || jabatan === 'Anggota') {
                    $('#tampilJabatan').text(`${jabatan} - Departemen ${departemen}`);
                } else {
                    $('#tampilJabatan').text(jabatan);
                }

                // $('#tampilJabatan').text(jabatan);

                $('#tampilJenisKelamin').text(data.jenis_kelamin || '-');
                $('#tampilTTL').text(
                    `${data.tempat_lahir || '-'}, ${formatTanggal(data.tanggal_lahir)}`);
                $('#tampilAlamat').text(data.alamat || '-');
                $('#tampilKeahlian').text(data.keahlian || '-');
                $('#infoModal').modal('show');
            });
        });

        // Reset ID saat modal ditutup
        $('#infoModal').on('hidden.bs.modal', function() {
            currentId = null;

            // Optional: Kosongkan semua isi modal
            $('#tampilNama').text('-');
            $('#tampilTelepon').text('-');
            $('#tampilJabatan').text('-');
            $('#tampilDepartemen').text('-');
            $('#tampilJenisKelamin').text('-');
            $('#tampilTTL').text('-');
            $('#tampilAlamat').text('-');
            $('#tampilKeahlian').text('-');
        });

        function formatTanggal(tanggal) {
            if (!tanggal) return '-';
            const date = new Date(tanggal);
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return date.toLocaleDateString('id-ID', options); // contoh output: 18 April 2001
        }


    });
</script>
