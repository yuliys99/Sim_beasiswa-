<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form class="needs-validation" action="{{ route('datakhs-mahasiswa.store') }}"
                    method="POST" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="semester">Semester <a class="text-danger">*</a></label>
                                <div class="input-group">
                                    <input name="semester" type="number" class="form-control" placeholder="Semester" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ipk">Nilai IPK <a class="text-danger">*</a></label>
                                <div class="input-group">
                                    <input name="ipk" type="text" class="form-control" placeholder="Nilai IPK" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto_khs">Foto KHS</label>
                                <input type="file" class="form-control" name="foto_khs">
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
