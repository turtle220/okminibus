<style>

div

{

	box-sizing: border-box;

	-moz-box-sizing:    border-box;

	-webkit-box-sizing: border-box;	

}

</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<div style="box-sizing: border-box;-moz-box-sizing:    border-box;-webkit-box-sizing: border-box;">

	<img style="position:absolute;top:10px;left:10px;width:682px" src="{{ asset('images/itt.jpg') }}"/>

	<div style="position:absolute;top:240px;left:10px;width:680px;height:55px;font-size:28px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#f00;background:#ccc">

			SERVICIO DE RESERVA DE BOLETOS

	</div>

	

	<div style="position:absolute;top:295px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Reserva Nº

	</div>

	<div style="position:absolute;top:295px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->BTicketRef }}

	</div>

	

	<div style="position:absolute;top:345px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Hotel

	</div>

	<div style="position:absolute;top:345px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->Hotel }}

	</div>

	

	<div style="position:absolute;top:395px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Nombre

	</div>

	<div style="position:absolute;top:395px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->Name }}

	</div>

	<div style="position:absolute;top:445px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Apellido

	</div>

	<div style="position:absolute;top:445px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->lastname }}

	</div>


	

	<div style="position:absolute;top:495px;left:10px;width:140px;height:50px;font-size:20px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			PASAPORTE

	</div>

	<div style="position:absolute;top:495px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->Passport }}

	</div>

	

	<div style="position:absolute;top:545px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Teléfono

	</div>

	<div style="position:absolute;top:545px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->Phone }}

	</div>

	

	

	

	<div style="position:absolute;top:595px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Fecha

	</div>

	<div style="position:absolute;top:595px;left:150px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->BTDate }}

	</div>

	<div style="position:absolute;top:595px;left:350px;width:100px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Hora 

	</div>

	<div style="position:absolute;top:595px;left:450px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->BTTime }}

	</div>

	
	<div style="position:absolute;top:645px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Tipo

	</div>

	<div style="position:absolute;top:645px;left:150px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			
	@if ($BookingTicket->TypeId == 'A')

			Traslado
	@else

			Disposici�n

	@endif

	</div>

	

	

	<div style="position:absolute;top: 645px;left:350px;width:100px;height:50px;font-size:18px;font-weight:bold;border:1px solid #000;text-align:center;line-height:23px;color:#fff;background:#999">

			NÚMERO DE VUELO

	</div>

	<div style="position:absolute;top:645px;left:450px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->DFlightNo }}

	</div>

	

	

		

	

	<div style="position:absolute;top:695px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			PAX

	</div>

	<div style="position:absolute;top:695px;left:150px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->PAX }}

	</div>

	<div style="position:absolute;top:695px;left:350px;width:100px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			PRECIO

	</div>

	<div style="position:absolute;top:695px;left:450px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->Price }}

	</div>


	<div style="position:absolute;top:745px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Coche

	</div>

	<div style="position:absolute;top:745px;left:150px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->carname }}

	</div>

	<div style="position:absolute;top:745px;left:350px;width:100px;height:50px;font-size:17px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Observaci�n

	</div>

	<div style="position:absolute;top:745px;left:450px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->observation }}

	</div>




	<div style="position:absolute;top:795px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Origen

	</div>

	<div style="position:absolute;top:795px;left:150px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->origin }}

	</div>

	<div style="position:absolute;top:795px;left:350px;width:100px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:center;line-height:43px;color:#fff;background:#999">

			Destino
	</div>

	<div style="position:absolute;top:795px;left:450px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{ $BookingTicket->destination}}

	</div>




	<div style="position:absolute;top:845px;left:10px;width:140px;height:50px;font-size:18px;font-weight:bold;border:1px solid #000;text-align:center;line-height:23px;color:#fff;background:#999">

			extras (bike, glof,etc...)

	</div>

	<div style="position:absolute;top:845px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #000;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">

			{{$BookingTicket->extra}}

	</div>

	

	



</div>	