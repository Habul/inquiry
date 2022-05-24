<script>
   $(document).ready(function() {
      $("#submitbtn").click(function() {
         $('#submitbtn').text('saving...');
         $("#submitbtn").attr("disabled", true);
         $('#addform').submit();
      });
   });

   $(function() {
      bsCustomFileInput.init();
   });

   $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
         event.preventDefault();
         $(this).ekkoLightbox({
            alwaysShowClose: true
         });
      });

      $('.filter-container').filterizr({
         gutterPixels: 3
      });
      $('.btn[data-filter]').on('click', function() {
         $('.btn[data-filter]').removeClass('active');
         $(this).addClass('active');
      });
   })

   var t = $('#index1').DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "columnDefs": [{
         "searchable": false,
         "orderable": false,
         "targets": 0
      }],
      "order": [
         [2, 'desc']
      ]
   });

   t.on('order.dt search.dt', function() {
      t.column(0, {
         search: 'applied',
         order: 'applied'
      }).nodes().each(function(cell, i) {
         cell.innerHTML = i + 1;
      });
   }).draw();

   var x = $('#index2').DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "columnDefs": [{
         "searchable": false,
         "orderable": false,
         "targets": 0
      }],
      "order": [
         [2, 'asc']
      ],
      "buttons": [{
            extend: 'copyHtml5',
            filename: 'Download',
            footer: true,
            exportOptions: {
               columns: [1, 2, 3, 4, 5],
               orthogonal: 'export',
            },
         },
         {
            extend: 'excelHtml5',
            filename: 'Download',
            footer: true,
            exportOptions: {
               columns: [1, 2, 3, 4, 5],
               orthogonal: 'export'
            },
         },
         {
            extend: 'csvHtml5',
            filename: 'Download',
            footer: true,
            exportOptions: {
               columns: [1, 2, 3, 4, 5],
               orthogonal: 'export'
            },
         },
         {
            extend: 'pdfHtml5',
            filename: 'Download',
            footer: true,
            exportOptions: {
               columns: [1, 2, 3, 4, 5],
               orthogonal: 'export',
               modifier: {
                  orientation: 'landscape'
               },
            },
         }, 'colvis'
      ],
   });

   x.on('order.dt search.dt', function() {
      x.column(0, {
         search: 'applied',
         order: 'applied'
      }).nodes().each(function(cell, j) {
         cell.innerHTML = j + 1;
      }).buttons().container().appendTo('#index2_wrapper .col-md-6:eq(0)');
   }).draw();

   $(function() {
      $("#example1").DataTable({
         "responsive": true,
         "lengthChange": false,
         "autoWidth": false,
         "searching": false,
         "ordering": true,
         "paging": false,
         "info": false,
      })
      $('#example2').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "order": [
            [2, "desc"]
         ],
         "info": true,
         "autoWidth": false,
         "responsive": true,
      });
      $('#example3').DataTable({
         "paging": true,
         "responsive": true,
         "lengthChange": true,
         "autoWidth": false,
         "order": [
            [2, "desc"]
         ]
      });
      $("#example4").DataTable({
         "responsive": true,
         "searching": true,
         "lengthChange": true,
         "autoWidth": false,
         "buttons": ['copyHtml5',
            {
               extend: 'excelHtml5',
               filename: 'Data Mahasiswa',
               title: 'Rekap Data Mahasiswa',
               footer: true,
               exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5],
                  orthogonal: 'export'
               },
            }, "csv", "excel", "pdf", "print", "colvis"
         ],
      }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
      $('#example5').DataTable({
         "paging": true,
         "responsive": true,
         "lengthChange": true,
         "autoWidth": false,
         "ordering": true
      });
      $('#example6').DataTable({
         "paging": true,
         "responsive": true,
         "lengthChange": true,
         "autoWidth": false,
         "order": [
            [0, "desc"]
         ]
      });
      $('#example7').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": true,
         "responsive": true,
      });
      $('#example8').DataTable({
         "paging": true,
         "responsive": true,
         "lengthChange": true,
         "autoWidth": false,
         "ordering": true
      });
      $('#example9').DataTable({
         "paging": true,
         "responsive": true,
         "lengthChange": true,
         "autoWidth": false,
         "order": [
            [1, "desc"]
         ]
      });
      $('#example10').DataTable({
         "paging": true,
         "responsive": true,
         "lengthChange": true,
         "autoWidth": false,
         "order": [
            [1, "desc"]
         ]
      });
      $('#example11').DataTable({
         "paging": true,
         "responsive": true,
         "lengthChange": true,
         "autoWidth": false,
         "order": [
            [7, "desc"]
         ]
      });
      $('#example12').DataTable({
         "paging": true,
         "responsive": true,
         "lengthChange": true,
         "autoWidth": false,
         "ordering": true
      });
   });
