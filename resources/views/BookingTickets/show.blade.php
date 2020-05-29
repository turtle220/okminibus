<div class="modal-dialog eddialog" role="document">

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

	      		<div class="fieldsLabel">{{__('custom.car') }}:</div><div class="fieldsValue">{{ $BookingTicket->carnumber}}</div>

	      	</div>

	        <div class="fieldsRow">

	      		<div class="fieldsLabel">{{__('custom.hotel')}}:</div><div class="fieldsValue">{{ $BookingTicket->Hotel }}</div>

	      		<div class="fieldsLabel">{{__('custom.name')}}:</div><div class="fieldsValue">{{ $BookingTicket->Name }}</div>

	      	</div>

	        <div class="fieldsRow">

	      		<div class="fieldsLabel">{{__('custom.passport')}}:</div><div class="fieldsValue">{{ $BookingTicket->Passport }}</div>
			
			<div class="fieldsLabel">{{__('custom.servicetype')}}:</div><div class="fieldsValue">{{ $BookingTicket->sd }}</div>

	        	<!--<div class="fieldsLabel">{{__('custom.lastname')}}:</div><div class="fieldsValue">{{ $BookingTicket->lastname }}</div>-->

	      	</div>

	        <div class="fieldsRow">

	      		<div class="fieldsLabel">{{ __('custom.date') }}:</div><div class="fieldsValue">{{ $BookingTicket->BTDate }}</div>

	      		<div class="fieldsLabel">{{__('custom.phone') }}:</div><div class="fieldsValue">{{ $BookingTicket->Phone }}</div>

	      		

	      	</div>

	      	<div class="fieldsRow">

	      		<div class="fieldsLabel">{{__('custom.type')}}:</div><div class="fieldsValue">
				@if($BookingTicket->TypeId == 'A'){{__('custom.Arrival') }}@elseif($BookingTicket->TypeId == 'D'){{__('custom.Exit')}} @endif
		        

			</div>

	      		<div class="fieldsLabel">{{__('custom.time')}}:</div><div class="fieldsValue">{{ $BookingTicket->BTTime }}</div>

	      		

	      	</div>

	      	<div class="fieldsRow">

	      		<div class="fieldsLabel">{{__('custom.fax')}}:</div><div class="fieldsValue">{{ $BookingTicket->PAX }}</div>

	      		<div class="fieldsLabel">{{__('custom.flight')}}:</div><div class="fieldsValue">{{ $BookingTicket->DFlightNo }}</div>	

	      	</div>

	      	<div class="fieldsRow">

	      		<div class="fieldsLabel">{{__('custom.origin')}}:</div><div class="fieldsValue"><!--origen-->

					{{ $BookingTicket->origin }}

	      		</div>



	      		<div class="fieldsLabel">{{__('custom.price')}}(€):</div><div class="fieldsValue">{{ $BookingTicket->Price }}</div>

	      		

	      	</div>



	      	<div class="fieldsRow">

      			<div class="fieldsLabel">{{__('custom.extra')}}:</div><div class="fieldsValue"><!--Traslado -->

					{{ $BookingTicket->extra }}

	      		</div>

	      		<div class="fieldsLabel">{{__('custom.observation')}}:</div><div class="fieldsValue"><!--observation-->

					{{ $BookingTicket->observation }}

	      		</div>

	      		

	      	

	      		<!-- <div class="fieldsLabel">{{__('custom.provision')}}:</div><div class="fieldsValue"> --><!--Disposicion-->

					<!-- <input id="provision" name="provision" type="text" class="form-control" placeholder="Introduce Disposicion" value="{{ $BookingTicket->Price }}" />

	      		</div> -->

	      	</div>

	      	<div class="fieldsRow">



	      		

	      		<div class="fieldsLabel">{{__('custom.destination')}}:</div>

	      		<div class="fieldsValue"><!--PAX-->

					{{ $BookingTicket->destination }}

				</div>

	      		<!-- <div class="fieldsLabel">{{__('custom.provision')}}:</div><div class="fieldsValue"> --><!--Disposicion-->

					<!-- <input id="provision" name="provision" type="text" class="form-control" placeholder="Introduce Disposicion" value="{{ $BookingTicket->Price }}" />

	      		</div> -->

	      	</div>

	      



	      	

	      </div>

	      <div class="modal-footer">

	        <a class="btn btn-default" target="_blank" href="{{ url('/BookingTickets/PdfTicket/'.$BookingTicket->id)  }}">{{ __('custom.generatepdf') }}</a><!--Genera Pdf-->

	      	<button type="button" class="btn btn-default" onClick="EditBookingTicket('{{ $BookingTicket->BTicketId }}')">{{__('custom.edit')}}</button><!--Editar-->

	      	<button type="button" class="btn btn-primary" data-dismiss="modal">{{__('custom.cancel')}}</button>

	      </div>

	</div>

</div>

