
@extends('userlayouts.userapp')

@section('content')

<!-- user Table -->
<h2 class="margin-bottom">Booking Ticket Management</h2> 
<div class="animated fadeIn">
	<div class="button-wrap">
	<button class="btn btn-primary btn-ExtrAdd pull-right margin-bottom" onClick="EditBookingTicket('')"><i class="fa fa-plus"></i>{{ __('custom.newticket') }}</button>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Booking Ticket Table</strong>
				</div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export col-md-center" class="table table-striped table-bordered col-md-center">
                    	<thead>
                            <tr>
                            	<th>{{ __('custom.code') }}</th>
                                <th>{{ __('custom.close') }}</th>
                                <th>{{ __('custom.hotel') }}</th>
                                <th>{{ __('custom.name')  }}</th>
                                <th>{{ __('custom.status') }}</th>
                                <th>{{ __('custom.viewinvoice') }}</th>
                                <th>{{ __('custom.viewshow') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($values as $BookingTicket)
							    <tr  >
							      <td>{{ $BookingTicket->BTicketRef }}</th>
							      <td>{{ $BookingTicket->BTDate }}</td>
							      <td>{{ $BookingTicket->Hotel }}</td>
							      <td>{{ $BookingTicket->Name }}</td>
				   			      <td>{{ $BookingTicket->StatusId }}</td>
                                  <td>
                                    <form method="POST" action="{{ url('viewinvoice') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$BookingTicket->id}}">
                                        <button type="submit" class="btn btn-primary" value="{{__('custom.viewinvoice') }}"><i class="fa fa-eye"></i>{{__('custom.viewinvoice')}}</button>
                                    </form>
                                    <!-- <a href="{{url('viewinvoice?$id='.$BookingTicket->id)}}">{{ __('custom.viewinvoice') }}</a> -->
                                  </td> 

                                  <td >
                                    <button class="HandCursors SelectableLine btn btn-primary" data-toggle="modal" onClick="ShowBookingTicket('{{$BookingTicket->BTicketId}}')" >{{__('custom.viewshow')}}</button>
                                  </td>
				   			  	</tr>
							@endforeach
                        </tbody>
                    </table>
                </div> <!-- end of car-body-->
            </div><!--end of card-->
        </div><!-- end of col-md-12 -->
    </div><!-- end of col-row-->
</div>            
@endsection

@section("modals")
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   
    
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" style="z-index:1060" aria-labelledby="myModalLabel">
   
   
</div>
@endsection
