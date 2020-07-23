@extends('userlayouts.userapp')
@section('content')
 
 
<h2 class="margin-bottom">{{__('custom.invoice')}}</h2> 
<div style="margin-right: -15px;" class="margin-bottom">
    <a class="btn btn-primary btn-ExtrAdd" href="{{url('/')}}"><i class="fa fa-chevron-left"></i> &nbsp;{{ __('custom.back') }}</a>
    
    <form action="{{ url('invoice/edit') }}" method="GET" style="display: inline-block;">
    
        <input type="hidden" name="id" value="{{$data[0]->id}}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> &nbsp;{{__('custom.edit') }}</button>
    </form>

    <form action="{{ url('invoice/pdf') }}" method="post" style="display: inline-block;">
        @csrf
        <input type="hidden" name="id" value="{{$data[0]->id}}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> &nbsp;{{__('custom.PDF') }}</button>
    </form>
</div>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<style type="text/css">
  .col-md-center {
    text-align: center;
  }


  .excel-wrap {
    background:   white;
    padding:  20px 50px;
  }
  .excel-wrap .title  {
    border-bottom: 2px solid black;
  }

  .border-bottom {
    border-bottom: 1px solid #eee;
  }

  .margin-bottom-20 {
    margin-bottom: 20px;
  }

  .excel-wrap .row {
    margin-bottom : 20px;
  }

  .excel-wrap > div > div> div >input {
    margin-bottom: -1px;
    border-color: #eee;
    border-bottom: none;

  }

  .width-100 {
    width: 100%;
  }

  .excel-wrap > div > div> div> textarea {
    border-color: #eee;
  }

  .padding-bottom {
    padding-bottom: 10px; 
  }

  .form-control[readonly] {
    background-color: white; 
  }

</style>
<div class="container  excel-wrap">
    <div class="row title"> 
      <h2 class="col-md-center">SERVICIO FLETADO (c.f.s.)</h2>
    </div>
    
    <div class="row border-bottom ">
      <div class="col-md-10 ">
        <div class="col-md-2">
          TRASLADO: <!--transfer-->
        </div>
        <div class="col-md-2">
          <input type="text" name="transfer" class="form-control" readonly value="{{$data[0]->transfer}}"> 
        </div>
        <div class="col-md-2">
          DISPOSICION: <!--disposition-->
        </div>
        <div class="col-md-2">
          <input type="text" name="destination" class="form-control" readonly value="{{$data[0]->statusId}}">
        </div>
      </div>
    </div>

    <div class="row border-bottom ">
      <div class="col-md-12 padding-bottom">
        <div class="col-md-2">
          ORIGEN:
        </div>
        <div class="col-md-10">
          {{$data[0]->origin}}
        </div>
      </div>
    </div>

    <div class="row border-bottom padding-bottom">
      <div class="col-md-12"> 
        <div class="col-md-2">
          DESTINO:
        </div>
        <div class="col-md-10">
          {{$data[0]->destination}}
        </div>
      </div>
    </div>

    <div class="row  ">
        <div class="col-md-4 border-bottom padding-bottom">
          <div class="col-md-2">FETCHA:</div>
          <div class="col-md-2">
            {{$data[0]->BTDate}}
          </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4 border-bottom padding-bottom">
          <div class="col-md-2">
            HORA:
          </div>

          <div class="col-md-2">
            {{$data[0]->BTTime}}
          </div>
        </div>
    </div>

    <div class="row ">
      <div class="col-md-12">
        <div class="col-md-6">
          <span>IMPORTE(10% IVA INCLUIDO)</span>
        </div>

        <div class="col-md-6">
        
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">   
        <div class="col-md-4">
          <textarea rows="10" class="width-100">
            {{$data[0]->Price}}    
          </textarea>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-6">
          <span>OBSERVACIONES:</span>
        </div>

        <div class="col-md-6">
          
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">   
        <div class="col-md-12">
          <textarea rows="10" class="width-100">
            {{$data[0]->observation}}
          </textarea>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-md-12">
      <div class="col-md-4">
        MATRICULA VEHICULO 
      </div>
      <div class="col-md-8">
        {{$data[0]->DFlightNo}}
      </div>
      </div>
    </div>
</div>
@endsection