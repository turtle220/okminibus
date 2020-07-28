@extends('userlayouts.userapp')

@section('content')

<!-- user Table -->
<h2 class="margin-bottom">{{__('custom.usermanagement')}}</h2>
<div class="animated fadeIn">
    <div class="button-wrap">
        <button class="btn btn-primary pull-right  margin-bottom"><a class="white" href="{{ url('/user/create') }}"><i class="fa fa-plus">{{__('custom.newuser')}}</i></a></button>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{__('custom.usertable')}}</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered col-md-center">
                        <thead>
                            <tr>

                                <th>{{ __('custom.no') }}</th>
                                <th>{{ __('custom.firstname') }}</th>
                                <th>{{ __('custom.lastname') }}</th>
                                <th>{{ __('custom.email') }}</th>
                                <th>{{ __('custom.position') }}</th>
                                <!-- <th>{{ __('custom.edit') }}</th> -->
                                <th>{{ __('custom.delete') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1; ?>
                            @foreach($values as $val)
                            <tr>
                                <input type="hidden" name="userId" class="user_id" value="{{$val->id}}">
                                <td>{{ $i }}</td>
                                <td>{{ $val->firstname }}</td>
                                <td>{{ $val->lastname }}</td>
                                <td>{{ $val->email }}</td>
                                <td>
                                    <select class="role">
                                        <option @if($val->role ==1)selected @endif value="1">{{ __('custom.admin') }}</option>
                                        <option @if($val->role ==2)selected @endif value="2">{{ __('custom.employee') }}</option>
                                        <option @if($val->role ==3)selected @endif value="3">{{ __('custom.user') }}</option>
                                    </select>
                                </td>
                                <!-- <td>
										<form method="GET" action="{{ url('user/edit') }}">
											<input type="hidden" name="userId"  value="{{$val->id}}">
											<button type="submit" class="edit">{{ __('custom.edit') }}</button>
										</form>
									</td> -->

                                <td>
                                    <form method="post" action="{{ url('user/delete') }}">
                                        @csrf
                                        <input type="hidden" name="userId" value="{{$val->id}}">
                                        <button typr="submit" class="delete">{{ __('custom.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end of car-body-->
            </div>
            <!--end of card-->
        </div><!-- end of col-md-12 -->
    </div><!-- end of col-row-->
</div>

@endsection
