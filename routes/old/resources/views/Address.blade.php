@extends('layouts.backend')

@section("content")
<div class="col-md-10 col-md-offset-1" style="text-align:center;">
<h1><br/></h1>
<button class="btn btn-primary btn-ExtrAdd" onClick="window.location='/Addresses?Add=1'">Nueva dirección</button>
</div>
	<div class="col-md-10 col-md-offset-1">
		<table class="table">
		  <thead class="thead-inverse">
		  </tbody>
		</table>
		
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
		      <th class="col-md-3">Nombre del niño</th>
		      <th class="col-md-4">e-Mail</th>
		      <th class="col-md-1">Estado</th>
   		      <th class="col-md-2"></th>
		    </tr>
		  </thead>
		  @if ($new)
		  <tbody>
  			<form method="post">
  				{!! csrf_field() !!}
  				<input name="id" type="hidden" value="0">
				<tr>
			      <td scope="row"><input name="Forma" type="text" class="form-control" placeholder="Introduce un alias" value="{{ old('Forma') }}" /></td>
			      <td><input name="Address" type="text" class="form-control" placeholder="Introduce la contraseña" value="{{ old('Address') }}" /></td>
			      <td>
			      	<select name="StatusId" class="form-control">
				      	<option value="Activo" selected>Activo</option>
			      		<option value="Inactivo">Inactivo</option>
			    	</select>
			      </td>
			      <td style="text-align:center"><button class="btn btn-primary btn-ExtrCreate" type="submit">Crear dirección</button></td>
			    </tr>
		      </form>
		  </tbody>		  		  
		  @endif
		  <tbody>
			@foreach ($addresses as $address)
		  		@if ($id == $address->id)
		  			<form method="post">
		  				{!! csrf_field() !!}
		  				<input name="id" type="hidden" value="{{$address->id}}">
						<tr>
					      <td scope="row"><input name="Forma" type="text" class="form-control" placeholder="Introduce un alias" value="{{$address->Forma}}" /></td>
					      <td><input name="Address" type="text" class="form-control" placeholder="Introduce la contraseña" value="{{$address->Address}}" /></td>
					      <td>
					      	<select name="StatusId" class="form-control">
							@foreach ($Statuses as $Status)
						      	@if ($address->StatusId == $Status)
							      	<option value="{{$Status}}" selected>{{$Status}}</option>
		  						@else
							      	<option value="{{$Status}}">{{$Status}}</option>
		  						@endif  
							@endforeach
		  					</select>
					      </td>
					      <td>
						      <button class="btn btn-primary btn-ExtrEdit" type="submit">Guardar</button>
						      <button class="btn-ExtrDelete btn" onClick="window.location='/Addresses?page={{$page}}'">Cancelar</button>
					      </td>
					    </tr>
				    </form>
		  		@else
					<tr>
				      <td scope="row">{{$address->Forma}}</td>
				      <td>{{$address->Address}}</td>				      
				      <td>{{$address->StatusId}}</td>
				      <td>
				      	<button class="btn btn-primary btn-ExtrEdit" onClick="window.location='/Addresses?page={{$page}}&id={{$address->id}}'">Editar</button>
				      	<button class="btn-ExtrDelete btn" onClick="DeleteElement('Addresses', {{$address->id}})">Borrar</button>
				      </td>
				    </tr>
		  		@endif  
			@endforeach
		  </tbody>		  		  
		</table>
		<div style="float:right">
			{{ $addresses->render() }}
		</div>
	</div>
@endsection