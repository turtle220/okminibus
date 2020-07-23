<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

<!--Required scripts-->

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- External files for exporting -->

<script src="http://www.igniteui.com/js/external/FileSaver.js"></script>

<script src="http://www.igniteui.com/js/external/Blob.js"></script>



<!-- Ignite UI Loader Script -->

<script src="http://cdn-na.infragistics.com/igniteui/2016.2/latest/js/infragistics.loader.js"></script>

<style type="text/css">
    .table {

        width: 100%;

        margin: auto;

        border-collapse: collapse;

        border-spacing: 0;

        margin: auto;

        /*margin-top:20px;*/

    }



    table {

        display: table;

        border-collapse: separate;

        white-space: normal;

        line-height: normal;

        font-weight: normal;

        font-size: medium;

        font-style: normal;

        /*color: -internal-quirk-inherit;*/

        text-align: start;

        border-spacing: 2px;

        border-color: grey;

        font-variant: normal;

    }

    .pdf-wrap>table,
    .pdf-wrap>thead,
    .pdf-wrap>table>thead>tr,
    th {

        border: 2px solid black !important;

    }



    .border-bottom-1 {

        border-bottom: 1px solid black !important;

    }



    .col-md-center {

        text-align: center;

    }

    .td {

        border: 1px solid black;

    }

    .table>thead>tr>th {

        vertical-align: middle;

        text-align: center;

    }



    tbody>tr,
    td {

        border: 1px solid black;


    }


    tbody>tr>td {

        padding: 10px;

    }

</style>

<div class="container pdf-wrap">


    <table class="table col-md-center" id="testTable">

        <thead>



            <tr>

                <th style="width: 10%;">FECHA</th>

                <th style="width: 10%;">NUM.FACTURA</th>

                <th style="width: 10%;">NOMBRE</th>

                <th style="width: 10%;">IMPORTE</th>

                <th style="width: 10%;">OBSERVACIONES</th>

                <th style="width: 10%;">MATRICULA</th>


            </tr>

        </thead>

        <tbody>

            <?php $count=14  ?>

            @foreach($data as $val)

            <tr>

                <td>{{$val->BTDate}}</td>

                <td>{{$val->Num_Fac}}</td>

                <td>{{$val->Name}}</td>

                <td>{{$val->Price}}</td>

                <td>{{$val->observation}}</td>

                <td>{{$val->carnumber}}</td>


            </tr>

            <?php $count--;?>

            @endforeach





        </tbody>

    </table>



    <div class="footer" style="width: 80%; vertical-align: bottom;">

        <div style="width: 100%; margin-top:  3px; margin-bottom: 3px">SD- SERVICIO DISCRECIONAL</div>

        <div style="width: 100%; margin-bottom: 3px">TU-TRANSPORTE TURISTICO</div>

        <div style="width: 100%; margin-bottom: 3px">DR- DISCRECIONAL REFUREZO SERVICIO PUBLICO REGULAR GENERAL</div>

        <div style="width: 100%; margin-bottom: 3px">DC- DISCRECIONAL COLABORADOR SERVICIO PUBLICO REGULAR ESPECIA </div>

    </div>

</div>

<script type="text/javascript">
    var tableToExcel = (function() {

        var uri = 'data:application/vnd.ms-excel;base64,'

            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'

            , base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            }

            , format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }

        return function(table, name) {

            if (!table.nodeType) table = document.getElementById(table)

            imgsrc2 = 'http://127.0.0.1/booking2/public/images/logo.jpg';

            var ctx = {
                worksheet: name || 'Worksheet'
                , imgsrc2: imgsrc2
                , table: table.innerHTML
            }

            window.location.href = uri + base64(format(template, ctx))

        }

    })();

    var d = new Date();
    var name = 'invoice_list' + d.getFullYear() + "-" + d.getMonth() + "-" + d.getDay();
    tableToExcel('testTable', name);

</script>
