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
                    		foreach ($Surat as $s) {
                    	?>
                        <tr class="odd gradeX">
                            <td><?php echo $s->judul; ?></td>
                            <td><?php echo $s->perihal; ?></td>
                            <td><?php echo $s->pengirim; ?></td>
                            <td><?php echo $s->file; ?></td>
                            <td>
                                <button class="btn btn-info" data-toggle="modal" data-target="#editfile" onclick="getSurat(<?php echo $s->idSuratMasuk; ?>)">Edit File</button >
                    			<a class="btn btn-info" data-toggle="modal" data-target="#edit" onclick="getSurat(<?php echo $s->idSuratMasuk; ?>)">Edit</a>
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
<div id="buatSurat" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Agenda</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url(); ?>Surat/tambahsurat" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul Surat</label>
                        <input class="form-control" placeholder="Judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input class="form-control" placeholder="Nomor Surat" name="noSurat" required>
                    </div>
                    <div class="form-group">
                        <label>Perihal</label>
                        <input class="form-control" placeholder="Perihal" name="perihal" required>
                    </div>
                    <div class="form-group">
                        <label>Pengirim</label>
                        <input class="form-control" placeholder="Pengirim" name="pengirim" required>
                    </div>
                    <div class="form-group">
                        <label>Penerima</label>
                        <input class="form-control" placeholder="Penerima" name="penerima" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kirim</label>
                        <input class="form-control" type="date" placeholder="YYYY/mm/dd" name="tglkirim" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Terima</label>
                        <input class="form-control" type="date" placeholder="YYYY/mm/dd" name="tglterima" required>
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <input class="form-control" type="file" name="file" required>
                    </div>
                    <input type="submit" class="btn btn-default" value="Tambah">
                    <button type="reset" class="btn btn-default">Reset Button</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Agenda</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url(); ?>Surat/editsurat">
                    <input type="text" name="idSurat" id="eidsurat" style="visibility: hidden;">
                    <div class="form-group">
                        <label>Judul Surat</label>
                        <input class="form-control" id="ejudul" placeholder="Judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input class="form-control" id="enosurat" placeholder="Nomor Surat" name="noSurat" required>
                    </div>
                    <div class="form-group">
                        <label>Perihal</label>
                        <input class="form-control" id="eperihal" placeholder="Perihal" name="perihal" required>
                    </div>
                    <div class="form-group">
                        <label>Pengirim</label>
                        <input class="form-control" id="epengirim" placeholder="Pengirim" name="pengirim" required>
                    </div>
                    <div class="form-group">
                        <label>Penerima</label>
                        <input class="form-control" id="epenerima" placeholder="Penerima" name="penerima" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kirim</label>
                        <input class="form-control" id="etglkirim" type="date" placeholder="YYYY/mm/dd" name="tglkirim" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Terima</label>
                        <input class="form-control" id="etglterima" type="date" placeholder="YYYY/mm/dd" name="tglterima" required>
                    </div>
                    <input type="submit" class="btn btn-default" value="Simpan">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="editfile" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Agenda</h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>surat/editfilessurat">
                    <input type="text" name="idSurat" id="edidsurat" style="visibility: hidden;">
                    <input type="file" name="file" class="form-control">
                    <input type="submit" class="btn btn-default" value="Edit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            $('#eidsurat').empty();
            $('#ejudul').empty();
            $('#enosurat').empty();
            $('#eperihal').empty();
            $('#epenerima').empty();
            $('#epengirim').empty();
            $('#edidsurat').empty();
            $('#etglkirim').empty();
            $('#etglterima').empty();
            //////
            $('#surat').val(data.idSuratMasuk);
            $('#eidsurat').val(data.idSuratMasuk);
            $('#ejudul').val(data.judul);
            $('#enosurat').val(data.noSurat);
            $('#eperihal').val(data.perihal);
            $('#epenerima').val(data.penerima);
            $('#epengirim').val(data.pengirim);
            $('#etglkirim').val(data.tglKirim);
            $('#etglterima').val(data.tglTerima); 
            $('#edidsurat').val(data.idSuratMasuk);
        });
    }
</script>