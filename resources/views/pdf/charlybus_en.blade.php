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
	<img style="position:absolute;top:10px;left:200px;width:300px" src="{{ asset('images/oklogo.jpeg') }}"/>
	<div style="position:absolute;top:150px;left:10px;width:680px;height:35px;font-size:15px;text-align:center;line-height:18px;color:#f60">
		<br/><br/>
		phone number: 0034 674 075 933<br/>
		mail: reservas@okminibusmallorca.com <br/>
		Ok mini bus Mallorca empresa de transporte de personas en Mallorca<br/>
																		  <br/>	
	</div>
	
	<div style="position:absolute;top:270px;left:10px;width:680px;height:55px;font-size:28px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			TICKET BOOKING SERVICE
	</div>
	
	<div style="position:absolute;top:325px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			BOOKING Nº
	</div>
	<div style="position:absolute;top:325px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->BTicketRef }}
	</div>
	
	<div style="position:absolute;top:375px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			HOTEL
	</div>
	<div style="position:absolute;top:375px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->Hotel }}
	</div>
	
	<div style="position:absolute;top:425px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			NAME
	</div>
	<div style="position:absolute;top:425px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->Name }}
	</div>
	
	<div style="position:absolute;top:475px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			PASSPORT
	</div>
	<div style="position:absolute;top:475px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->Passport }}
	</div>
	
	<div style="position:absolute;top:525px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			PHONE
	</div>
	<div style="position:absolute;top:525px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->Phone }}
	</div>
	
	
	
	<div style="position:absolute;top:575px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			DATE
	</div>
	<div style="position:absolute;top:575px;left:150px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->BTDate }}
	</div>
	<div style="position:absolute;top:575px;left:350px;width:100px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			TIME
	</div>
	<div style="position:absolute;top:575px;left:450px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->BTTime }}
	</div>
	
	
	
	<div style="position:absolute;top:625px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
	@if ($BookingTicket->TypeId == 'A')
			ARRIVAL
	@else
			DEPARTURE
	@endif
	</div>
	<div style="position:absolute;top:625px;left:150px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			
	</div>
	<div style="position:absolute;top:625px;left:350px;width:100px;height:50px;font-size:18px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:23px;color:#fff;background:#f60">
			FLIGHT NUMBER
	</div>
	<div style="position:absolute;top: 625px;left:450px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->DFlightNo }}
	</div>
	
	
		
	
	<div style="position:absolute;top:675px;left:10px;width:140px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			PAX
	</div>
	<div style="position:absolute;top:675px;left:150px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->PAX }}
	</div>
	<div style="position:absolute;top:675px;left:350px;width:100px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:43px;color:#fff;background:#f60">
			PRICE
	</div>
	<div style="position:absolute;top:675px;left:450px;width:230px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{ $BookingTicket->Price }}
	</div>
	
	<div style="position:absolute;top:725px;left:10px;width:140px;height:50px;font-size:18px;font-weight:bold;border:1px solid #fff;text-align:center;line-height:23px;color:#fff;background:#f60">
			extras (bike, glof,etc...)
	</div>
	<div style="position:absolute;top:725px;left:150px;width:530px;height:50px;font-size:24px;font-weight:bold;border:1px solid #fff;text-align:left;line-height:43px;color:#000;background:#ccc;padding-left:10px">
			{{$BookingTicket->extra}}
	</div>
	
	

</div>