<script>
	var save_method;
	var table;
	var base_url = '<?= base_url();?>';
	$(document).ready(function () {
		table = $('#table_it').DataTable({
			"processing": true,
			"responsive": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?= site_url('it/ajax_it') ?>",
				"type": "POST"
			},
			"columnDefs": [{
					"targets": [0, 2, 3],
				"className": "align-middle text-center",
			}],
			
		});

		$("input").change(function () {
			$(this).removeClass('is-invalid');
			$(this).next().empty();
		});
		$("textarea").change(function () {
			$(this).removeClass('is-invalid');
			$(this).next().empty();
		});
	});

	function add_it() {
		save_method = 'add';
		$('#form_add')[0].reset();
		$('.form-control').removeClass('is-invalid');
		$('.help-block').empty();
		$('#modal_view').modal('hide');
		$('#modal_add').modal('show');
		$('.modal-title').text('Create new data');
	}

	function edit_it(id) {
		save_method = 'update';
		$('#form_add')[0].reset();
		$('.form-control').removeClass('is-invalid');
		$('.help-block').empty();
		$('#modal_view').modal('hide');

		$.ajax({
			url: "<?= site_url('it/ajax_edit/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {

				$('[name="id"]').val(data.id);
				$('[name="judul"]').val(data.judul);
				$('[name="isi"]').val(data.isi);
				$('#modal_add').modal('show');
				$('.modal-title').text('Edit Data');

            if(data.photo)
            {
                $('#label-photo').text('Change'); // label photo upload
 
            }
            else
            {
                $('#label-photo').text('Upload'); // label photo upload
            }

			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function view_it(id) {
		save_method = 'view';
		$('#form_add')[0].reset();
		$('.form-control').removeClass('is-invalid');
		$('.help-block').empty();

		$.ajax({
			url: "<?= site_url('it/ajax_edit/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {

				$('[name="id"]').val(data.id);
				$('[name="isi"]').val(data.isi);
				$('#modal_view').modal('show');
				$('.modal-title').text(data.judul);

				$('#photo-preview').show(); 
 
            if(data.file)
            {
                $('#photo-preview div').html('<a href="'+base_url+'gambar/datait/'+data.file+'" target="_blank"><img src="'+base_url+'gambar/datait/'+data.file+'" class="img-priview img-fluid col-sm-5 mb-1 mt-1" width="35%"></a>');
 
            }
            else
            {
                $('#photo-preview div').text('');
            }

			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function delete_it(id) {
		if(confirm('Are you sure delete this data?'))
    {
        $.ajax({
            url : "<?= site_url('it/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_add').modal('hide');
                $('#modal_view').modal('hide');
                reload_table();
					 toastr.success("Confirmed! Item deleted");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
	}

	function reload_table() {
		table.ajax.reload(null, false);
	}

	function save() {
		$('#btnSave').text('Saving...');
		$('#btnSave').attr('disabled', true);
		var url;
		var shows;

		if (save_method == 'add') {
			url = "<?= site_url('it/ajax_add')?>";
		} else {
			url = "<?= site_url('it/ajax_update')?>";
		}

		$.ajax({
			url: url,
			type: "POST",
			data: $('#form_add').serialize(),
			dataType: "JSON",
			success: function (data) {

				if (data.status) {

					if (save_method == 'add') {
						shows = toastr.success("Confirmed! Item Added");
					} else {
						shows = toastr.success("Confirmed! Item Updated");
					}

					$('#modal_add').modal('hide');
					reload_table();
					shows;
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
					}
				}
				$('#btnSave').text('Save');
				$('#btnSave').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSave').text('Save');
				$('#btnSave').attr('disabled', false);
			}
		});
	}

</script>
