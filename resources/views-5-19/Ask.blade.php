@extends('layouts.backend')

@section("content")
<div class="col-md-10 col-md-offset-1" style="text-align:center;margin-top:80px">
	<h1>Exportar a Excel</h1>
	<div class="col-md-10 col-md-offset-2">
		<div class="col-md-2">
			<p style="height:60px;line-height: 60px; text-align:right">Fecha Inicio:</p>
		</div>
		<div class="col-md-2">
			<input id="DateStart" class="datepicker" name="DateStart" type="text" style="margin-top:15px;" class="form-control" placeholder="dd/mm/aaaa" value="{{ $DateStart }}"/>
		</div>
		<div class="col-md-2">
			<p style="height:60px;line-height: 60px; text-align:right">Fecha Fin:</p>
		</div>
		<div class="col-md-2">
			<input id="DateEnd" class="datepicker" name="DateEnd" type="text" style="margin-top:15px;" class="form-control" placeholder="dd/mm/aaaa" value="{{ $DateEnd }}"/>
		</div>
		<div class="col-md-1">
			<button type="button" class="btn btn-primary" style="margin-top:15px;float:right" onClick="window.location='/Exportar/'+String2DateTime($('#DateStart').val())+'/'+String2DateTime($('#DateEnd').val())">Exportar</button>
		</div>
	</div>
</div>	
@endsection

@section("scripts")
	
<script type="text/javascript">
function Ed2z(Number)
{
	if(Number<10)
	    return("0"+Number);
	else
	    return(""+Number);
}

function String2DateTime(myDateTime) 
{
	var Answer = "";
	if(myDateTime!="")
	{
		var opera0 = myDateTime.split(' ');
		if(opera0.length >= 1)
		{
			var myDate = opera0[0]; 
			var opera1 = myDate.split('/');  
			var opera2 = myDate.split('-');  
			lopera1 = opera1.length;  
			lopera2 = opera2.length;  
	
			if (lopera1>1)  
				var pdate = myDate.split('/');  
			else if (lopera2>1)  
				var pdate = myDate.split('-');  
			
			var yy = parseInt(pdate[2],10);
			var mm  = parseInt(pdate[1],10);  
			var dd = parseInt(pdate[0],10);
			Answer =yy+"-"+ Ed2z(mm)+"-"+Ed2z(dd);
		}
		if(opera0.length >= 2)
		{
			Answer = Answer + " " + opera0[1];
		}
	}
	return(Answer);
}


$(function() {
	$('.datepicker').datepicker({
		dateFormat: 'dd/mm/yy'
	
	    });
});
</script>

@endsection

@section("modals")

@endsection