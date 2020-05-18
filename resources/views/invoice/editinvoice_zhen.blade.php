@extends('userlayouts.userapp')
@section('content')
 <style>
    /*.invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }*/
    
   
    </style>

<h2 class="margin-bottom">{{__('custom.invoice')}}</h2> 
<div style="margin-right: -15px;">
    <a class="btn btn-primary btn-ExtrAdd" href="{{url('/')}}"><i class="fa fa-back"></i> &nbsp;{{ __('custom.back') }}</a>
    <form action="invoice/edit" method="post" style="display: inline-block;">
        @csrf
        <input type="hidden" name="id" value="{{$data[0]->id}}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> &nbsp;{{__('custom.edit') }}</button>
    </form>

    <form action="invoice/pdf" method="post" style="display: inline-block;">
        @csrf
        <input type="hidden" name="id" value="{{$data[0]->id}}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> &nbsp;{{__('custom.PDF') }}</button>
    </form>
</div>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="container invoice-wrap">
    <form action="">
      <header class="clearfix">
        <div id="logo">
          <img src="logo.png">
        </div>
        <h1>{{__('custom.invoice')}}</h1>

        <div id="company" class="clearfix">
          <div>{{ __('custom.companyname') }}</div>
          <div>{{__('custom.logo')}}</div>
          <div>(602) 519-0450</div>
          <div><a href="mailto:company@example.com">company@example.com</a></div>
        </div>
        <div id="project">
          <!-- <div><span>PROJECT</span> Website development</div> -->
          <div><span>{{ __('custom.lclient')}}</span> {{ $customer[0]->name}}</div>
          <!-- <div><span>{{ __('custom.laddress')}}</span> 796 Silver Harbour, TX 79273, US</div> -->
          <div><span>{{ __('custom.lemail') }}</span> <a href="mailto:john@example.com">{{$customer[0]->email}}</a></div>
          <div><span>{{ __('custom.lcreated') }}</span> {{$data[0]->BTDate}}</div>
          <div><span>{{ __('custom.lduedate') }}</span> 00-00-0000</div>
        </div>
      </header>
      <main>
        <table class="table table-borderd">
          <thead>
            <tr>
              <th>{{__('custom.destination')}}</th>
              <th>{{__('custom.price')}}</th>
              <th>{{__('custom.date')}}
              <!-- <th>QTY</th> -->
              <th>{{__('custom.total')}}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="service">{{$data[0]->Hotel}}</td>
              <!-- <td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td> -->
              <td class="unit">${{$data[0]->Price}}</td>
              <td>{{$data[0]->BTdate}}</td>
              <td class="total">${{$data[0]->Price}}</td>
            </tr>
          
            <tr>
              <td colspan="2">{{__('custom.lgrandtotal')}}</td>
              <td class="total">${{$data[0]->Price}}</td>
            </tr>
            <!-- <tr>
              <td colspan="4">TAX 25%</td>
              <td class="total">$1,300.00</td>
            </tr> -->
            <!-- <tr>
              <td colspan="4" class="grand total">GRAND TOTAL</td>
              <td class="grand total">$6,500.00</td>
            </tr> -->
          </tbody>
        </table>
        <!-- <div id="notices">
          <div>NOTICE:</div>
          <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div> -->
      </main>
      <footer>
        {{__('custom.invoicefooter')}}
      </footer>   
    </form>
</div>

@endsection