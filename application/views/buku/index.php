<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left"
    role="search" action="<?php echo site_url('buku/search'); ?>" method="post">
        <div class="form-group">
            <label>Find with ID</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php
echo site_url('buku/add'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<?php
echo $message; ?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>No.</td>
            <td>Id</td>
            <td>Judul</td>
            <td>Pengarang</td>
            <td>Kuantitas</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php
$no = 0;
foreach ($buku as $row):
  $no++; ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row->id; ?></td>
        <td><?php echo $row->judul; ?></td>
        <td><?php echo $row->pengarang; ?></td>
        <td><?php echo $row->kuantitas; ?></td>
        <td><a href="<?php echo site_url('buku/edit/' . $row->id); ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id; ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>
    <?php
endforeach; ?>
</Table>
<?php echo $pagination; ?>
<script>
    $(function(){
        $(".hapus").click(function(){
            var kode=$(this).attr("kode");
            $("#idhapus").val(kode);
            $("#myModal").modal("show");
        });

        $("#konfirmasi").click(function(){
            var kode=$("#idhapus").val();
            $.ajax({
                url:"<?php echo site_url('buku/delete'); ?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('anggota/index/delete_success'); ?>";
                }
            });
        });
    });
</script>
