@extends('layouts.backend')

@section("content")
<div class="col-md-10 col-md-offset-1" style="text-align:center;margin-top:50px">
<h1>Listado tickets</h1>
<button class="btn btn-primary btn-ExtrAdd" onClick="EditBookingTicket('')">Nuevo Ticket</button>
</div>
	<div class="col-md-10 col-md-offset-1">
		<table class="table">
		  <thead class="thead-inverse">
		  </tbody>
		</table>
		
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
		      <th class="col-md-1"><a href="/BookingTickets/all/1">Código</a></th>
		      <th class="col-md-2"><a href="/BookingTickets/all/3">Fecha</a></th>
		      <th class="col-md-2"><a href="/BookingTickets/all/3">Hotel</a></th>
		      <th class="col-md-4"><a href="/BookingTickets/all/2">Nombre</a></th>
		      <th class="col-md-1"><a href="/BookingTickets/all/4">Estado</a></th>
		    </tr>
		  </thead>
		  <tbody>
			@foreach ($BookingTickets2 as $BookingTicket)
			    <tr class="HandCursors SelectableLine" data-toggle="modal" onClick="ShowBookingTicket('{{$BookingTicket["BTicketId"]}}')">
			      <th scope="row">{{$BookingTicket["BTicketRef"]}}</th>
			      <td>{{$BookingTicket["BTDate"]}}</td>
			      <td>{{$BookingTicket["Hotel"]}}</td>
			      <td>{{$BookingTicket["Name"]}}</td>
   			      <td>{{$BookingTicket["StatusId"]}}</td>
			    </tr>
			@endforeach
		  </tbody>
		</table>
	</div>
	{{ $BookingTickets->render() }}
@endsection	

@section("modals")
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" style="z-index:1060" aria-labelledby="myModalLabel">
</div>
		
@endsection