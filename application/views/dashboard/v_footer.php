<footer class="main-footer text-sm">
  <strong>Copyright &copy; <?= date('Y'); ?><a href="https://github.com/Habul"> Habul</a></strong> . All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>IT</b> - Intinusa Sejahtera International
  </div>
</footer>

<aside class="control-sidebar control-sidebar-dark"></aside>

</div>

<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/min/dropzone.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/filterizr/jquery.filterizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script>
  $(document).ready(function() {
    $("#submitbtn").click(function() {
      $('#submitbtn').text('saving...');
      $("#submitbtn").attr("disabled", true);
      $('#addform').submit();
    });
  });
</script>
<script>
  $(function() {
    bsCustomFileInput.init();
  });
</script>
<script>
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
</script>

<script>
  $(document).ready(function() {
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
      "lengthChange": true,
      "autoWidth": false,
      "columnDefs": [{
        "searchable": false,
        "orderable": false,
        "targets": 0
      }],
      "order": [
        [1, 'asc']
      ]
    });

    x.on('order.dt search.dt', function() {
      x.column(0, {
        search: 'applied',
        order: 'applied'
      }).nodes().each(function(cell, j) {
        cell.innerHTML = j + 1;
      });
    }).draw();
  });
</script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": true,
      "searching": false
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
  var start_date;
  var end_date;
  var DateFilterFunction = (function(oSettings, aData, iDataIndex) {
    var dateStart = parseDateValue(start_date);
    var dateEnd = parseDateValue(end_date);
    var evalDate = parseDateValue(aData[6]);
    if ((isNaN(dateStart) && isNaN(dateEnd)) ||
      (isNaN(dateStart) && evalDate <= dateEnd) ||
      (dateStart <= evalDate && isNaN(dateEnd)) ||
      (dateStart <= evalDate && evalDate <= dateEnd)) {
      return true;
    }
    return false;
  });

  function parseDateValue(rawDate) {
    var dateArray = rawDate.split("/");
    var parsedDate = new Date(dateArray[2], parseInt(dateArray[1]) - 1, dateArray[0]);
    return parsedDate;
  }

  $(document).ready(function() {
    var $dTable = $('#filter1').DataTable({
      "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchbox'>><'col-sm-3'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "responsive": true,
      "lengthChange": true,
      "order": [
        [2, "desc"]
      ]
    });

    $("div.datesearchbox").html('<div class="input-group col-6"> <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div><input type="text" class="form-control form-control-sm pull-right" id="datesearch" placeholder="Filter by deadline range.."> </div > ');

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
        [2, "desc"]
      ]
    });

    $("div.datesearchbox").html('<div class="input-group col-6"> <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div><input type="text" class="form-control form-control-sm pull-right" id="datesearch" placeholder="Filter by deadline range.."> </div > ');

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
    labels: ['November', 'Desember', 'January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
        label: 'SJ HS',
        backgroundColor: '#95a5a6',
        borderColor: '#7f8c8d',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [<?php
                if (count($suraths) > 0) {
                  foreach ($suraths as $data) {
                    echo $data->total . ", ";
                  }
                }
                ?>]
      },
      {
        label: 'SJ DF',
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
      },
    ]
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
    labels: ['November', 'Desember', 'January', 'February', 'March', 'April', 'May', 'June', 'July'],
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
</script>
<script>
  $('#dropping').summernote({
    dialogsInBody: true
  });
</script>
<script>
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
</script>
<script>
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })
</script>
<script>
  var toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
  var currentTheme = localStorage.getItem('theme');
  var mainHeader = document.querySelector('.main-header');

  if (currentTheme) {
    if (currentTheme === 'dark') {
      if (!document.body.classList.contains('dark-mode')) {
        document.body.classList.add("dark-mode");
      }
      if (mainHeader.classList.contains('navbar-light')) {
        mainHeader.classList.add('navbar-dark');
        mainHeader.classList.remove('navbar-light');
      }
      toggleSwitch.checked = true;
    }
  }

  function switchTheme(e) {
    if (e.target.checked) {
      if (!document.body.classList.contains('dark-mode')) {
        document.body.classList.add("dark-mode");
      }
      if (mainHeader.classList.contains('navbar-light')) {
        mainHeader.classList.add('navbar-dark');
        mainHeader.classList.remove('navbar-light');
      }
      localStorage.setItem('theme', 'dark');
    } else {
      if (document.body.classList.contains('dark-mode')) {
        document.body.classList.remove("dark-mode");
      }
      if (mainHeader.classList.contains('navbar-dark')) {
        mainHeader.classList.add('navbar-light');
        mainHeader.classList.remove('navbar-dark');
      }
      localStorage.setItem('theme', 'light');
    }
  }

  toggleSwitch.addEventListener('change', switchTheme, false);
</script>
</body>

</html>