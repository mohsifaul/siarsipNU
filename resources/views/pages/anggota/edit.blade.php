    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Anggota</h5>
                </div>
                <!-- Form inside modal -->
                <form id="anggotaForm" class="needs-validation" novalidate method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" required="">
                                    <input type="hidden" class="form-control" name="id" required="">
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
                                        <option value="Seni Budaya dan Olahraga">Departemen Seni Budaya dan Olahraga
                                        </option>
                                        <option value="Dakwah">Departemen Dakwah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="laki_laki" value="Laki-laki" required="">
                                        <label class="form-check-label" for="laki_laki">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="perempuan" value="Perempuan" required="">
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
                                    <input type="date" class="form-control datepicker" name="tanggal_lahir"
                                        required="">
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
                        <div class="modal-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all edit buttons and add event listeners
            const editButtons = document.querySelectorAll('.edit-btn');
            // Loop through each edit button
            editButtons.forEach(function(editButton) {
                editButton.addEventListener('click', function() {
                    // Retrieve data attributes from the clicked button
                    const id = editButton.getAttribute('data-id');
                    const nama = editButton.getAttribute('data-nama');
                    let telepon = editButton.getAttribute('data-telepon');
                    const jabatan = editButton.getAttribute('data-jabatan');
                    const departemen = editButton.getAttribute('data-departemen');
                    const jenis_kelamin = editButton.getAttribute('data-jenis_kelamin');
                    const tempat_lahir = editButton.getAttribute('data-tempat_lahir');
                    const tanggal_lahir = editButton.getAttribute('data-tanggal_lahir');
                    const alamat = editButton.getAttribute('data-alamat');
                    const keahlian = editButton.getAttribute('data-keahlian');

                    console.log(id);
                    telepon = telepon.replace(/^0/, '');
                    // Populate the modal fields with the retrieved values
                    document.querySelector('#editModal #anggotaForm [name="id"]').value = id;
                    document.querySelector('#editModal #anggotaForm [name="nama"]').value = nama;
                    document.querySelector('#editModal #anggotaForm [name="nomor_telepon"]').value =
                        telepon;
                    document.querySelector('#editModal #anggotaForm [name="jabatan"]').value =
                        jabatan;
                    document.querySelector('#editModal #anggotaForm [name="departemen"]').value =
                        departemen;

                    // Set the radio button for jenis_kelamin
                    document.querySelector(
                        `#editModal #anggotaForm [name="jenis_kelamin"][value="${jenis_kelamin}"]`
                    ).checked = true;

                    document.querySelector('#editModal #anggotaForm [name="tempat_lahir"]').value =
                        tempat_lahir;
                    document.querySelector('#editModal #anggotaForm [name="tanggal_lahir"]').value =
                        tanggal_lahir;
                    document.querySelector('#editModal #anggotaForm [name="alamat"]').value =
                        alamat;
                    document.querySelector('#editModal #anggotaForm [name="keahlian"]').value =
                        keahlian;

                    // Show or hide the 'departemen' group based on the 'jabatan' value
                    const jabatanSelect = document.getElementById('jabatan');
                    const jabatanGroup = document.getElementById('jabatan-group');
                    const departemenGroup = document.getElementById('departemen-group');
                    if (jabatan === 'Koordinator' || jabatan === 'Anggota') {
                        jabatanGroup.classList.remove('col-md-12');
                        jabatanGroup.classList.add('col-md-6');
                        departemenGroup.style.display = 'block';
                    } else {
                        jabatanGroup.classList.remove('col-md-6');
                        jabatanGroup.classList.add('col-md-12');
                        departemenGroup.style.display = 'none';
                    }
                    jabatanSelect.addEventListener('change', function() {
                        const selectedValue = this.value;
                        if (selectedValue === 'Koordinator' || selectedValue ===
                            'Anggota') {
                            jabatanGroup.classList.remove('col-md-12');
                            jabatanGroup.classList.add('col-md-6');
                            departemenGroup.style.display = 'block';
                        } else {
                            jabatanGroup.classList.remove('col-md-6');
                            jabatanGroup.classList.add('col-md-12');
                            departemenGroup.style.display = 'none';
                        }
                    });
                });
            });

            const anggotaForm = document.getElementById('anggotaForm');

            if (localStorage.getItem('updateSuccess')) {
                // Tampilkan SweetAlert
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil diperbarui!',
                    icon: 'success',
                    // timer: 2000, // Auto close dalam 2 detik
                    showConfirmButton: true
                });

                // Hapus status dari localStorage setelah ditampilkan
                localStorage.removeItem('updateSuccess');
            }
            anggotaForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form submit secara default

                const formData = new FormData(this);
                const id = formData.get('id'); // Pastikan input ID ada di form

                const url = `/anggota/edit/${id}`; // Perbaiki URL agar sesuai dengan route

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan CSRF dikirim dengan benar
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // alert('Data berhasil diperbarui!');
                            localStorage.setItem('updateSuccess', 'true');
                            $('#editModal').modal('hide');
                            location.reload(); // Reload halaman untuk melihat perubahan
                            // Swal.fire({
                            //     title: 'Berhasil!',
                            //     text: 'Data berhasil diperbarui!',
                            //     icon: 'success',
                            //     // timer: 2000, // Auto close dalam 2 detik
                            //     showConfirmButton: true
                            // });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Data gagal diperbarui!',
                                icon: 'error',
                                // timer: 2000, // Auto close dalam 2 detik
                                showConfirmButton: true
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan pada server.');
                    });
            });
        });
    </script>
