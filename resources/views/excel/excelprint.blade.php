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
            <th>{{ __('custom.order')}}</th>
            <th>{{ __('custom.username') }}</th>
            <th>{{ __('custom.lastname') }}</th>
            <th>{{ __('custom.price') }}</th>
            <th>{{ __('custom.hotel')}}</th>
            <th>{{ __('custom.phone')}}</th>
            <th>{{ __('custom.btdate')}}</th>
            <th>{{ __('custom.bttime')}}</th>
            <th>{{ __('custom.passport')}}</th>
            <th>{{__('custom.flight')}}</th>
            <th>{{ __('custom.destination') }}</th>
            <th>{{ __('custom.pax') }}</th>
            <th>{{ __('custom.price') }}</th>
            <!-- <th>{{ __('custom.vichleno')}}</th> -->
            <th>{{ __('custom.origin') }}</th>
            <th>{{ __('custom.observation') }}</th>
            <th>{{__('custom.carnumber')}}</th>
            <!-- <th>{{__('custom.carname')}}</th> -->
            <th>{{ __('custom.provider') }}</th>
            <th>{{ __('custom.extra') }}</th>
            <th>{{ __('custom.created') }}</th>

        </tr>

    </thead>

    <tbody>

    	<?php $i =1; ?>

    	@foreach($values as $val) 

        	<tr>

        		<td>{{ $i }}</td>

            	<td>{{ $val->BTicketId }}</td>
                <td>{{ $val->BTicketRef }}</td>
                <td>{{ $val->Name }}</td>
                <td>{{ $val->lastname }}</td>
                <td>{{ $val->Price }}</td>

                <td>{{ $val->Hotel }}</td>
                <td>{{ $val->Phone }}</td>
                <td>{{ $val->BTDate }}</td>
                <td>{{ $val->BTTime }}</td>
                <td>{{ $val->Passport }}</td>
                <td>{{ $val->DFlightNo}}</td>
                <td>{{ $val->destination }}</td>
                <td>{{ $val->PAX }}</td>
                <td>{{ $val->Price }}</td>
                <td>{{ $val->origin }}</td>
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

         



