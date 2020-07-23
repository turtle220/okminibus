@extends('userlayouts.userapp')



@section('content')

@if(Auth::user()->role == 1 || Auth::user()->role == 2)

<style type="text/css">
    .pretty {
        margin-right: 0px !important;
        margin-top: 15px !important;
        cursor: pointer;
    }

    @media screen and (max-width: 1600px) {
        .pretty {
            margin-top: 25px;
        }
    }

    @media screen and (max-width: 1390px) {
        .pretty {
            margin-top: 35px;
        }
    }

    .autocomplete-suggestions {
        border: 1px solid #999;
        background: #FFF;
        overflow: auto;
    }

    .autocomplete-suggestion {
        padding: 2px 5px;
        white-space: nowrap;
        overflow: hidden;
    }

    .autocomplete-selected {
        background: #F0F0F0;
    }

    .autocomplete-suggestions strong {
        font-weight: normal;
        color: #3399FF;
    }

    .autocomplete-group {
        padding: 2px 5px;
    }

    .autocomplete-group strong {
        display: block;
        border-bottom: 1px solid #000;
    }

    #car,
    #scar {
        width: 80%;
        float: left;
    }

    #destination,
    #sdestination {
        width: 80%;
        float: left;
    }

    .add {
        width: 20%;
    }

    .header {
        display: flex;
        width: max-content;
        justify-content: start;
        margin: 0;
        align-items: flex-start;
    }

</style>

<!-- bootstrap 3.3.7  -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link href="http://jquery-ui-bootstrap.github.io/jquery-ui-bootstrap/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="stylesheet" />
<!-- no tocuch this section -->

<style type="text/css">

    .navbar {
        background: none !important;
        border: 0 !important;
    }

    #left-panel {
        padding: 5px;
    }

    .header-button {
        color: #fff;
        padding: 10px 15px;
        background-color: #007bff;
        border: 0 !important;
    }

    .header-button:hover {

        background-color: #0061a7;

    }

    .header-button:active {

        position: relative;

        top: 1px;

    }

    .eddialog {

        width: 900px;

    }

</style>

<!-- user Table -->

<h2 class="margin-bottom">Booking Ticket Management</h2>

