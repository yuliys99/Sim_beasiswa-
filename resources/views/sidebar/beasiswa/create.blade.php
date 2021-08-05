<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Data Beasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (auth()->user()->id_role == 2)
                    <form class="needs-validation" action="{{ route('akademik-beasiswa.store') }}"
                    method="POST" enctype="multipart/form-data">
                @elseif (auth()->user()->id_role == 3)
                    <form class="needs-validation" action="{{ route('beasiswa.store') }}"
                    method="POST" enctype="multipart/form-data">
                @endif
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="nama_beasiswa">Nama Beasiswa <a class="text-danger">*</a></label>
                                <div class="input-group">
                                    <input name="nama_beasiswa" type="text" class="form-control" placeholder="Nama Beasiswa" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tahun_perolehan">Tahun Perolehan <a class="text-danger">*</a></label>
                                <div class="input-group">
                                    <input name="tahun_perolehan" type="text" class="form-control" placeholder="Tahun Perolehan" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="min_ipk">Minimal IPK <a class="text-danger">*</a></label><p class="text-danger">Gunakan format dengan benar</p>
                                <div class="input-group">
                                    <input name="min_ipk" type="text" class="form-control" maxlength="4" placeholder="Ex : 3.55" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis">Jenis <a class="text-danger">*</a></label>
                                <div class="input-group">
                                    <input name="jenis" type="text" class="form-control" placeholder="Jenis"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kontrak_beasiswa">Kontrak Beasiswa <a class="text-danger">*</a></label>
                                <div class="input-group">
                                    <input type="text" name="kontrak_beasiswa" class="form-control" placeholder="Kontrak Beasiswa" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="persyaratan">Persyaratan</label>
                                <input type="file" class="form-control" name="persyaratan">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-success">Tambah</button>
                                <button type="button" class="btn btn-sm btn-secondary float-right"
                                    data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
