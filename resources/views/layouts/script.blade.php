  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>

  <!-- jQuery -->
  <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="{{ asset('assets/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

  <!-- Custom Theme JavaScript -->
  <script src="{{ asset('assets/bower_components/moment.js') }}"></script>
  <script src="{{ asset('assets/bower_components/daterangepicker.js') }}"></script>
  <script src="{{ asset('assets/bower_components/js/jquery.doubleScroll.js') }}"></script>
  <script src="{{ asset('assets/bower_components/js/chzn/chosen.jquery.js') }}"></script>

  <script src="{{ asset('assets/bower_components/js/chzn/chosen.jquery.js') }}"></script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
  <!-- DataTables Bootstrap 4 JS -->
  <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>

  <!-- Tambahkan script JavaScript untuk Bootstrap dan Bootstrap Datepicker -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

  <!-- Tambahkan script JavaScript untuk eksport PDF, EXCEL, SVG -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Include Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

<script src="{{asset('assets/select_search/select.jquery.js')}}"></script>
  <script>
      $(document).ready(function() {
          // Initialize chosen
          $('#nip').chosen();

          // Trigger the chosen search feature when typing
          $('#nip_chosen .chosen-search input[type="text"]').on('keyup', function() {
              var searchText = $(this).val();
              $('#nip option').each(function() {
                  if ($(this).text().toLowerCase().indexOf(searchText.toLowerCase()) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          });
      });
  </script>

  <script>
      $(document).ready(function() {
          $('#config-demo').daterangepicker({
              singleDatePicker: true
          });

          updateConfig();

          function updateConfig() {
              var options = {};

              options.ranges = {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                      .endOf('month')
                  ]
              };
              options.alwaysShowCalendars = false;

              $('#config-demo').daterangepicker(options, function(start, end, label) {
                  $('#awal').val(start.format('YYYY-MM-DD'));
                  $('#akhir').val(end.format('YYYY-MM-DD'));
              });
          }
      });

      $(document).ready(function() {
          $('#config-demo-izin').daterangepicker({
              singleDatePicker: true
          });

          updateConfig();

          function updateConfig() {
              var options = {};

              options.ranges = {
                  // 'Today': [moment(), moment()],
                  // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  // 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  // 'This Month': [moment().startOf('month'), moment().endOf('month')],
                  // 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              };
              options.alwaysShowCalendars = false;

              $('#config-demo-izin').daterangepicker(options, function(start, end, label) {
                  $('#awal').val(start.format('YYYY-MM-DD'));
                  $('#akhir').val(end.format('YYYY-MM-DD'));
              });
          }
      });
      $('.daterangepicker').css('font-size', ''); // Sesuaikan ukuran font sesuai keinginan
      $('.daterangepicker .form-control').css('font-size', ''); // Sesuaikan ukuran font sesuai keinginan
  </script>

  <script>
      $(document).ready(function() {
          new DataTable('#example', {
              "scrollX": true,
              dom: 'Bfrtip',
              buttons: [
                  'csv', 'excel', 'pdf'
              ]
          });
      });
      $(document).ready(function() {
          new DataTable('#example2', {
              "scrollX": true,
          });
      });
      $(document).ready(function() {
          new DataTable('#example3', {
              "scrollX": true,
          });
      });
      $('.text_header_tabel').css('text-align', 'center');
      $('table#example3 td').css('border-bottom', '1px solid #ccc');
  </script>

  <script>
      // Panggil datepicker
      $(document).ready(function() {
          $('.datepicker').datepicker({
              format: 'yyyy-mm-dd',
              autoclose: true,
              todayHighlight: true,
          });
      });
  </script>

  {{-- filter data karyawan --}}
  <script>
      // Script untuk mengisi opsi satker berdasarkan pilihan direktorat
      document.getElementById('direktorat').addEventListener('change', function() {
          const selectedDirektoratId = this.value;
          const satkerSelect = document.getElementById('satker');

          // Clear opsi satker sebelumnya
          satkerSelect.innerHTML = '<option value="">-- Semua Satker --</option>';

          // Jika direktorat terpilih, ambil data satker melalui AJAX
          if (selectedDirektoratId) {
              fetch(`/get-satker/${selectedDirektoratId}`)
                  .then(response => response.json())
                  .then(data => {
                      data.forEach(satker => {
                          const option = document.createElement('option');
                          option.value = satker.satker_id;
                          option.textContent = satker.nama;
                          satkerSelect.appendChild(option);
                      });

                      // Add an "All Satker" option
                      const allOption = document.createElement('option');
                      allOption.value = 'all';
                      allOption.textContent = 'All Satker';
                      satkerSelect.appendChild(allOption);
                  });
          }
      });
  </script>

  {{-- <script>
    $(document).ready(function () {
        $('#direktorat').on('change', function () {
            const selectedDirektoratId = $(this).val();
            const satkerSelect = $('#satker');

            // Clear opsi satker sebelumnya
            satkerSelect.html('<option value="">-- Pilih Satker --</option>');

            // Jika direktorat terpilih, ambil data satker melalui AJAX
            if (selectedDirektoratId) {
                $.ajax({
                    url: `/get-satker/${selectedDirektoratId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        data.forEach(function (satkers) {
                            const option = $('<option>').val(satker.satker_id).textContent(satker.nama);
                            satkerSelect.append(option);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

    $('#proses').on('click', function () {
        var direktoratId = $('#direktorat').val();
        var satkerId = $('#satker').val();
        var aktif = $('#aktif').val();

        $.post('/process-filter', { direktorat: direktoratId, satker: satkerId, aktif: aktif }, function (data) {
            $('#pegawai-table-body').html(data);
        });
    });
});
  </script> --}}
