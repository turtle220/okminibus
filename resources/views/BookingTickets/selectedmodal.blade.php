<form id="selectedModal">

    <div class="modal-dialog selecteddialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" style="height:450px;overflow:auto;">
                <div class="DocumentsZone">
                    <div class="DocsLabel">{{ __('custom.ticketinformation') }}</div>
                    <!--Información del ticket-->
                </div>

                <div class="fieldsRow">
                    <div class="fieldsLabel">{{ __('custom.number') }}:</div>
                    <div class="fieldsValue">
                        <!--Numero:-->
                        <input id="sBTicketRef" name="BTicketRef" type="text" class="form-control" placeholder="Introduce un Numero" value="" />
                    </div>

                    <div class="fieldsLabel" >{{__('custom.car') }}</div>
                    <div class="fieldsValue">
                        <!--Estado-->
                        <select id="scar" name="scar" class="form-control">
                        </select>
                        <button type="button" data-toggle="modal" data-target="#scarmodal" class="add btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>

                </div>

                <div class="fieldsRow">

                    <div class="fieldsLabel">{{__('custom.hotel')}}:</div>
                    <div class="fieldsValue">
                        <!--Hotel-->
                        <input id="sHotel" name="Hotel" type="text" class="form-control" placeholder="Introduce Hotel" value="" />
                    </div>

                    <div class="fieldsLabel">{{__('custom.name')}}:</div>
                    <div class="fieldsValue">
                        <input id="sName" name="Name" type="text" class="form-control autocomplete-name" placeholder="Introduce Nombre" value="" />
                    </div>
                </div>

                <div class="fieldsRow">
                    <div class="fieldsLabel">{{__('custom.passport')}}:</div>
                    <div class="fieldsValue">
                        <!--Pasaporte-->
                        <input id="sPassport" name="Passport" type="text" class="form-control" placeholder="Introduce pasaporte" value="" />
                    </div>

                    <div class="fieldsLabel">{{__('custom.typeid')}}:</div>
                    <div class="fieldsValue">
                        <select id="servicetype" name="servicetype" class="form-control">
                            <option value="sd" @if($BookingTicket->sd == "sd"||$BookingTicket->sd =='')selected @endif>SD</option>
                            <option value="dr" @if($BookingTicket->sd == "dr")selected @endif>DR</option>
                            <option value="dc" @if($BookingTicket->sd == "dc")selected @endif>DC</option>
                            <option value="tu" @if($BookingTicket->sd == "tu")selected @endif>TU</option>
                        </select>
                    </div>
                </div>

                <div class="fieldsRow">
                    <div class="fieldsLabel">{{ __('custom.date') }}:</div>
                    <div class="fieldsValue">
                        <!--Fecha-->
                        <input id="sBTDate" name="BTDate" type="text" class="form-control" placeholder="Introduce Fecha" value="" />
                    </div>

                    <div class="fieldsLabel">{{__('custom.phone') }}:</div>
                    <div class="fieldsValue">
                        <!--Phone-->
                        <input id="sPhone" name="Phone" type="text" class="form-control" placeholder="Introduce Teléfono" value="" />
                    </div>
                </div>

                <div class="fieldsRow">
                    <div class="fieldsLabel">{{__('custom.type')}}:</div>
                    <div class="fieldsValue">
                        <!--Tipo-->
                        <select id="sTypeId" name="TypeId" class="form-control">
                            <option value="A">Traslado</option>
                            <option value="D">Disposicion</option>
                            <option value="S">Salida</option>
                            <option value="L">Llegada</option>
                        </select>
                    </div>

                    <div class="fieldsLabel">{{__('custom.time')}}:</div>
                    <div class="fieldsValue">
                        <!---->
                        <input id="sBTTime" name="BTTime" type="text" class="form-control" placeholder="Introduce Hora" value="" />
                    </div>
                </div>
                <div class="fieldsRow">
                    <div class="fieldsLabel">{{__('custom.fax')}}:</div>
                    <div class="fieldsValue">
                        <!--PAX-->
                        <input id="sPAX" name="PAX" type="text" class="form-control" placeholder="Introduce Personas" value="" />
                    </div>

                    <!-- <div class="fieldsLabel">{{__('custom.invoicelanguage') }}</div><div class="fieldsValue">
					<select id="sInvoicelanguage" name="invoicelanguage" class="form-control">	
						<option value="sp" >{{__('custom.spanish')}}</option>
						<option value="en" >{{__('custom.english')}}</option>
			      	</select>
	      		</div> -->
                    <div class="fieldsLabel">{{__('custom.flight')}}:</div>
                    <div class="fieldsValue">
                        <!--Vuelo-->

                        <input id="sDFlightNo" name="DFlightNo" type="text" class="form-control" placeholder="Introduce vuelo" value="" />

                    </div>
                </div>

                <div class="fieldsRow">

                    <div class="fieldsLabel">{{__('custom.origin')}}:</div>
                    <div class="fieldsValue">
                        <!--origen-->
                        <input id="sorigin" name="origin" type="text" class="form-control" placeholder="Introduce Origen" value="" />
                    </div>
                    <div class="fieldsLabel">{{__('custom.price') }}(€):</div>
                    <div class="fieldsValue">
                        <!--Precio-->
                        <input id="sPrice" name="Price" type="text" class="form-control" placeholder="Introduce Precio" value="" />
                    </div>
                </div>

                <div class="fieldsRow">
                    <div class="fieldsLabel">{{__('custom.destination')}}:</div>
                    <div class="fieldsValue">
                        <!--PAX-->
                        <select id="sdestination" name="destination" class="form-control">
                        </select>
                        <button type="button" data-toggle="modal" data-target="#slocmodal" class="add btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>

                    <div class="fieldsLabel">{{__('custom.extra')}}:</div>
                    <div class="fieldsValue">
                        <!--origen-->
                        <input id="sexta" name="extra" type="text" class="form-control" placeholder="Introduce extra" value="" />
                    </div>
                </div>
                <div class="fieldsRow">

                    <div class="fieldsLabel">{{__('custom.observation')}}:</div>
                    <div class="fieldsValue">
                        <!--observation-->
                        <input id="sObservation" name="observation" type="text" class="form-control" placeholder="Introduce Observaciones" value="" />
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('custom.cancel') }}</button>
                <!--Cancelar-->
                <button type="button" class="btn btn-primary sSaveBookingTicket">{{ __('custom.save') }}</button>
                <!--Guardar-->
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="slocmodal" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">New Loaction</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="text" class="form-control" name="sdestination">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary ssave-area">{{__('custom.save') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('custom.cancel') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="scarmodal" role="dialog">
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
                    <input type="text" class="form-control" name="scarnumber">
                </div>

                <div class="form-group">
                    <label>{{__('custom.carname')}}:</label>
                    <input type="text" class="form-control" name="scarname">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary ssave-car">{{__('custom.save') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('custom.cancel') }}</button>
            </div>
        </div>
    </div>
</div>