</script>
<script>
   var awal_date;
   var akhir_date;
   var filterdate = (function(oSettings, aData, iDataIndex) {
      var mulaistart = parseDateValue(awal_date);
      var akhirend = parseDateValue(akhir_date);
      var evalDate = parseDateValue(aData[6]);
      if ((isNaN(mulaistart) && isNaN(akhirend)) ||
         (isNaN(mulaistart) && evalDate <= akhirend) ||
         (mulaistart <= evalDate && isNaN(akhirend)) ||
         (mulaistart <= evalDate && evalDate <= akhirend)) {
         return true;
      }
      return false;
   });

   function parseDateValue(rawDate) {
      var tglArray = rawDate.split("/");
      var parsingdate = new Date(tglArray[2], parseInt(tglArray[1]) - 1, tglArray[0]);
      return parsingdate;
   }

   $(document).ready(function() {
      var $tableid = $('#filter1').DataTable({
         "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datecaribox'>><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
         "responsive": true,
         "lengthChange": true,
         "order": [
            [2, "desc"]
         ]
      });

      $("div.datecaribox").html('<div class="input-group col-sm-7"> <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div><input type="text" class="form-control form-control-sm pull-right" id="datesearch" placeholder="Filter by deadline range.."> </div > ');

      document.getElementsByClassName("datecaribox")[0].style.textAlign = "right";

      $('#datesearch').daterangepicker({
         autoUpdateInput: false
      });

      $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
         $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
         awal_date = picker.startDate.format('DD/MM/YYYY');
         akhir_date = picker.endDate.format('DD/MM/YYYY');
         $.fn.dataTableExt.afnFiltering.push(filterdate);
         $tableid.draw();
      });

      $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
         $(this).val('');
         awal_date = '';
         akhir_date = '';
         $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
         $tableid.draw();
      });
   });
</script>
<script>
   var start_date;
   var end_date;
   var DateFilterFunction = (function(oSettings, aData, iDataIndex) {
      var dateStart = parseDateValue(start_date);
      var dateEnd = parseDateValue(end_date);
      var evalDate = parseDateValue(aData[2]);
      if ((isNaN(dateStart) && isNaN(dateEnd)) ||
         (isNaN(dateStart) && evalDate <= dateEnd) ||
         (dateStart <= evalDate && isNaN(dateEnd)) ||
         (dateStart <= evalDate && evalDate <= dateEnd)) {
         return true;
      }
      return false;
   });

   function strtrunc(str, max, add) {
      add = add || '...';
      return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
   };

   function parseDateValue(rawDate) {
      var dateArray = rawDate.split("/");
      var parsedDate = new Date(dateArray[2], parseInt(dateArray[1]) - 1, dateArray[0]);
      return parsedDate;
   }
   $(document).ready(function() {
      var $dTable = $('#filter2').DataTable({
         "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchbox'>><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
         "responsive": true,
         "lengthChange": true,
         "order": [
            [0, "desc"]
         ],
         'columnDefs': [{
            'targets': 4,
            'render': function(data, type, full, meta) {
               if (type === 'display') {
                  data = strtrunc(data, 20);
               }
               return data;
            }
         }]
      });

      $("div.datesearchbox").html('<div class="input-group col-sm-7"> <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div><input type="text" class="form-control form-control-sm pull-right" id="datesearch" placeholder="Filter by date range.."> </div > ');

      document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

      $('#datesearch').daterangepicker({
         autoUpdateInput: false
      });

      $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
         $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
         start_date = picker.startDate.format('DD/MM/YYYY');
         end_date = picker.endDate.format('DD/MM/YYYY');
         $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
         $dTable.draw();
      });

      $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
         $(this).val('');
         start_date = '';
         end_date = '';
         $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
         $dTable.draw();
      });
   });
