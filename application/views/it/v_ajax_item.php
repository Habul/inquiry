<script>
	var save_method;
	var table;
	$(document).ready(function () {
		table2 = $('#item_it').DataTable({
			"processing": true,
			"responsive": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?= site_url('master_item/ajax_list') ?>",
				"type": "POST"
			},
			"columnDefs": [{
				"targets": [0, 3, 5, 6, 7, 8, 9, 10],
				"className": "text-center",
			}],
		});

		table = $('#item').DataTable({
			"processing": true,
			"responsive": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?= site_url('master_item/ajax_list_item') ?>",
				"type": "POST"
			},
			"columnDefs": [{
				"targets": [0, 3, 5, 6, 7, 8],
				"className": "text-center",
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
		$("select").change(function () {
			$(this).removeClass('is-invalid');
			$(this).next().empty();
		});
	});

	function add_item() {
		save_method = 'add';
		$('#form')[0].reset();
		$('.form-control').removeClass('is-invalid');
		$('.help-block').empty();
		$('#modal_form').modal('show');
		$('.modal-title').text('Create New item');
	}

	function edit_item(id) {
		save_method = 'update';
		$('#form')[0].reset();
		$('.form-control').removeClass('is-invalid');
		$('.help-block').empty();

		$.ajax({
			url: "<?= site_url('master_item/ajax_edit_item/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {

				$('[name="id"]').val(data.id);
				$('[name="merk"]').val(data.merk);
				$('[name="kelompok"]').val(data.kelompok);
				$('[name="part_number"]').val(data.part_number);
				$('[name="nama"]').val(data.nama);
				$('[name="satuan"]').val(data.satuan);
				$('[name="type"]').val(data.type);
				$('#modal_form').modal('show');
				$('.modal-title').text('Edit Item');

			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function delete_item(id) {
		if(confirm('Are you sure delete this data?'))
    {
        $.ajax({
            url : "<?= site_url('master_item/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal('hide');
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

	function approve(id) {
		if(confirm('Approve ?'))
    {
        $.ajax({
            url : "<?= site_url('master_item/ajax_approve')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal('hide');
                reload_table();
					 toastr.success("Confirmed! Item Approved");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
	}

	function approve_it(id) {
		if(confirm('Approve IT ?'))
    {
        $.ajax({
            url : "<?= site_url('master_item/ajax_approve_it')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal('hide');
                reload_table();
					 toastr.success("Confirmed! Item Approved IT");
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
		table2.ajax.reload(null, false);
	}

	function save() {
		$('#btnSave').text('Saving...');
		$('#btnSave').attr('disabled', true);
		var url;
		var shows;

		if (save_method == 'add') {
			url = "<?= site_url('master_item/ajax_add')?>";
			shows = toastr.success("Confirmed! Item Added");
		} else {
			url = "<?= site_url('master_item/ajax_update')?>";
			shows = toastr.success("Confirmed! Item Updated");
		}

		$.ajax({
			url: url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function (data) {

				if (data.status) {
					$('#modal_form').modal('hide');
					shows;
					reload_table();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
						$('[name="' + data.inputerror[i] + '"]').text(data.error_string[i]);
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
