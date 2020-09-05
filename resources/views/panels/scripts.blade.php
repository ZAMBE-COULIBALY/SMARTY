
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script>
jQuery(document).ready(function(){
    current_url = jQuery(location).attr('href');//on recupère l'url en cours
    if( current_url.indexOf("step=") >= 0)//si le numéro de fin d'url est supérieur ou égal à 0
    {
    step_array = current_url.split("step=");//on récupère la clé du numéro de létape courante
    step = step_array[1];//on récupère la valeur, donc le numéro
    switch(Number(step))//et on switche
    {
    case 1://si on est dans le premier cas, donc en réalité le deuxième formulaire car le ?step=1 concerne la deuxième page
    jQuery("#step1").css("display", "none");
    jQuery("#step2").css("display", "block");
    jQuery("#step3").css("display", "none");
    jQuery("#step4").css("display", "none");
    jQuery("#step5").css("display", "none");
    jQuery("#etape_simulation  ul li").css("opacity",".5");
    jQuery("#etape_simulation  ul li:nth-child(2)").css("opacity","1");
    break;
    case 2:
    jQuery("#step1").css("display", "none");
    jQuery("#step2").css("display", "none");
    jQuery("#step3").css("display", "block");
    jQuery("#step4").css("display", "none");
    jQuery("#step5").css("display", "none");
    jQuery("#etape_simulation  ul li").css("opacity",".5");
    jQuery("#etape_simulation  ul li:nth-child(3)").css("opacity","1");
    break;
    case 3:
    jQuery("#step1").css("display", "none");
    jQuery("#step2").css("display", "none");
    jQuery("#step3").css("display", "none");
    jQuery("#step4").css("display", "block");
    jQuery("#step5").css("display", "none");
    jQuery("#etape_simulation  ul li").css("opacity",".5");
    jQuery("#etape_simulation  ul li:nth-child(4)").css("opacity","1");
    break;
    case 4:
    jQuery("#step1").css("display", "none");
    jQuery("#step2").css("display", "none");
    jQuery("#step3").css("display", "none");
    jQuery("#step4").css("display", "none");
    jQuery("#step5").css("display", "block");
    jQuery("#etape_simulation  ul li").css("opacity",".5");
    jQuery("#etape_simulation  ul li:nth-child(5)").css("opacity","1");
    break;
    }
    }
    });

</script>


<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
      $(function () {
        bsCustomFileInput.init();
      });
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4',
        tags:true,
      })





      if(''){
        toastr.success('');
        ;
      }
      if(''){
        toastr.warning('');
        ;
      }
      if(''){
        toastr.error('');
        ;
      }


      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      $('#reservationdate').datetimepicker({
          format: 'L'
      });
      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });

      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });

    })
  </script>
         <script>

        $('input[name="paymenttype"]').on('change', function(e) {
            console.log('change')

            var manageradiorel = e.target.value;
            console.log(manageradiorel)
            switch(manageradiorel){
                case "1":
                $('#form').attr('action', 'http://omotos.net/Subscription/Summary');
                console.log('case 1')
                    break;
                case "2":
                $('#form').attr('action', 'https://secure.cinetpay.com');
                console.log('case 2')

                    break;

                default:
                console.log('case def')

                    break;

            }

        });


        </script>
