 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">DISPOSISI MASUK</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                 <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>PENGIRIM</th>
                                        <th>TUJUAN UNIT</th>
                                        <th>TGL.DISPOSISI</th>
                                        <th>KETERANGAN</th>
                                        <th>Disposisi</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;?>
                                    <?php foreach($disposisi as $row):?>
                                    <tr>
                                        <td><?php echo $no?></td>
                                        <td><?php echo $row->nama_jabatan?></td>
                                        <td><?php echo $row->nama?></td>
                                        <td><?php echo $row->tgl_disposisi?></td>
                                        <td><?php echo $row->keterangan?></td>
                                        <td><label class="label label-success">Disposisi Masuk</label></td>
                                        <td>
                                            <a href="<?php echo base_url();?>/uploads/<?php echo $row->file_surat;?>" class="btn btn-info btn-sm btn-block" target="_blank">Lihat Surat</a>
                                            <a href="<?php echo base_url();?>index.php/dashboard_lain/disposisi_keluar/<?php echo $row->id_surat;?>" class="btn btn-primary btn-sm btn-block" "><span class="fa fa-plus"></span> Tambah Disposisi</a>
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