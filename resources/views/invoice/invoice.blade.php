@extends('userlayouts.userapp')
@section('content') 

<!-- user Table -->
<h2 class="margin-bottom">Invoice list</h2> 
<div class="animated fadeIn">
    <div class="margin-right margin-bottom" style="display:flex">
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

            <form action="{{ url('invoice') }}" method="get">

                <div class="col-md-5">


                    <div class="col-md-3">


                    <label class="padding-top-5">{{__('custom.from')}}:</label>


                    </div>

                    <div class="col-md-9">


                    <input type="date" class="form-control"  value="{{old('from')}}" name="from">


                    </div>


                </div>

                <div class="col-md-5">


                    <div class="col-md-3">


                    <label class="padding-top-5">{{__('custom.to')}}:</label>


                    </div>


                    


                    <div class="col-md-9">


                    <input type="date" class="form-control" value="{{old('to')}}" name="to">


                    </div>


                </div>

                <div class="col-md-2">

                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> &nbsp;{{__('custom.search') }}</button>

                </div>

            </form>

            <form action="{{ url('invoicelist/pdf') }}" method="POST" style="float: left; margin-right:20px;">
                @csrf
                <input type="hidden" name="name" id="name" value="{{$curuser}}">
                <button type="submit" class="btn btn-primary invoicelist-print"><i class="fa fa-print"></i>&nbsp;PDF
                </button>
            </form>
        
            <form action="{{ url('invoicelistexcel') }}" method="GET">
                
                <input type="hidden" name="name" id="name" value="{{$curuser}}">
                <button type="submit" class="btn btn-primary invoicelist-print"><i class="fa fa-print"></i>&nbsp;Excel
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
                                <th>
                                    <div class="pretty p-icon  p-locked all1">
                                                        <input type="checkbox"  @if($allStatus == true)checked @endif>
                                                        
                                                        <div class="state p-success">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                        
                                                        </div> 
                                </th>
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
	                                <td>{{ $val->Price }}</td>
	                                <td>{{ $val->Hotel }}</td>
									<td>{{ $val->name}}</td>
	                                <td>
	                                	<form method="POST" action="{{ url('viewinvoice') }}">
										@csrf
											<input type="hidden" name="id"  value="{{$val->id}}">
											<button typr="submit" class="myButton"><i class="fa fa-eye"></i>&nbsp;{{ __('custom.invoice') }}</button>
										</form>
									</td>

                                    <td>

                                        <div class="pretty p-icon p-round p-locked single-check1">

                                            <input type="checkbox" @if($val->checkstatus != NULL) checked @endif />

                                            <!-- <input type="checkbox"checked /> -->

                                            <div class="state p-success">

                                                <i class="icon fa fa-check"></i>

                                                <label></label>

                                            </div>

                                            <input type="hidden" id="rowid" value="{{$val->id}}">

                                        </div>                                  

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