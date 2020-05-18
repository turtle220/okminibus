$(document).ready(function($) {
   //uploading

	$('.navbar-nav a, td a').click(function(){
		$('.loading-overlay').show();
	});

	$('.role').change(function(){
			$.ajax({
			url: "/user/setrole",
			method: "GET",
			data: {
				id: $(this).parents('tr').find('input').val(),
				role: $(this).val()

			},
			success:function(data){
				if(data['success'] == "true")
				{
					$('.alert-success').fadeIn(300).fadeOut(300);
				}
				else
				{
					console.log('fa');
				}
			}
		});
	})

	$('.update-user').click(function(){

		$('#useredit').submit();
	})

	$('.update-save').click(function() {
		$('#update-invoice').trigger("click");
	});		

	$(function () {
   		modal1Dismiss();
	});
	
	$('#username').change(function(){
		$('#name').val($('#username').val());
		$('#invoice-submit').trigger("click");
	});	

	
});

function inVoiceList()
{
	var name = $('#username').val();

	$.ajax({
		url: "invoicelist/pdf",
		method: "post" ,
		data: {
			name: name
		},
		success:function(data){
				console.log(data);
		}

		
	})
}

function savearea()  {
	
	// $('.save-area').on('click', function(){	
		var destination = $('input[name=destination]').val();
		console.log(destination);
		$.ajax({
			url: "/area/store",
			method: "GET",
			data: {
				destination: destination
			},
			success:function(data){
				if(data['success'] == "true")
				{
					var area = data['curarea'];

					$("#destination").attr('disabled', false);
	              
	                $("#destination").append('<option  selected value=' + area + '>' + area + '</option>');

	               
				}
				else
				{
					console.log('fa');
				}

				$('#locmodal').modal('hide');
			}
		})
	// })
	
}


function modal1Dismiss() {
		$('#modal1-cancle').on('click', function() {
		$('#myModal').hide();
		$('#myModal').modal('hide'); 
		$('body').removeClass('modal-open');
		$('body').css('padding-right', '0px');
		$('.modal-backdrop').remove();
		console.log("clik");
	})
}
function FullReload()
{
	window.location=""+window.location;
}

function ShowBookingTicket(BTicketId)
{
	$('#myModal').html(" ");
	$('#myModal').load("/BookingTickets/show?BTicketId="+BTicketId,function(){
		 modal1Dismiss()
	});
	$('#myModal').modal('show');
}

function EditBookingTicket(BTicketId)
{
	$('#myModal').html(" ");
	$('#myModal').load("/BookingTickets/edit?BTicketId="+BTicketId, function(){
		 modal1Dismiss()
	});
	$('#myModal').modal('show');
}

function SaveBookingTicket(BTicketId)
{
	var dataString = "BTicketId="+BTicketId;
	var form = document.getElementById('ModalForm');
	var howMany = form.elements.length;
	
    for (var count = 0; count < howMany; count++) 
    	if(form.elements[count].name!="")
    		dataString = dataString +"&" + form.elements[count].name + "=" + urlencode(form.elements[count].value);
	
		$.ajax({  
			type: "POST",  
			url: "/BookingTickets/save?BTicketId="+BTicketId,  
			data: dataString,
			success: function(data) {
				if(data.ItsOk == 'Y')
				{
					$("#myModal").html(data.Html);
				}
				else
				{
					$("#ErrorZone").html(data.Html);
				}
			}
			}).always(function(){			
		});
		
}

function DoFilter(type,order)
{
	window.location = '/'+type+'/'+order+'/'+$("#Filter").val()+'/'+urlencode($("#Search").val());
}
//------------------------------------------------------------------------------------------------------------------------------------------
function urlencode(str) 
{
	str = escape(str);
	str = str.replaceAll('+', '%2B');
	str = str.replaceAll('%20', '+');
	str = str.replaceAll('*', '%2A');
	str = str.replaceAll('/', '%2F');
	str = str.replaceAll('@', '%40');
	return str;
}
//------------------------------------------------------------------------------------------------------------------------------------------
function urldecode(str) 
{
	str = str.replace('+', ' ');
	str = unescape(str);
	return str;
}
//------------------------------------------------------------------------------------------------------------------------------------------
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

//------------------------------------------------------------------------------------------------------------------------------------------
function Ed2z(Number)
{
	if(Number<10)
	    return("0"+Number);
	else
	    return(""+Number);
}

//------------------------------------------------------------------------------------------------------------------------------------------
String.prototype.replaceAll = function(str1, str2, ignore)
{
   return this.replace(new RegExp(str1.replace(/([\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, function(c){return "\\" + c;}), "g"+(ignore?"i":"")), str2);
};
//------------------------------------------------------------------------------------------------------------------------------------------