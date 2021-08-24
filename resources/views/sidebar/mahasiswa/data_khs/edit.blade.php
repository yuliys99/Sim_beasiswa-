    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" class="needs-validation" novalidate="" id="editForm"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <div class="input-group">
                                <input name="semester" id="semester" type="number" class="form-control" placeholder="Semester"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ipk">Nilai IPK</label>
                            <div class="input-group">
                                <input type="text" name="ipk" id="ipk" class="form-control"
                                    placeholder="Nilai IPK" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foto_khs">Foto KHS</label>
                            <div class="input-group">
                                <input name="foto_khs" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Edit</button>
                            <button type="button" class="btn btn-secondary float-right"
                                data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
