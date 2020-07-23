<table>
	<thead><!-- 
        <tr>
            <th>{{__('custom.client')}} :</th> 
            <th>{{ old('username') }}</th>
            <th>{{__('custom.from')}}</th>
            <th>{{ old('from') }}</th>
            <th>{{__('custom.to')}}</th>
            <th>{{ old('to') }}</th>
            
        </tr> -->
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
         

