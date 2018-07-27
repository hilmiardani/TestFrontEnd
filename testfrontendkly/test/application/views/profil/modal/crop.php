<div class="modal fade modal-crop-image" data-backdrop="static" data-keyboard="false" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <a role="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></a>
                        <h4 class="modal-title">The Title</h4>
                    </div>
                    <form id="FrmCropImage" role="form">
                        <div class="modal-body">
                            <div class="form-group crop-layout text-center">
                                <img src="<?php echo base_url("assets/img/default.png"); ?>" alt="Image Crop and Resize" style="width:auto;height:400px;">
                            </div>
                            <div class="crop-action text-center">
                                <a role="button" class="btn btn-danger" data-crop-method="zoom" data-crop-value="0.1" title="Perkecil"><i class="fa fa-search-plus"></i></a>
                                <a role="button" class="btn btn-danger" data-crop-method="zoom" data-crop-value="-0.1" title="Perbesar"><i class="fa fa-search-minus"></i></a>
                                <div class="btn-group">
                                    <a role="button" class="btn btn-danger" data-crop-method="move" data-crop-value="-10" data-crop-second-value="0" title="Geser Kiri"><i class="fa fa-arrow-left"></i></a>
                                    <a role="button" class="btn btn-danger" data-crop-method="move" data-crop-value="10" data-crop-second-value="0" title="Geser Kanan"><i class="fa fa-arrow-right"></i></a>
                                    <a role="button" class="btn btn-danger" data-crop-method="move" data-crop-value="0" data-crop-second-value="-10" title="Geser Atas"><i class="fa fa-arrow-up"></i></a>
                                    <a role="button" class="btn btn-danger" data-crop-method="move" data-crop-value="0" data-crop-second-value="10" title="Geser Bawah"><i class="fa fa-arrow-down"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a role="button" class="btn btn-danger" data-crop-method="rotate" data-crop-value="-90" title="Putar Kiri 90"><i class="fa fa-undo"></i></a>
                                    <a role="button" class="btn btn-danger" data-crop-method="rotate" data-crop-value="90" title="Putar Kanan 90"><i class="fa fa-repeat"></i></a>
                                </div>
                                <div class="btn-group hidden-sm hidden-xs">
                                    <a role="button" class="btn btn-danger" data-crop-method="scaleX" data-crop-value="-1" title="Perlebar"><i class="fa fa-arrows-h"></i></a>
                                    <a role="button" class="btn btn-danger" data-crop-method="scaleY" data-crop-value="-1" title="Pertinggi"><i class="fa fa-arrows-v"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a hre="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                            <button type="submit" class="btn btn-primary ladda-button ladda-button-submit" data-style="slide-up">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>