<div class="animated fadeIn">

    <div class="margin-right margin-bottom header">

        <button class="header-button btn-ExtrAdd pull-left margin-bottom margin-right" onClick="EditBookingTicket('')"><i class="fa fa-plus"></i>&nbsp{{ __('custom.newticket') }}</button>
        <button class="header-button pull-left margin-right" data-toggle="modal" data-target="#searchModal"><i class="fa fa-copy"></i>&nbsp;{{__('custom.generateclone')}}</button>

        <form action="{{ url('selectedprint') }}" method="POST">

            @csrf

            <button type="submit" class="header-button selectedlist-print"><i class="fa fa-print"></i>&nbsp;{{ __('custom.excel') }}

            </button>

        </form>

        <form action="{{ url('BookingTickets') }}" method="get" style="width:max-content">
            <div class="col-md-5">
                <div class="col-md-3">
                    <label class="padding-top-5" style="font-weight:400;">{{__('custom.from')}}:</label>
                </div>
                <div class="col-md-9">
                    <input type="date" class="form-control" value="{{old('from')}}" name="from" style="width: max-content;">
                </div>
            </div>
            <div class="col-md-5">
                <div class="col-md-3">
                    <label class="padding-top-5" style="font-weight:400">{{__('custom.to')}}:</label>
                </div>
                <div class="col-md-9">
                    <input type="date" class="form-control" value="{{old('to')}}" name="to" style="width: max-content;">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="header-button pull-left margin-right" style="display:flex;"><i class="fa fa-search"></i> &nbsp;{{__('custom.search') }}</button>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{__('custom.bookingtickettable')}}</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered col-md-center">
                        <thead>
                            <tr>
                                <th>{{ __('custom.no')}}</th>
                                <th>{{ __('custom.code') }}</th>
                                <th>{{ __('custom.close') }}</th>
                                <th>{{ __('custom.origin') }}</th>
                                <th>{{ __('custom.hotel') }}</th>
                                <th>{{ __('custom.destination') }}</th>
                                <th>{{ __('custom.name')  }}</th>
                                <th>{{ __('custom.typeid')  }}</th>
                                <th>{{ __('custom.carnumber') }}</th>
                                <th>{{ __('custom.hora') }}</th>
                                <th>{{ __('custom.provider')}}</th>
                                <th>{{ __('custom.viewshow') }}</th>
                                <th>
                                    <div class="pretty p-icon  p-locked all">
                                        <input type="checkbox" @if($allStatus==true)checked @endif>
                                        <div class="state p-success">
                                            <i class="icon fa fa-check"></i>
                                            <label></label>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $i = 0;?>

                            @foreach ($values as $BookingTicket)

                            <?php $i++; ?>

                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $BookingTicket->BTicketRef }}</th>
                                <td>{{ $BookingTicket->BTDate }}</td>
                                <td>{{ $BookingTicket->origin }}</td>
                                <td>{{ $BookingTicket->Hotel }}</td>
                                <td>{{ $BookingTicket->destination }}</td>
                                <td>{{ $BookingTicket->Name }}</td>
                                <!-- <td> @if($BookingTicket->StatusId == "p"||$BookingTicket->StatusId == "P"){{__('custom.pending')}}@else {{__('custom.bookkeeping')}}@endif</td> -->
                                <td>{{ $BookingTicket->sd}}</td>
                                <td>{{ $BookingTicket->carnumber}}</td>
                                <td>{{ $BookingTicket->BTTime}}</td>
                                <td>{{ $BookingTicket->name}}</td>
                                <td>
                                    <button class="HandCursors SelectableLine myButton" data-toggle="modal" onClick="ShowBookingTicket('{{$BookingTicket->BTicketId}}')"><i class="fa fa-ticket"></i>&nbsp{{__('custom.viewshow')}}</button>
                                </td>
                                <td>
                                    <div class="pretty p-icon p-round p-locked single-check">
                                        <input type="checkbox" @if($BookingTicket->checkstatus != NULL)checked @endif />
                                        <!-- <input type="checkbox"checked /> -->
                                        <div class="state p-success">
                                            <i class="icon fa fa-check"></i>
                                            <label></label>
                                        </div>
                                        <input type="hidden" id="rowid" value="{{$BookingTicket->id}}">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end of car-body-->
            </div>
            <!--end of card-->
        </div><!-- end of col-md-12 -->
    </div><!-- end of col-row-->
</div>

<script type="text/javascript">
    $('.selectedlist-print').click(function() {

        $("input[type='checkbox']").prop("checked", false);

    });

</script>

@endsection

@section("modals")

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" style="z-index:1060" aria-labelledby="myModalLabel"></div>

<div class="modal fade" id="resavemodal">
    @include('BookingTickets.selectedmodal');
</div>

<div id="searchModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('custom.searchticket')}}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" style="margin-top: 50px;">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label>{{__('custom.searchword')}}</label>
                                <input type="text" name="keyword" id="keyword" placeholder="{{__('custom.enter')}}" class="form-control">
                            </div>
                            <div id="ticket_list"></div>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('custom.cancel')}}</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<!-- edit's children modal -->
