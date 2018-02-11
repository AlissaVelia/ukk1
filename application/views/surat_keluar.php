 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">SURAT KELUAR</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="<?php echo base_url();?>index.php/surat_keluar/v_tambah_surat" class="btn btn-primary" class="fa fa-carret"> TAMBAH SURAT</a>
                            <br> <br>
                
                <?php 
                    $notif = $this->session->flashdata('notif');
                    if($notif != NULL){
                        echo '
                            <div class="alert alert-info">'.$notif.'</div>
                        ';
                    }
                ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Tujuan</th>
                                        <th>Perihal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;?>
                                    <?php foreach($list as $row):?>
                                    <tr>
                                       <td><?php echo $no?></td> 
                                       <td><?php echo $row->no_surat?></td>
                                       <td><?php echo $row->tgl_kirim?></td>
                                       <td><?php echo $row->penerima?></td>
                                       <td><?php echo $row->perihal?></td>
                                       
                                       <td>
                                           <a href="<?php echo base_url();?>/uploads/<?php echo $row->file_surat;?>" target="_blank" class="btn btn-primary"> Lihat </a>
                                                <a href="<?php echo base_url();?>index.php/surat_keluar/lihat_surat_keluar/<?php echo $row->id_surat;?>" class="btn btn-info"> Ubah Surat </a>
                                                <a href="<?php echo base_url();?>index.php/surat_keluar/lihat_file_keluar/<?php echo $row->id_surat?>" class="btn btn-warning"> Ubah File </a>
                                                <a href="<?php echo base_url();?>index.php/surat_keluar/hapus/<?php echo $row->id_surat?>" class="btn btn-danger" onclick="return confirm('apakah anda yakin akan menghapus ?')"> Hapus </a>
                                       </td>
                                    </tr>
                                    <?php $no++;?>
                                <?php endforeach;?>
                                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
      
            <!-- /.row -->
        </div>