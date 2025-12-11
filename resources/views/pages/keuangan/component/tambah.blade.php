<!-- Modal Tambah Transaksi -->
<div class="modal fade" id="tambahTransaksi" tabindex="-1" aria-labelledby="tambahTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTransaksiLabel">Tambah Transaksi Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('keuangan.store') }}" method="POST" id="formKeuangan">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required
                            value="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Contoh: Iuran anggota, Sewa aula" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis Transaksi</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            {{-- <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username"> --}}
                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1"
                                placeholder="Masukkan nominal" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#formKeuangan').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{ route('keuangan.store') }}",
            data: formData,
            contentType: false,
            processData: false
        });
    });
</script>
