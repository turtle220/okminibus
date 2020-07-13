<table>

	<thead>

        <tr>
            <th>NUM.ORDEN</th>
            <th>FECHA</th>
            <th>NUM.FAC.</th>
            <th>{{ __('custom.firstname') }}</th>
            
            <th>PASAPORTE</th>
            <th>HOTEL</th>
            <th>Teléfono</th>
            <th>SERVICIO</th>
            <th>TIPO SERVICIO</th>
            <th>ORIGEN</th>
            <th>DESTINO</th>
            <th>HORA</th>
            <th>Vuelo</th>
            <th>Pax</th>
         
            <th>Precio</th>
            <th>Observaciones</th>
            <th>MATRICULA</th>
      
            <th>Proveedor</th>
            <th>extra</th>
            <th>Creado O COMENTARIO</th>

        </tr>

    </thead>

    <tbody>

    	<?php $i =1; ?>

    	@foreach($values as $val) 
   
        	<tr>

        		<td>{{ $i}}</td>

            	<td>{{ $val->BTDate }}</td>
                <td>{{ $val->Num_Factura }}</td>
                <td>{{ $val->Name }}</td>
                <td>{{ $val->Passport }}</td>
                <td>{{ $val->Hotel }}</td>
                <td>{{ $val->Phone }}</td>
                <!-- <td>{{ $val->TypeId }}</td> -->

                @if ($val->TypeId == 'A')
                    <td>Llegada</td>
                @endif
                @if ($val->TypeId == 'D')
                    <td>Salida</td>
                @endif
                @if ($val->TypeId == 'L')
                    <td>Disposicion</td>
                @endif
                @if ($val->TypeId == 'S')
                    <td>Traslado</td>
                @endif

                <td>{{ $val->sd }}</td>
                <td>{{ $val->origin }}</td>
                <td>{{ $val->destination }}</td>
                <td>{{ $val->BTTime }}</td>
                <td>{{ $val->DFlightNo}}</td>
                <td>{{ $val->PAX }}</td>
                <td>{{ $val->Price }}</td>
                <td>{{ $val->observation }}</td>
                <td>{{ $val->carnumber }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->extra }}</td>
                <td>{{ $val->created_at}}</td>

            </tr>

        <?php $i++; ?>

        @endforeach

    </tbody>

</table>

         



