<div class="row mb-2">

    <!-- Proker Mendatang -->
    <div class="col-lg-4">
        <div class="card card-info">
            <div class="card-header mb-1" style="min-height: 1px; padding: 10px 20px;">
                <h4 class="text-black">Proker Mendatang ({{ count($prokersMendatang) }})</h4>
            </div>
            <div class="card-body">
                @php
                    $today = \Carbon\Carbon::today();
                    $showMendatang = collect($prokersMendatang)
                        ->filter(function($item) use ($today) {
                            return \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->gte($today);
                        })
                        ->sortBy(function($item) {
                            return \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->timestamp;
                        })
                        ->take(3);
                @endphp

                <ul class="list-unstyled mb-0">
                    @if ($showMendatang->isEmpty())
                        <li class="d-flex align-items-center py-1">
                            <small class="text-muted">Tidak ada program kerja mendatang</small>
                        </li>
                    @else
                        @foreach ($showMendatang as $item)
                            <li class="d-flex justify-content-between align-items-center border-bottom py-1">
                                <div>
                                    <i class="fas fa-calendar-alt text-info mr-1"></i>
                                    <strong>{{ $item->nama_program }}</strong>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted mr-2">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l, d F Y') }}
                                    </small>
                                    <a href="#" title="Tandai Selesai" class="text-success" data-id="{{ $item->id }}"
                                        data-confirm="Konfirmasi|Ingin menyelesaikan program kerja ini?"
                                        data-confirm-yes="handleTerlaksana">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                    <a href="#" class="text-warning ml-2" data-id="{{ $item->id }}"
                                        data-confirm="Konfirmasi|Ingin membatalkan program kerja ini?"
                                        data-confirm-yes="handleBelumTerlaksana" title="Tandai Belum Terlaksana">
                                        <i class="fas fa-undo-alt"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Proker Selesai -->
    <div class="col-lg-4">
        <div class="card card-success">
            <div class="card-header" style="min-height: 1px; padding: 10px 20px;">
                <h4 class="text-black">Proker Selesai ({{ count($prokersSelesai) }})</h4>
            </div>
            <div class="card-body">
                @php
                    $showSelesai = collect($prokersSelesai)
                        ->sortByDesc(function($item) {
                            return \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->timestamp;
                        })
                        ->take(3);
                @endphp

                <ul class="list-unstyled mb-0">
                    @if ($showSelesai->isEmpty())
                        <li class="d-flex align-items-center py-1">
                            <small class="text-muted">Tidak ada program kerja selesai</small>
                        </li>
                    @else
                        @foreach ($showSelesai as $item)
                            <li class="d-flex justify-content-between align-items-center border-bottom py-1">
                                <div>
                                    <i class="fas fa-check-circle text-success mr-1"></i>
                                    <strong>{{ $item->nama_program }}</strong>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted mr-2">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l, d F Y') }}
                                    </small>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Proker Belum Terlaksana -->
    <div class="col-lg-4">
        <div class="card card-danger">
            <div class="card-header" style="min-height: 1px; padding: 10px 20px;">
                <h4 class="text-black">Tidak Terlaksana ({{ count($prokersBelumTerlaksana) }})</h4>
            </div>
            <div class="card-body">
                @php
                    $today = \Carbon\Carbon::today();
                    $showBelum = collect($prokersBelumTerlaksana)
                        ->sortBy(function($item) use ($today) {
                            return \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->diffInDays($today);
                        })
                        ->take(3);
                @endphp

                <ul class="list-unstyled mb-0">
                    @if ($showBelum->isEmpty())
                        <li class="d-flex align-items-center py-1">
                            <small class="text-muted">Tidak ada program kerja</small>
                        </li>
                    @else
                        @foreach ($showBelum as $item)
                            <li class="d-flex justify-content-between align-items-center border-bottom py-1">
                                <div>
                                    <i class="fas fa-times-circle text-danger mr-1"></i>
                                    <strong>{{ $item->nama_program }}</strong>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted mr-2">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l, d F Y') }}
                                    </small>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

</div>

<script>
    function ubahStatusBelumTerlaksana(id) {
        fetch(`/proker/${id}/belum-terlaksana`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                location.reload();
            })
            .catch(err => {
                console.error('Gagal mengubah status:', err);
            });
    }

    function ubahStatusTerlaksana(id) {
        fetch(`/proker/${id}/terlaksana`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                location.reload();
            })
            .catch(err => {
                console.error('Gagal mengubah status:', err);
            });
    }
</script>
