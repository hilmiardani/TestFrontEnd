 <div class="modal fade bs-modal-md modal-edit-siswa-status" id="modalEditStatus" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Status</h4>
            </div>
            <form class="form-horizontal form-edit-siswa-status" action="ajax-siswa.html" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select required style="width: 100%;" class="select2-nosearch dropdown-status" name="form[is_active]">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="hidden-idupdate" name="form[id_update]" value="">                    
                    <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-primary ladda-button ladda-button-submit" data-style="slide-up">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>