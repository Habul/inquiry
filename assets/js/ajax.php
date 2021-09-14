<script type="text/javascript">
        $(document).ready(function(){
             $('#kurs').on('input',function(){
                 
                var kode=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/pos/get_inquiry')?>",
                    dataType : "JSON",
                    data : {kurs: kurs},
                    cache:false,
                    success: function(data){
                        $.each(data,function(kode, nama_barang, harga, satuan){
                            $('[name="kurs"]').val(data.nama_barang);
                            $('[name="harga"]').val(data.harga);
                            $('[name="satuan"]').val(data.satuan);
                             
                        });
                         
                    }
                });
                return false;
           });
 
        });
    </script>
