@extends('userlayouts.userapp')
@section('content')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<style type="text/css">

    .excel-wrap {
	    background:   white;
	    padding:  20px 50px;
	}
	
	.col-md-center {
		text-align: center;
	}


	.excel-wrap form .title  {
		border-bottom: 2px solid black;
	}

	.border-bottom {
		border-bottom: 1px solid #eee;
	}

	.margin-bottom-20 {
		margin-bottom: 20px;
	}

	.excel-wrap form .row {
		margin-bottom : 20px;
	}

	.excel-wrap > form > div > div> div >input {
		margin-bottom: -2px;
		border-color: #eee;
		border-bottom: none;

	}

	.width-100 {
		width: 100%;
	}

	.excel-wrap > form  > div > div> div> textarea {
		border-color: #eee;
	}

	.padding-bottom {
				padding-bottom: 1px; 
	}
	.excel-wrap form .col-md-2{
		margin-top: 4px;
	}

	.margin-top-4 {
		margin-top: 4px;
	}

	.red {
		color: red !important;
	}
</style>
<div style="margin-right: -15px;">
    
    <form action="{{ url('viewinvoice') }}" method="post" style="display: inline-block;">
        @csrf
        <input type="hidden" name="id" value="{{$value[0]->id}}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-chevron-left"></i> &nbsp;{{__('custom.back') }}</button>
    </form>
	
        
        
    <button class="btn btn-primary update-save"><i class="fa fa-file"></i> &nbsp;{{__('custom.save') }}</button>
    
</div>
	
	<div class="container excel-wrap widt">
		<form action="{{ url('invoice/update') }}" method="post" class="width-100">
			<input type="hidden" name="id" value="{{$value[0]->id}}">
			@csrf	
		
		<div class="row title">
      <div class="col-md-12 col-md-center">
        <h2 ><span class="red">ISLAND</span> TOUR & TRANSFER S.L.U</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3"><img src="{{asset('./images/logo.jpg')}}"></div>
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="row">CIF: B-16561540</div>
        <div class="row">C/ RAMON LLULL, 52 - 2'-1"</div>
        <div class="row">CP: 07320 STA.MARIA DEL CAMI</div>
        <div class="row">07320 ILLES BALEARS</div>
      </div>
    </div>

    <div class="row title">
      <div class="col-md-3"></div>
      <div class="col-md-4">FACTURA SIMPLIFICADA</div>
      <div class="col-md-3"></div>
	  <div class="col-md-2 red" style="display:flex">No <input type="text" class="form-control" name="origin" class="form-control" value="{{$value[0]->id}}"></div>
    </div>
    <div class="row border-bottom">
      <div class="col-md-1"> 
      CLIENTE:
      </div>
      <div class="col-md-3">
	  
			{{$value[0]->Name}}
      </div>
    </div>

    <div class="row border-bottom">
      <div class="col-md-1"> 
      D.N.I:
      </div>
      <div class="col-md-3">
	  <input type="text" class="form-control" name="passport" class="form-control" value="{{ $value[0]->Passport}}">
       
      </div>
    </div>
    <div class="row title"> 
      <div class="col-md-12 col-md-center">
		  
      <h2>SERVICIO FLETADO (c.f.s.)</h2>
      </div>
    </div>

		
		<div class="row border-bottom ">
			<div class="col-md-10 ">
				<div class="col-md-2">
					TRASLADO: <!--transfer-->
				</div>
				<div class="col-md-2">
					<select name="type" class="form-control" style="border-bottom:0px !important">
						<option value="A" @if($value[0]->TypeId == 'A')selected @endif>Traslado</option>	
					 	<option value="D" @if($value[0]->TypeId == 'D')selected @endif>Disposicion</option>	   
					</select>
				</div>
				<div class="col-md-2">
					DISPOSICION: <!--disposition-->
				</div>
				<div class="col-md-2">
					<input type="text" name="disposicion" class="form-control">
				</div>
			</div>
		</div>

		<div class="row border-bottom ">
			<div class="col-md-12 padding-bottom">
				<div class="col-md-2">
					ORIGEN:
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name="origin" class="form-control" value="{{$value[0]->origin}}">
				</div>
			</div>
		</div>

		<div class="row border-bottom padding-bottom">
			<div class="col-md-12">	
				<div class="col-md-2">
					DESTINO:
				</div>
				<div class="col-md-10">
					<input type="form-control" class="form-control" name="destination" value="{{$value[0]->destination}}">
				</div>
			</div>
		</div>

		<div class="row  ">
				<div class="col-md-4 border-bottom padding-bottom">
					<div class="col-md-4 margin-top-4">FETCHA:</div>
					<div class="col-md-8">
						<input type="form-control"class="form-control" name="BTDate" value="{{$value[0]->BTDate}}">
					</div>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4 border-bottom padding-bottom">
					<div class="col-md-2">
						HORA:
					</div>

					<div class="col-md-8"><input type="form-control"  class="form-control" name="BTTime" value="{{$value[0]->BTTime}}"></div>
				</div>
		</div>

		<div class="row ">
			<div class="col-md-12">
	
			<input type="form-control"  class="form-control" name="BTTime" value="IMPORTE(10% IVA INCLUIDO)">
			</input>

					<textarea name="price" rows="10" class="width-100">{{$value[0]->Price}}
						
					</textarea>
				
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
					<textarea rows="10" name="observation" class="width-100">{{$value[0]->observation}}
						
					</textarea>
					
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-md-12">
			<div class="col-md-3">
				MATRICULA VEHICULO 
			</div>
			<div class="col-md-8">
				<input type="form-control" class="form-control" name="carnumber" value="{{$value[0]->carnumber}}">
			</div>
			</div>
		</div>
		<input type="submit" class="hidden" id="update-invoice">
	</form>
	</div>
	
@endsection