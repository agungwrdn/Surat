<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Surat Masuk</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                DataTables Advanced Tables
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <button class="btn btn-info" data-toggle="modal" data-target="#buatSurat">Tambah Surat</button>
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Judul Surat</th>
                            <th>Perihal</th>
                            <th>Pengirim</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($SuratDisposisiMasuk as $s) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $s->judul; ?></td>
                            <td><?php echo $s->perihal; ?></td>
                            <td><?php echo $s->namaLengkap; ?></td>
                            <td><?php echo $s->file; ?></td>
                            <td>
                                <a class="btn btn-default" href="<?php echo base_url('uploads/'.$s->file.''); ?>" target="_blank" onclick="<?php echo base_url(); ?>surat/setstatus/<?php echo $s->idDisposisi; ?>">Lihat PDF</a>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#disposisi" onclick="getSurat(<?php echo $s->idSuratMasuk; ?>)">Disposisi</a>
                                <a class="btn btn-danger" href="<?php echo base_url(); ?>surat/hapussuratmasuk/<?php echo $s->idSuratMasuk;?>" >Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="disposisi" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Disposisi</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url(); ?>Surat/disposisi" enctype="multipart/form-data">
                    
                    <input type="text" id="surat" name="idSurat" style="visibility: hidden;">
                    
                    <div class="form-group">
                        <select class="form-control" name="user">
                            <?php
                                foreach ($users as $u) {
                            ?>
                                <option value="<?php echo $u->idUser; ?>"><?php echo $u->namaLengkap; ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-default" value="Tambah">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getSurat(idSurat)
    {
        $.getJSON('<?php echo base_url(); ?>surat/getsuratbyid/'+idSurat, function(data){
            $('#surat').empty();
            
            //////
            $('#surat').val(data.idSuratMasuk);
           
        });
    }
</script>