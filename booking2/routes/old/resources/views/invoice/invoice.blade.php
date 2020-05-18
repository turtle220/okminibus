@extends('userlayouts.userapp')
@section('content')

<!-- user Table -->
<h2 class="margin-bottom">Invoice list</h2> 
<div class="animated fadeIn">
    <div class="margin-right margin-bottom">
        <!-- <button class="btn btn-primary pull-right  margin-bottom"><a class="white" href="{{ url('/user/create') }}"><i class="fa fa-plus">{{__('custom.newuser')}}</i></a></button> -->
        <label class="pull-left margin-right">User:</label>
        <form action="{{ url('invoice') }}" method="GET" class="pull-left">
        	
	        <select class="form-control col-md-10" name="username" id="username">
	        	<option @if($curuser == 0)selected @endif value="0">{{__('custom.all')}}</option>
	        	@foreach($users as $val)
                    <?php $str1 = str_replace(" ", '', $curuser);
                          $str2 = str_replace(" ", '', $val->Name); ?>
	        		<option @if( strcasecmp($str1, $str2) == 0)selected @endif>{{$val->Name}}</option>
	        	@endforeach
	        </select>
	        <input type="submit" class="hidden" id="invoice-submit">
        </form>
        <form action="{{ url('invoicelist/pdf') }}" method="POST">
            @csrf
            <input type="hidden" name="name" id="name" value="{{$curuser}}">
            <button type="submit" class="btn btn-primary invoicelist-print"><i class="fa fa-print"></i>&nbsp;PDF
            </button>
        </form>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ __('custom.invoicetable') }}</strong>
				</div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered col-md-center">
                    	<thead>
                            <tr>
                            	<th>{{ __('custom.no') }}</th>
                                <th>{{ __('custom.name') }}</th>
                                <th>{{ __('custom.date') }}</th>
                                <th>{{ __('custom.amount') }}</th>
                                <th>{{ __('custom.destination') }}</th>
                                <th>{{ __('custom.provider') }}</th>
                                <th>{{ __('custom.viewinvoice') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php $i =1; ?>
                        	@foreach($values as $val) 
	                        	<tr>
	                        		<input type="hidden" name="userId" class="user_id" value="{{$val->id}}">
	                        		<td>{{ $i }}</td>
	                            	<td>{{ $val->Name }}</td>
	                                <td>{{ $val->BTDate }}</td>
	                                <td>${{ $val->Price }}</td>
	                                <td>{{ $val->Hotel }}</td>
									<td>{{ $val->name}}</td>
	                                <td>
	                                	<form method="POST" action="{{ url('viewinvoice') }}">
										@csrf
											<input type="hidden" name="id"  value="{{$val->id}}">
											<button typr="submit" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp;{{ __('custom.invoice') }}</button>
										</form>
									</td>
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