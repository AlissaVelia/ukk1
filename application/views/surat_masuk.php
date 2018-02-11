 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">SURAT MASUK</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                     <?php 
                    $notif = $this->session->flashdata('notif');
                    if($notif != NULL){
                        echo '
                            <div class="alert alert-info">'.$notif.'</div>
                        ';
                    }
                ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="<?php echo base_url();?>index.php/surat_masuk/v_tambah_surat" class="btn btn-primary" class="fa fa-carret" id="kosong"> TAMBAH SURAT</a>
                            <button class="btn btn-info" onclick="printDiv('tabel-surat-masuk')" id="kosong1" ><span class="glyphicon glyphicon-print">Print</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" >
                             
                            <table width="100%" class="table table-striped table-bordered table-hover" id="tabel-surat-masuk" >
                 
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Pengirim</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Tanggal Terima </th>
                                        <th>Perihal</th>
                                        <th id="kosong2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($list as $row): ?>
                                    <tr>
                                       <td><?php echo $no?></td> 
                                       <td><?php echo $row->no_surat?></td>
                                       <td><?php echo $row->penerima?></td>
                                       <td><?php echo $row->tgl_kirim?></td>
                                       <td><?php echo $row->tgl_terima?></td>
                                       <td><?php echo $row->perihal?></td>
                                       <td id="kosong2"> 
                                                <a href="<?php echo base_url();?>/uploads/<?php echo $row->file_surat;?>" target="_blank" class="btn btn-primary"> Lihat </a>
                                                <a href="<?php echo base_url();?>index.php/surat_masuk/lihat_surat_masuk/<?php echo $row->id_surat;?>" class="btn btn-info"> Ubah Surat </a>
                                                <a href="<?php echo base_url();?>index.php/surat_masuk/v_ubah_file/<?php echo $row->id_surat?>" class="btn btn-warning"> Ubah File </a>
                                                <a href="<?php echo base_url();?>index.php/surat_masuk/disposisi_sekretaris/<?php echo $row->id_surat?>" class="btn btn-success"> Disposisi </a>
                                                <a href="<?php echo base_url();?>index.php/surat_masuk/hapus_surat/<?php echo $row->id_surat;?>" class="btn btn-danger" onclick=" return confirm('Apakah anda yakin akan menghapus ?')"> Hapus </a>

                                       </td>
                                    </tr>
                                <?php $no++;?>
                            <?php endforeach;?>
                                </tbody id="dataSuratMasuk">
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
<script type="text/javascript">
        function printDiv(divName) {
            var originalContents = document.body.innerHtml;
                    
            $('#tabel-surat-masuk td:nth-child(7)').css('display','none');

            var printContents = document.getElementById(divName).outerHTML;
            document.body.innerHtml = printContents;

            window.print()

            document.body.innerHtml = originalContents;


        }
</script>