</script>
<script>
   var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
   var donutData = {
      labels: [<?php
               if (count($data_sales) > 0) {
                  foreach ($data_sales as $data) {
                     echo "'" . $data->sales . "',";
                  }
               }
               ?>],
      datasets: [{
         data: [<?php
                  if (count($data_sales) > 0) {
                     foreach ($data_sales as $data) {
                        echo $data->jmlh . ", ";
                     }
                  }
                  ?>],
         backgroundColor: <?php echo $sales_color ?>,
      }]
   }
   var donutOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
         display: true
      }
   }
   new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
   })

   var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
   var pieData = {
      labels: [<?php
               if (count($data_brand) > 0) {
                  foreach ($data_brand as $data) {
                     echo "'" . $data->brand . "',";
                  }
               }
               ?>],
      datasets: [{
         data: [<?php
                  if (count($data_brand) > 0) {
                     foreach ($data_brand as $data) {
                        echo $data->jmlh . ", ";
                     }
                  }
                  ?>],
         backgroundColor: <?php echo $brand_color ?>,
      }]
   }
   var pieOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
         display: false
      }
   }
   new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions,

   })

   var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
   var areaChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
         label: 'Surat Jalan',
         backgroundColor: '#3498db',
         borderColor: '#2980b9',
         pointRadius: false,
         pointColor: '#2980b9',
         pointStrokeColor: '#c1c7d1',
         pointHighlightFill: '#fff',
         pointHighlightStroke: 'rgba(220,220,220,1)',
         data: [<?php
                  if (count($suratdf) > 0) {
                     foreach ($suratdf as $data) {
                        echo $data->total . ", ";
                     }
                  }
                  ?>]
      }, ]
   }

   var areaChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
         display: true
      },
      scales: {
         xAxes: [{
            gridLines: {
               display: false,
            }
         }],
         yAxes: [{
            gridLines: {
               display: true,
            }
         }]
      }
   }

   new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
   })

   var barChartCanvas = $('#barChart').get(0).getContext('2d')
   var barChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
            label: 'Mobil',
            backgroundColor: '#1abc9c',
            borderColor: '#16a085',
            pointRadius: false,
            pointColor: '#16a085',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [<?php
                     if (count($barmobil) > 0) {
                        foreach ($barmobil as $data) {
                           echo $data->total . ", ";
                        }
                     }
                     ?>]
         },
         {
            label: 'Motor',
            backgroundColor: '#2ecc71',
            borderColor: '#27ae60',
            pointRadius: false,
            pointColor: '#27ae60',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [<?php
                     if (count($barmotor) > 0) {
                        foreach ($barmotor as $data) {
                           echo $data->total . ", ";
                        }
                     }
                     ?>]
         },
         {
            label: 'Truck',
            backgroundColor: '#bdc3c7',
            borderColor: '#bdc3c7',
            pointRadius: false,
            pointColor: '#bdc3c7',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [<?php
                     if (count($bartruck) > 0) {
                        foreach ($bartruck as $data) {
                           echo $data->total . ", ";
                        }
                     }
                     ?>]
         },
      ]
   }

   var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false
   }

   new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
   })

   $(function() {
      $('.select2').select2()
      $('.select2bs4').select2({
         theme: 'bootstrap4'
      })
      $('#datemask').inputmask('dd/mm/yyyy', {
         'placeholder': 'dd/mm/yyyy'
      })
      $('#datemask2').inputmask('mm/dd/yyyy', {
         'placeholder': 'mm/dd/yyyy'
      })
      $('[data-mask]').inputmask()
      $('#reservationdate').datetimepicker({
         format: 'L'
      });
      $('#reservationdatetime').datetimepicker({
         icons: {
            time: 'far fa-clock'
         }
      });
      $('#reservation').daterangepicker()
      $('#reservationtime').daterangepicker({
         timePicker: true,
         timePickerIncrement: 30,
         locale: {
            format: 'MM/DD/YYYY hh:mm A'
         }
      })
      $('#daterange-btn').daterangepicker({
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
         },
         function(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
         }
      )
      $('#timepicker').datetimepicker({
         format: 'LT'
      })
      $('.duallistbox').bootstrapDualListbox()
      $('.my-colorpicker1').colorpicker()
      $('.my-colorpicker2').colorpicker()
      $('.my-colorpicker2').on('colorpickerChange', function(event) {
         $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      })
      $("input[data-bootstrap-switch]").each(function() {
         $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })
   })

   $('#calendar').datetimepicker({
      format: 'L',
      inline: true
   })
</script>