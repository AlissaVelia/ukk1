 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">DISPOSISI KELUAR</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <a href="<?php echo base_url();?>index.php/dashboard_lain/v_disposisi_keluar/<?php echo $this->uri->segment(3);?>" class="btn btn-primary" class="fa fa-carret"> TAMBAH DISPOSISI KELUAR</a>
                        <br><br>
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
                                    <th>NO</th>
                                    <th>TUJUAN UNIT</th>
                                    <th>TUJUAN PEGAWAI</th>
                                    <th>TGL.DISPOSISI</th>
                                    <th>KETERANGAN</th>
                                    <th></th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                  <?php $no = 1;?>
                                    <?php foreach($data_disposisi as $row):?>
                                    <tr>
                                        <td><?php echo $no?></td>
                                        <td><?php echo $row->nama_jabatan?></td>
                                        <td><?php echo $row->nama?></td>
                                        <td><?php echo $row->tgl_disposisi?></td>
                                        <td><?php echo $row->keterangan?></td>
                                        <td><label class="label label-success">Disposisi keluar</label></td>
                                        <td>
                                            <a href="<?php echo base_url();?>uploads/<?php echo $row->file_surat;?>" class="btn btn-info btn-sm btn-block" target="_blank">Lihat Surat</a>
                               
                                            <a href="<?php echo base_url();?>index.php/dashboard_lain/hapus_disposisi/<?php echo $this->uri->segment(3)?>/<?php echo $row->id_disposisi;?>" class="btn btn-danger btn-sm btn-block" onclick="return confirm('apakah anda yakin akan menghapus ?')">   </span> Hapus</a>
                                        </td>
                                    </tr>
                                 <?php $no++; ?>
                             <?php endforeach;?>
                                
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