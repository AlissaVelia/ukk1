

                   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Forms</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php 
                    $notif = $this->session->flashdata('notif');
                    if($notif != NULL){
                        echo '
                            <div class="alert alert-info">'.$notif.'</div>
                        ';
                    }
                ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                <form role="form" action="<?php echo base_url();?>index.php/surat_keluar/tambah_surat" method="post" enctype="multipart/form-data">
                <div class="form-group has-success">
                         <label class="control-label" for="inputSuccess">No_surat</label>
                         <input type="text" class="form-control" id="inputSuccess" name="no_surat">
                  </div>
                <div class="form-group has-warning">
                        <label class="control-label" for="inputWarning">Tanggal Kirim</label>
                        <input type="date" class="form-control" id="inputWarning" name="tgl_kirim">
                 </div>
                <div class="form-group has-warning">
                        <label class="control-label" for="inputWarning">Tujuan</label>
                        <input type="text" class="form-control" id="inputWarning" name="penerima">
                 </div>
                <div class="form-group has-error">
                        <label class="control-label" for="inputError">Perihal</label>
                        <input type="text" class="form-control" id="inputError" name="perihal">
                 </div>
                  <div class="form-group has-success">
                         <label class="control-label" for="inputSuccess">Kategori</label>
                         <input type="text" class="form-control" id="inputSuccess" name="kategori_surat" value="surat keluar">
                  </div>
                <div class="form-group has-warning">
                        <label class="control-label" for="inputWarning">File PDF</label>
                        <input type="file" class="form-control" id="inputWarning" name="file_surat">
                 </div>
               
                 <div>
                     <input type="submit" name="submit" class="btn btn-primary"> 
                 </div>
                  </form>


                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>