<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ ('/js/app.js') }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $("#example1").DataTable();
    });
</script>

<script>
    //$(document).ready(function () {
        $(document).on('click', '#btn_add_dte',function (e) {

            $(".btn_add_dte").click(function () {
            $("#add_dte").modal("show");
            $("#id_cliente").val($(this).closest('tr').children()[0].textContent);
            $("#id_fact").val($(this).closest('tr').children()[0].textContent);
            $("#nom_cliente").val($(this).closest('tr').children()[2].textContent);
            $("#num_doc").val($(this).closest('tr').children()[2].textContent);
            $("#nom_cliente_s").val($(this).closest('tr').children()[1].textContent);

            $("#id_proveedor").val($(this).closest('tr').children()[0].textContent);
            $("#nom_proveedor").val($(this).closest('tr').children()[2].textContent);

            total = $(this).closest('tr').children()[5].textContent;
            total = total.replace("$","");
            total = total.replace(".","");
            total = total.replace(".","");
            total = total.replace(".","");
            total = total.replace(".","");

            pagado = $(this).closest('tr').children()[6].textContent;
            pagado = pagado.replace("$","");
            pagado = pagado.replace(".","");
            pagado = pagado.replace(".","");
            pagado = pagado.replace(".","");
            pagado = pagado.replace(".","");

            diferencia = total - pagado;

            $("#max_total").val(diferencia);
            $("#max_total").attr('max',diferencia);

            if(diferencia == 0){
                alert('Factura no posee deuda!.');
                $('#add_dte').modal('hide');
            }

        });

          $("#neto").change(function(){
              var neto = ($("#neto").val());
              var iva = 0.19;
              var calcula_iva = (neto * iva);
              var iva_correg = Math.round(calcula_iva);
              $("#iva").val(iva_correg);
              var total = parseInt(neto) + parseInt(iva_correg);
              $("#total").val(total);
          });

        $("#iva").change(function(){
            var neto = ($("#neto").val());
            var iva = ($("#iva").val());
            var otro_imp = ($("#otro_impuesto").val());
            var total = parseInt(neto) + parseInt(iva) + parseInt(otro_imp);
            $("#total").val(total);
        });

            $("#otro_impuesto").change(function(){
                var neto = ($("#neto").val());
                var iva = ($("#iva").val());
                var otro_imp = ($("#otro_impuesto").val());
                var total = parseInt(neto) + parseInt(iva) + parseInt(otro_imp);
                $("#total").val(total);
            });

    });

    $(document).on('click', '#btn_mod_prov_cli',function (e) {

        $(".btn_mod_prov_cli").click(function () {
            $("#mod_prov_cli").modal("show");

            $("#rut").val($(this).closest('tr').children()[0].textContent);
            $("#razon").val($(this).closest('tr').children()[1].textContent);
            $("#giro").val($(this).closest('tr').children()[2].textContent);
            $("#fono").val($(this).closest('tr').children()[3].textContent);
            $("#mail").val($(this).closest('tr').children()[4].textContent);

        });
    });

    $(document).on('click', '#btn_del_prov_cli',function (e) {

        $(".btn_del_prov_cli").click(function () {
            $("#del_prov_cli").modal("show");

            $("#rut_del").val($(this).closest('tr').children()[0].textContent);
        });
    });

    $(document).on('click', '#btn_aprobar_dte',function (e) {

        $(".btn_aprobar_dte").click(function () {
            $("#aprobar_dte").modal("show");

            $("#rut_del").val($(this).closest('tr').children()[0].textContent);
        });
    });
</script>