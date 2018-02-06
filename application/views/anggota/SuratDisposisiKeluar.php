<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Disposisi</h1>
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
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Judul Surat</th>
                            <th>Perihal</th>
                            <th>Penerima</th>
                            <th>File</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($SuratDisposisiKeluar as $s) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $s->judul; ?></td>
                            <td><?php echo $s->perihal; ?></td>
                            <td><?php echo $s->namaLengkap; ?></td>
                            <td><?php echo $s->file; ?></td>
                            <td><?php echo $s->status; ?></td>
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
