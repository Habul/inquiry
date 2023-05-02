
<script> 
$(document).ready(function() {
   $('#item_it').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": '<?= site_url('master_item/ajax_list'); ?>',
                "type": "POST"
            },
            "columnDefs": [{ 
            "targets": [ 0,3,5,6,7,8,9,10 ],
            "className": "text-center", 
        }],
        });

        $('#item').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": '<?= site_url('master_item/ajax_list_item'); ?>',
                "type": "POST"
            },
            "columnDefs": [{ 
            "targets": [ 0,3,5,6,7,8 ],
            "className": "text-center", 
        }],
        });

        $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
     });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    });

    function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Create New item'); // Set Title to Bootstrap modal title
}
</script>
 