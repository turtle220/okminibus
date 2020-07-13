<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->



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

	.pdf-wrap >table,.pdf-wrap > thead,.pdf-wrap > table > thead > tr, th {

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

	.table >thead >tr >th {

		vertical-align: middle;

		text-align: center;

	}



	tbody > tr, td {

		border: 1px solid black;

			

	}



	tbody > tr > td {

		padding: 10px;

	}





</style>

<div class="container pdf-wrap">

	<table class="table col-md-center">

		<thead>

			<tr>

				<th colspan="10"> Factura Simplificada</th>

			</tr>



			<tr>

				<th rowspan="2" colspan="3"><img  src="{{ asset('images/logo.png') }}"></th>

				<th colspan="7" class="border-bottom-1">EMPRESA</th>

			</tr>

			<tr>

				<th colspan="7"> ISLAND TOUR & TRANSFER S.L.U. B-16561540 </th>

				

			</tr>


			<tr>

				<th colspan="3">

					VEHICULO 6367JNP 

				</th>

				<th colspan="7">

					COND. P.ROIG GARCIAS 43056156

				</th>

			</tr>

			<tr>
				<th style="width: 10%;">FECHA</th>

				<th style="width: 10%;">NUM.FACTURA</th>

				<th style="width: 10%;">NOMBRE</th>

				<th style="width: 20%;">IMPORTE</th>

				<th colspan="4">OBSERVACIONES</th>

				<th colspan="2">MATRICULA</th>

			</tr>

		</thead>

		<tbody>

			<?php $count=14  ?>

			@foreach($data as  $val)

			<tr>

				<td>{{$val->BTDate}}</td>

				<td>{{$val->BTicketRef}}</td>

				<td>{{$val->Name}}</td>

				<td>{{$val->Price}}</td>

				<td colspan="4">{{$val->observation}}</td>

				<td colspan="2" >{{$val->carnumber}}</td>

			</tr>

			<?php $count--;?>

			@endforeach



			<!-- @for($i = 0; $i < $count; $i++)

			<tr>

				<td></td>

				<td></td>

				<td></td>

				<td></td>

				<td></td>

				<td></td>

				<td></td>

				<td></td>

				<td></td>

				<td></td>

			</tr>

			@endfor -->

		</tbody>

	</table>



	<div class="footer" style="width: 80%; vertical-align: bottom;">

		<div style="width: 100%; margin-top:  3px; margin-bottom: 3px">SD- SERVICIO DISCRECIONAL</div>

		<div style="width: 100%; margin-bottom: 3px">TU-TRANSPORTE TURISTICO</div>

		<div style="width: 100%; margin-bottom: 3px">DR- DISCRECIONAL REFUREZO SERVICIO PUBLICO REGULAR GENERAL</div>

		<div style="width: 100%; margin-bottom: 3px">DC- DISCRECIONAL COLABORADOR SERVICIO PUBLICO REGULAR ESPECIA	</div>

	</div>

</div>