<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatable/css/dataTables.bootstrap.css')?>" rel="stylesheet">
  </head>
  <body>
 
 
  <div class="container">
	</center>
    <h3 align="center">Siswa</h3>
    <br />
    <button class="btn btn-success" onclick="create()"><i class="glyphicon glyphicon-plus"></i> Tambah Siswa</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      	<thead>
        <tr>
			<th>No</th>
			<th>NIP</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telp</th>
			<th>Aksi</th>
      	</thead>
      	<tbody>
		<?php foreach($siswa as $s) { ?>
		<tr>
			<td><?php echo $s->id;?></td>
			<td><?php echo $s->nip;?></td>
			<td><?php echo $s->nama;?></td>
			<td><?php echo $s->alamat;?></td>
			<td><?php echo $s->telp;?></td>
			<td>
				<button class="btn btn-warning" onclick="edit(<?php echo $s->id;?>)"><i class="glyphicon glyphicon-pencil"> Edit</i></button>
				<button class="btn btn-danger" onclick="delete(<?php echo $s->id;?>)"><i class="glyphicon glyphicon-remove"> Hapus</i></button>
			</td>
		</tr>
		<?php } ?>
      	</tbody>
    </table>
 
  </div>
 
  <script src="<?php echo base_url('assets/jquery/jquery-3.2.1.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatable/js/dataTables.bootstrap.js')?>"></script>
  <script src="<?php echo base_url('assets/datatable/js/jquery.dataTables.min.js')?>"></script>

  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').datatable();
  });
    

    var save_method; //for save method string
    var table;
 
 
    function create()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
 
    function edit(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/siswa/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.id);
            $('[name="nip"]').val(data.nip);
            $('[name="nama"]').val(data.nama);
            $('[name="alamat"]').val(data.alamat);
            $('[name="telp"]').val(data.telp);
 
 
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Siswa'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
 
 
 
    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('index.php/siswa/create')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/siswa/update')?>";
      }
 
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
 
    function delete(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('index.php/siswa/delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
      }
    }
 
  </script>


<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Form Siswa</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">NIP</label>
              <div class="col-md-9">
                <input name="nip" placeholder="NIP" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nama Siswa</label>
              <div class="col-md-9">
                <input name="nama" placeholder="Nama Siswa" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Alamat</label>
              <div class="col-md-9">
                <input name="alamat" placeholder="Alamat" class="form-control" type="text">
 
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Telepon</label>
              <div class="col-md-9">
                <input name="telp" placeholder="Telepon" class="form-control" type="text">
 
              </div>
            </div>
 
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->