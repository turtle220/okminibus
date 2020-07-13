<div class="modal-dialog eddialog" role="document">
<!-- <div class="modal-dialog eddialog"> -->
    <div class="modal-content">
	      <div class="modal-header">
	         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      </div>
	      <div class="modal-body" style="height:450px;overflow:auto;">
	      	<div class="DocumentsZone">
		        <div class="DocsLabel" style="width:65%">{{ __('custom.ticketinformation') }}</div>
		    </div>
	        <div class="fieldsRow">
	      		<div class="fieldsLabel">{{ __('custom.number') }}:</div><div class="fieldsValue">{{ $BookingTicket->BTicketRef }}</div>
	      		<div class="fieldsLabel">{{__('custom.state') }}:</div><div class="fieldsValue">{{ $BookingTicket->Status }}</div>
	      	</div>
	        <div class="fieldsRow">
	      		<div class="fieldsLabel">{{__('custom.hotel')}}:</div><div class="fieldsValue">{{ $BookingTicket->Hotel }}</div>
	      		<div class="fieldsLabel">{{__('custom.number')}}:</div><div class="fieldsValue">{{ $BookingTicket->Name }}</div>
	      	</div>
	        <div class="fieldsRow">
	      		<div class="fieldsLabel">{{__('custom.passport')}}:</div><div class="fieldsValue">{{ $BookingTicket->Passport }}</div>
	        	<div class="fieldsLabel">{{__('custom.phone') }}:</div><div class="fieldsValue">{{ $BookingTicket->Phone }}</div>
	      	</div>
	        <div class="fieldsRow">
	      		<div class="fieldsLabel">{{ __('custom.date') }}:</div><div class="fieldsValue">{{ $BookingTicket->BTDate }}</div>
	      		<div class="fieldsLabel">{{__('custom.time')}}:</div><div class="fieldsValue">{{ $BookingTicket->BTTime }}</div>
	      	</div>
	      	<div class="fieldsRow">
	      		<div class="fieldsLabel">{{__('custom.type')}}:</div><div class="fieldsValue">{{ $BookingTicket->Type }}</div>
	      		<div class="fieldsLabel">{{__('custom.flight')}}:</div><div class="fieldsValue">{{ $BookingTicket->DFlightNo }}</div>
	      	</div>
	      	<div class="fieldsRow">
	      		<div class="fieldsLabel">{{__('custom.fax')}}:</div><div class="fieldsValue">{{ $BookingTicket->PAX }}</div>
	      		<div class="fieldsLabel">{{__('custom.price')}}:</div><div class="fieldsValue">€&nbsp{{  $BookingTicket->Price }}</div>
	      	</div>
	      	
	      	
	      </div>
	      <div class="modal-footer">
	        <a class="btn btn-default" target="_blank" href="{{ url('/BookingTickets/PdfTicket/'.$BookingTicket->id)  }}">{{ __('custom.generatepdf') }}</a><!--Genera Pdf-->
	      	<button type="button" class="btn btn-default" onClick="EditBookingTicket('{{ $BookingTicket->BTicketId }}')">{{__('custom.edit')}}</button><!--Editar-->
	      	<button type="button" class="btn btn-primary" data-dismiss="modal">{{__('custom.cancel')}}</button>
	      </div>
	</div>
</div>  
