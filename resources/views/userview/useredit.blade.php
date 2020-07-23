@extends('userlayouts.userapp')

@section('content')
<h2>User Edit</h2>



<div class="card">

    <div class="card-header">
        <strong>User </strong> Form
    </div>
    <div class="card-body card-block">
        <form id="useredit" method="get" action="{{ url('/user/update') }}">
            @csrf
            <input type="hidden" value="@if(isset($value[0]['id'])) {{$value[0]['id']}} @else {{ old('id') }}@endif" name="id">
            <div class="row form-group">
                <div class="col col-md-3"><label for="name" class=" form-control-label">{{ __('custom.username') }}</label></div>
                <div class="col-12 col-md-9">
                    <input type="text" id="name" name="name" placeholder="Enter Name..." class="form-control  @error('name') is-invalid @enderror" value="@if(isset($value[0]['name'])) {{$value[0]['name']}} @else{{old('name')}} @endif" required autocomplete="name"></div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row form-group">
                <div class="col col-md-3"><label for="firstname" class=" form-control-label">{{ __('custom.firstname') }}</label></div>
                <div class="col-12 col-md-9"><input type="text" id="firstname" name="firstname" placeholder="Enter firstname..." class="form-control  @error('firstname') is-invalid @enderror" value="@if(isset($value[0]['firstname'])){{ $value[0]['firstname'] }}@else{{ old('firstname')}} @endif" required autocomplete="firstname"></div>
                @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row form-group">
                <div class="col col-md-3"><label for="lastname" class=" form-control-label">{{ __('custom.lastname') }}</label></div>
                <div class="col-12 col-md-9"><input type="text" id="lastname" name="lastname" placeholder="Enter lastname..." class="form-control  @error('lastname') is-invalid @enderror" value="@if(isset($value[0]['lastname'])){{ $value[0]['lastname'] }}@else{{ old('lastname')}} @endif" required autocomplete="lastname"></div>
                @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row form-group">
                <div class="col col-md-3"><label for="email" class=" form-control-label">{{ __('E-Mail Address') }}</label></div>
                <div class="col-12 col-md-9">
                    <input type="email" id="email" name="email" placeholder="Enter Email..." class="form-control  @error('email') is-invalid @enderror" value="@if(isset($value[0]['email'])) {{ $value[0]['email'] }} @else {{old('email')}} @endif" required autocomplete="email">
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <input type="submit" class="btn btn-primary" value="Update">
        </form>
    </div>

</div>
</div>
@endsection
