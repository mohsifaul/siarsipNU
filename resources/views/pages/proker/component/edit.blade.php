<div class="modal fade" tabindex="-1" role="dialog" id="editProker">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Program Kerja</h5>
            </div>
            <form id="prokerForm" class="needs-validation" novalidate method="POST" action="{{ route('proker.update') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <input type="hidden" name="id" />

                        <div class="form-group">
                            <label>Nama Program Kerja</label>
                            <input type="text" class="form-control" name="nama_program" required>
                            <div class="invalid-feedback">Nama program wajib diisi.</div>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                            <div class="invalid-feedback">Deskripsi wajib diisi.</div>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control" name="tanggal_pelaksanaan" required>
                            <div class="invalid-feedback">Tanggal pelaksanaan wajib diisi.</div>
                        </div>

                        <div class="form-group">
                            <label>Tempat Pelaksanaan</label>
                            <input type="text" class="form-control" name="tempat" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Penanggung Jawab</label>
                                <input type="text" class="form-control" name="penanggung_jawab" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Divisi</label>
                                <select class="form-control" name="divisi" required>
                                    <option value="" selected disabled>Pilih Divisi</option>
                                    <option value="Organisasi">Organisasi</option>
                                    <option value="Kaderisasi">Kaderisasi</option>
                                    <option value="Seni Budaya dan Olahraga">Seni Budaya dan Olahraga</option>
                                    <option value="Dakwah">Dakwah</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Anggaran Biaya (Rp)</label>
                            <input type="number" class="form-control" name="anggaran" required>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" required>
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="Mendatang">Perencanaan</option>
                                <option value="Belum Terlaksana">Tidak Terlaksana</option>
                                <option value="Terlaksana">Selesai</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Upload Proposal (PDF)</label>
                            <input type="file" class="form-control-file" name="file_proposal"
                                accept="application/pdf">
                        </div>

                        <div class="form-group">
                            <label>Upload File Kepanitiaan (PDF)</label>
                            <input type="file" class="form-control-file" name="file_kepanitiaan"
                                accept="application/pdf">
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
