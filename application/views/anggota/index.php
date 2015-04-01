<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('anggota/search');?>" method="post">
        <div class="form-group">
            <label>Find with ID</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php echo site_url('anggota/add');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>No.</td>
            <td>Gambar</td>
            <td>Id</td>
            <td>Nama</td>
            <td>Pekerjaan</td>
            <td>No Handphone</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($anggota as $row ): $no++;?>
    <tr>
        <td><?php echo $no;?></td>
        <td><img src="<?php echo base_url('assets/img/'.$row->image);?>" height="100px" width="100px"></td>
        <td><?php echo $row->id;?></td>
        <td><?php echo $row->nama;?></td>
        <td><?php echo $row->pekerjaan;?></td>
        <td><?php echo $row->no_hp;?></td>
        <td><a href="<?php echo site_url('anggota/edit/'.$row->id);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>
    <?php endforeach;?>
</Table>
<?php echo $pagination;?>

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
                url:"<?php echo site_url('anggota/delete');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('anggota/index/delete_success');?>";
                }
            });
        });
    });
</script>
