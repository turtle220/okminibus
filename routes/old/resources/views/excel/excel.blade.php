
@extends('userlayouts.userapp')

@section("content")
<style type="text/css">
	.padding-top-5 {
		padding-top: 5px;
	}
</style>
<h2 class="margin-bottom">{{__('custom.generateroadmapinexcel')}}</h2> 
<div class="animated fadeIn">
    <div class="row margin-bottom">
    	<div class="col-md-8 margin">
    		<form action="{{ url('excel') }}" method="get">
    			<div class="col-md-3">
    			<div class="col-md-4">
    			  <label class="padding-top-5">{{__('custom.client')}}:  </label>
    			</div>
    			  <div class="col-md-6"> 
	    			  <select name="username" class="form-control">
	    				@if(old('username') == '0')
	    					<option value="0" selected>{{ __('custom.all') }}</option>
	    				@else
	    					<option value="0">{{ __('custom.all') }}</option>
	    				@endif

	    			  	@foreach($users as $user)
	    			  	 <?php $str1 = str_replace(" ", '', $user->Name);
                          $str2 = str_replace(" ", '', old('username')); ?>
	    			  		@if($str1 == $str2)
	    			  			 <option value="{{ $user->Name }}" selected>{{ $user->Name }}</option>
	    			  		@else
	    			  			 <option value="{{ $user->Name }}">{{ $user->Name }}</option>
	    			  		@endif
	    			  	@endforeach
	    			  </select>	
    			  </div>
    			</div>

    			<div class="col-md-4">
	    			<div class="col-md-3">
	    			  <label class="padding-top-5">{{__('custom.from')}}:</label>
	    			</div>

	    			<div class="col-md-9">
	    			  <input type="date" class="form-control"  value="{{old('from')}}" name="from">
	    			</div>
    			</div>

    			<div class="col-md-4">
	    			<div class="col-md-3">
	    			  <label class="padding-top-5">{{__('custom.to')}}:</label>
	    			</div>
	    			
	    			<div class="col-md-9">
	    			  <input type="date" class="form-control" value="{{old('to')}}" name="to">
	    			</div>
    			</div>

    			<div class="col-md-1">
        		  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> &nbsp;{{__('custom.search') }}</button>
    			</div>
    		</form>
    	</div>
    	<div class="col-md-4">
    		<div class="col-md-6">
    			<form method="POST" action="{{ url('excel/print')}}">
    				
    				@csrf
    				<input type="hidden" name="from" value="{{old('from')}}">
    				<input type="hidden" name="to" value="{{old('to')}}">
    				<input type="hidden" name="username" value="{{old('username')}}">
    				<button type="submit"  class="btn btn-primary"><i class="fa fa-print"></i>{{__('custom.excel')}}</button>
    			</form>
    		</div>
    		<div class="col-md-6"><label class="padding-top-5">{{__('custom.reservations')}}:</label> {{$count}}</div>
    	</div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{__('custom.roadmaptable')}}</strong>
				</div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered col-md-center">
                    	<thead>
                            <tr>
                            	<th>{{ __('custom.no') }}</th>
                            	<th>{{ __('custom.bticketid')}}
                                <th>{{ __('custom.username') }}</th>
                                <th>{{ __('custom.price') }}</th>
                                <th>{{ __('custom.destination') }}</th>
                                <th>{{ __('custom.vichleno')}}</th>
                                <th>{{ __('custom.provider') }}</th>
                                <th>{{ __('custom.created') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php $i =1; ?>
                        	@foreach($values as $val) 
	                        	<tr>
	                        		<input type="hidden" name="userId" class="user_id" value="{{$val->id}}">
	                        		<td>{{ $i }}</td>
	                            	<td>{{ $val->BTicketId }}</td>
	                                <td>{{ $val->Name }}</td>
	                                <td>{{ $val->Price }}</td>
	                                <td>{{ $val->Hotel }}</td>
	                                <td>{{ $val->DFlightNo}}</td>
	                                <td>{{ $val->name }}</td>
	                                <td>{{ $val->created_at}}</td>
									
	                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end of car-body-->
            </div><!--end of card-->
        </div><!-- end of col-md-12 -->
    </div><!-- end of col-row-->
</div>            

@endsection