<div class="modal fade" id="locmodal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Loaction</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="destination">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary save-area" onclick="savearea()">{{__('custom.save') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('custom.cancel') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="carmodal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('custom.newcar')}}</h4>
                <button type="button" class="close" data-target="#carmodal" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>{{__('custom.carnumber')}}:</label>
                    <input type="text" class="form-control" name="carnumber">
                </div>
                <div class="form-group">
                    <label>{{__('custom.carname')}}:</label>
                    <input type="text" class="form-control" name="carname">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary save-car">{{__('custom.save') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('custom.cancel') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- end of Edit's children modal -->

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.27/jquery.autocomplete.min.js"></script> -->

<script type="text/javascript">
    $(document).on('show.bs.modal', '.modal', function() {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    $(document).ready(function() {
        // keyup function looks at the keys typed on the search box
        $('#keyword').on('keyup', function() {
            // the text typed in the input field is assigned to a variable 
            var query = $(this).val();
            // call to an ajax function
            $.ajax({
                // assign a controller function to perform search action - route name is search
                url: "{{ url('BookingTickets/search')}}",
                // since we are getting data methos is assigned as GET
                type: "GET",
                // data are sent the server
                data: {
                    'keyword': query
                },
                // if search is succcessfully done, this callback function is called
                success: function(data) {
                    // print the search results in the div called country_list(id)
                    $('#ticket_list').html(data);
                }
            })
            // end of ajax call
        });
        // initiate a click function on each search result
        $(document).on('click', '#ticket_list li', function() {
            // declare the value in the input field to a variable
            var value = $(this).next();
            var id = $(this).next().val();
            // assign the value to the search box
            $('#keyword').val("");
            // after click is done, search results segment is made empty
            $('#ticket_list').html("");
            $.ajax({
                url: "{{url('BookingTickets/editAjax')}}"
                , method: "GET"
                , data: {
                    id: id
                }
                , success: function(data) {

                    $('#sBTicketRef').val(data['BTicketRef']);
                    $('#sHotel').val(data['BookingTickets']['Hotel']);
                    $('#sName').val(data['BookingTickets']['Name']);
                    $('#sPassport').val(data['BookingTickets']['Passport']);
                    $('#sPhone').val(data['BookingTickets']['Phone']);
                    $('#sBTDate').val(data['BookingTickets']['BTDate']);
                    $('#sBTTime').val(data['BookingTickets']['BTTime']);

                    var optionValue = data['BookingTickets']['TypeId'];
                    $("#sTypeId").val(optionValue).find("option[value=" + optionValue + "]").attr('selected', true);
                    $('#sDFlightNo').val(data['BookingTickets']['DFlightNo']);

                    var optionValue = data['BookingTickets']['invoicelanguage'];
                    $("#sInvoicelanguage").val(optionValue).find("option[value=" + optionValue + "]").attr('selected', true);
                    $('#sPrice').val(data['BookingTickets']['Price']);
                    $('#sPAX').val(data['BookingTickets']['PAX']);
                    $('#sObservation').val(data['BookingTickets']['Observation']);
                    $('#sorigin').val(data['BookingTickets']['origin']);
                    $('#sexta').val(data['BookingTickets']['extra']);
                    $('#slastname').val(data['BookingTickets']['lastname']);

                    var length = data['areas'].length;
                    var firstFlag = true;
                    for (var i = 0; i < length; i++) {

                        if (data['BookingTickets']['destination'] == data['areas'][i]['name'])
                            $("#sdestination").append('<option value="' + data['areas'][i]['name'] + '" selected>' + data['areas'][i]['name'] + "</option>");
                        else
                            $("#sdestination").append('<option value="' + data['areas'][i]['name'] + '">' + data['areas'][i]['name'] + "</option>");

                    }

                    var length = data['cars'].length;

                    for (var i = 0; i < length; i++) {

                        if (data['BookingTickets']['bus_id'] == data['cars'][i]['id'])
                            $("#scar").append('<option value="' + data['cars'][i]['id'] + '" selected>' + data['cars'][i]['carnumber'] + "</option>");
                        else
                            $("#scar").append('<option value="' + data['cars'][i]['id'] + '">' + data['cars'][i]['carnumber'] + "</option>");
                    }

                    $('#searchModal').modal('toggle');
                    $('#resavemodal').modal('toggle');
                }
            });
        });

        $('.modal1-cancle').on('click', function() {
            console.log('click');
            $('#myModal').modal('toggle');
        })
    });

</script>

@endif

@endsection
