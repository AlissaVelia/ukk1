
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
                                    <h1>Form Validation States</h1>
                <form role="form" action="<?php echo base_url();?>index.php/surat_masuk/ubah_file/<?php echo $this->uri->segment(3)?>" method="post" enctype="multipart/form-data" >
           
                  <div class="form-group">
                         <label class="control-label" >Surat *pdf</label>
                         <input type="file" name="file_surat" class="form-control" >
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