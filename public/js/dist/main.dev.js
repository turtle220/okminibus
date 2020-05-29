"use strict";

$(document).ready(function ($) {
  //uploading
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }; //toastr["success"]("Have fun storming the castle!")

  $('.navbar-nav a, td a').click(function () {
    $('.loading-overlay').show();
  });
  $('.role').change(function () {
    var url = $('#user-setrole').val();
    $.ajax({
      url: url,
      method: "GET",
      data: {
        id: $(this).parents('tr').find('input').val(),
        role: $(this).val()
      },
      success: function success(data) {
        if (data['success'] == "true") {
          var msg = $('#successMsg').val();
          toastr['success'](msg);
        } else {
          var msg = $('#errorMsg').val();
          toastr['success'](msg);
        }
      }
    });
  });
  $('.update-user').click(function () {
    $('#useredit').submit();
  });
  $('.update-save').click(function () {
    $('#update-invoice').trigger("click");
  });
  $(function () {
    modal1Dismiss();
  });
  $('#username').change(function () {
    $('#name').val($('#username').val());
    $('#invoice-submit').trigger("click");
  });
  $("#bootstrap-data-table-export").on("click", ".single-check1", function () {
    // your code goes here
    // var url = window.location.href + '/setcheck';
    var url = $('#setcheck1').val();
    var id = $(this).find('#rowid').val();
    $t = $(this);
    $.ajax({
      url: url,
      data: {
        id: id
      },
      success: function success(data) {
        if (data["status"] == "check") {
          $t.find("input[type='checkbox']").prop("checked", true);
        } else {
          $t.find("input[type='checkbox']").prop("checked", false);
        }
      },
      error: function error(xhr, status, _error) {
        toastr["error"]("Error: please try again.");
      }
    }); // id="setcheck" value="{{url('/BookingTickets/setcheck')}}"
  });
  $("#bootstrap-data-table-export").on("click", ".single-check", function () {
    // your code goes here
    var url = $('#setcheck').val();
    var id = $(this).find('#rowid').val();
    $t = $(this);
    $.ajax({
      url: url,
      data: {
        id: id
      },
      success: function success(data) {
        if (data["status"] == "check") {
          $t.find("input[type='checkbox']").prop("checked", true);
        } else {
          $t.find("input[type='checkbox']").prop("checked", false);
        }
      },
      error: function error(xhr, status, _error2) {
        toastr["error"]("Error: please try again.");
      }
    }); // id="setcheck" value="{{url('/BookingTickets/setcheck')}}"
  });
  $("#bootstrap-data-table-export").on("click", ".all", function () {
    // your code goes here
    $('.loading-overlay').show();
    var url = $('#allcheck').val();
    $t = $(this);
    $.ajax({
      url: url,
      data: {},
      success: function success(data) {
        if (data["status"] == "check") {
          $("input[type='checkbox']").prop("checked", true);
        } else {
          $("input[type='checkbox']").prop("checked", false);
        }

        $('.loading-overlay').hide();
      },
      error: function error(xhr, status, _error3) {
        toastr["error"]("Error: please try again.");
        $('.loading-overlay').hide();
      }
    });
  });
  $("#bootstrap-data-table-export").on("click", ".all1", function () {
    // your code goes here
    $('.loading-overlay').show();
    var url = $('#all1').val();
    var from = $('#date_from').val();
    var to = $('#date_to').val(); // var url = window.location.href + '/allcheck';

    $t = $(this);
    $.ajax({
      url: url,
      data: {
        from: from,
        to: to
      },
      success: function success(data) {
        if (data["status"] == "check") {
          $("input[type='checkbox']").prop("checked", true);
        } else {
          $("input[type='checkbox']").prop("checked", false);
        }

        $('.loading-overlay').hide();
      },
      error: function error(xhr, status, _error4) {
        toastr["error"]("Error: please try again.");
        $('.loading-overlay').hide();
      }
    });
  });
  $(document).on('click', '.searchbtn-ticket', function () {
    var ticketKeyword = $('#ticket-keyword').val();
    var url = $('#BookingTickets-search').val();
    $.ajax({
      url: url,
      data: {
        keyword: ticketKeyword
      },
      success: function success(data) {},
      error: function error(xhr, status, _error5) {
        toastr["error"]("Error: please try again.");
      }
    });
  });
  $(document).on('click', '.sSaveBookingTicket', function () {
    reSaveBookingTicket();
  });
  $(document).on('click', '.ssave-area', function () {
    resavearea();
  }); //get the reqired name.

  $(document).on('click', '.save-car', function () {
    savecar();
  });
  $(document).on('click', '.ssave-car', function () {
    resavecar();
  });
});

function savecar() {
  var url = $('#carstore').val();
  var carnumber = $("input[name='carnumber']").val();
  var carname = $("input[name='carname']").val();
  var someID = "carmodal";
  $.ajax({
    url: url,
    data: {
      carnumber: carnumber,
      carname: carname
    },
    success: function success(data) {
      if (data['success'] == "true") {
        var car = data['carnumber'];
        var id = data['id'];
        $("#car").attr('disabled', false);
        $("#car").append('<option  selected value=' + id + '>' + car + '</option>');
        $('#carmodal').modal('toggle');
      } else {
        var msg = $('#successMsg').val();
        toastr["error"](msg);
      }
    },
    error: function error(xhr, status, _error6) {
      var msg = $('#errorMsg').val();
      toastr["error"](msg);
    }
  });
}

function resavecar() {
  var url = $('#carstore').val();
  var carnumber = $("input[name='scarnumber']").val();
  var carname = $("input[name='scarname']").val();
  var someID = "carmodal";
  $.ajax({
    url: url,
    data: {
      carnumber: carnumber,
      carname: carname
    },
    success: function success(data) {
      if (data['success'] == "true") {
        var car = data['carnumber'];
        var id = data['id'];
        $("#scar").attr('disabled', false);
        $("#scar").append('<option  selected value=' + id + '>' + car + '</option>');
        $('#scarmodal').modal('toggle');
      } else {
        var msg = $('#successMsg').val();
        toastr["error"](msg);
      }
    },
    error: function error(xhr, status, _error7) {
      var msg = $('#errorMsg').val();
      toastr["error"](msg);
    }
  });
}

function inVoiceList() {
  var name = $('#username').val();
  var url = $('#invoicelist-pdf').val();
  $.ajax({
    url: url,
    method: "post",
    data: {
      name: name
    },
    success: function success(data) {
      console.log(data);
    }
  });
}

function resavearea() {
  var destination = $('input[name=sdestination]').val();
  var url = $('#area-store').val();
  $.ajax({
    url: url,
    method: "GET",
    data: {
      destination: destination
    },
    success: function success(data) {
      if (data['success'] == "true") {
        var area = data['curarea'];
        $("#sdestination").attr('disabled', false);
        $("#sdestination").append('<option  selected value=' + area + '>' + area + '</option>');
      } else {
        console.log('fa');
      }

      $('#slocmodal').modal('hide');
    }
  });
}

function ticketValidation(formName) {
  validateInit();
  var validationFlag = true;
  $("#" + formName + " input[type=text]").each(function () {
    console.log(this.name + ":" + this.value);

    if (this.value == "") {
      $(this).addClass('invalid');
      validationFlag = false;
    }
  }); // 	var form = document.getElementById(formName);
  // 	var howMany = form.elements.length;
  // 	var validationFlag = true;
  // debugger;
  //     for (var count = 1; count < howMany; count++) 
  //     {
  //     	if(form.elements[count].name!="")
  //     	{
  //     		if(form.elements[count].value == "")
  //     		{
  //     			console.log("i: "+form.elements[count].value);
  //     			form.elements[count].name.className += ' invalid';
  //     			validationFlag = false;
  //     		}
  //     	}
  //     }

  return validationFlag;
}

function validateInit() {
  $('input').removeClass('.invalid');
}

function savearea() {
  // $('.save-area').on('click', function(){	
  var destination = $('input[name=destination]').val();
  console.log(destination);
  var url = $('#area-store').val();
  $.ajax({
    url: url,
    method: "GET",
    data: {
      destination: destination
    },
    success: function success(data) {
      if (data['success'] == "true") {
        var area = data['curarea'];
        $("#destination").attr('disabled', false);
        $("#destination").append('<option  selected value=' + area + '>' + area + '</option>');
      } else {
        console.log('fa');
      }

      $('#locmodal').modal('hide');
    }
  }); // })
}

function modal1Dismiss() {
  $('.modal1-cancle').on('click', function () {
    // $('#myModal').toggle();
    // $('#myModal').modal('toggle'); 
    // $('body').removeClass('modal-open');
    // $('body').css('padding-right', '0px');
    // $('.modal-backdrop').remove();
    // console.log("clik");
    location.reload();
  });
}

function FullReload() {
  window.location = "" + window.location;
}

function handler() {
  $('#myModal').modal('toggle');
}

function ShowBookingTicket(BTicketId) {
  var url = $('#BookingTickets-show').val();
  $('#myModal').html(" ");
  $('#myModal').load(url + BTicketId);
  $('#myModal').modal('show');
}

function EditBookingTicket(BTicketId) {
  var url = $('#BookingTickets-edit').val();
  var userurl = $('#getuserlistajax').val();
  $('#myModal').html(" ");
  $('#myModal').load(url + BTicketId, function () {// $('#Name').on('keyup', function(){
    // 	console.log(":)");
    // });
    // $('#Name').autocomplete({
    // 	paramName: 'keyword',
    // 	serviceUrl: userurl,
    // 	lookupFilter: function (suggestion, query, queryLowerCase) {
    //     			  return suggestion.value.toLowerCase().indexOf(queryLowerCase) === 0;
    //  		    },
    // 	onSearchComplete: function(query, suggestions) {
    // 		console.log("serch resutlt"+suggestions);
    // 		if(suggestions.length == 0)
    // 		{
    // 			$('#Name').val(
    // 				function(index, value){
    //    				  		return value.substr(0, value.length - 1);
    // 				});
    // 			var msg = $('#existUserName').val();
    // 			toastr["warning"](msg);
    // 		}
    // 		return suggestions;
    // 	}
    // });
  });
  $('#myModal').modal('show');
}

function SaveBookingTicket(BTicketId) {
  if (ticketValidation('ModalForm') == true) {
    var url = $('#BookingTickets-save').val();
    var dataString = "BTicketId=" + BTicketId;
    var form = document.getElementById('ModalForm');
    var howMany = form.elements.length;

    for (var count = 0; count < howMany; count++) {
      if (form.elements[count].name != "") dataString = dataString + "&" + form.elements[count].name + "=" + urlencode(form.elements[count].value);
    }

    $.ajax({
      type: "POST",
      url: url + BTicketId,
      data: dataString,
      success: function success(data) {
        if (data.ItsOk == 'Y') {
          $("#myModal").html(data.Html);
          var msg = $('#successmsg').val();
          toastr["success"](msg);
        } else {
          if (data.Html == "emptyuser") {
            //$("#ErrorZone").html("You should type exist client name");You should type exist client name
            var msg = $('#existUserName').val();
            toastr["error"](msg);
            $("#Name").focus();
          } else {
            toastr["error"]("data.Html");
          }
        }
      }
    }).always(function () {
      modal1Dismiss();
    });
  } else {
    var msg = $('#required').val();
    toastr['warning'](msg);
  }
}

function reSaveBookingTicket() {
  if (ticketValidation('selectedModal') == true) {
    var url = $('#BookingTickets-resave').val();
    var dataString = "BTicketId=";
    var form = document.getElementById('selectedModal');
    var howMany = form.elements.length;

    for (var count = 0; count < howMany; count++) {
      if (form.elements[count].name != "") dataString = dataString + "&" + form.elements[count].name + "=" + urlencode(form.elements[count].value);
    }

    $.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function success(data) {
        //toastr["success"]("success");
        location.reload();
      },
      error: function error(xhr, status, _error8) {
        var msg = $('#required').val();
        toastr['warning'](msg);
      }
    }).always(function () {});
  } else {
    var msg = $('#required').val();
    toastr['warning'](msg);
  }
}

function DoFilter(type, order) {
  window.location = '/' + type + '/' + order + '/' + $("#Filter").val() + '/' + urlencode($("#Search").val());
} //------------------------------------------------------------------------------------------------------------------------------------------


function urlencode(str) {
  str = escape(str);
  str = str.replaceAll('+', '%2B');
  str = str.replaceAll('%20', '+');
  str = str.replaceAll('*', '%2A');
  str = str.replaceAll('/', '%2F');
  str = str.replaceAll('@', '%40');
  return str;
} //------------------------------------------------------------------------------------------------------------------------------------------


function urldecode(str) {
  str = str.replace('+', ' ');
  str = unescape(str);
  return str;
} //------------------------------------------------------------------------------------------------------------------------------------------


function String2DateTime(myDateTime) {
  var Answer = "";

  if (myDateTime != "") {
    var opera0 = myDateTime.split(' ');

    if (opera0.length >= 1) {
      var myDate = opera0[0];
      var opera1 = myDate.split('/');
      var opera2 = myDate.split('-');
      lopera1 = opera1.length;
      lopera2 = opera2.length;
      if (lopera1 > 1) var pdate = myDate.split('/');else if (lopera2 > 1) var pdate = myDate.split('-');
      var yy = parseInt(pdate[2], 10);
      var mm = parseInt(pdate[1], 10);
      var dd = parseInt(pdate[0], 10);
      Answer = yy + "-" + Ed2z(mm) + "-" + Ed2z(dd);
    }

    if (opera0.length >= 2) {
      Answer = Answer + " " + opera0[1];
    }
  }

  return Answer;
} //------------------------------------------------------------------------------------------------------------------------------------------


function Ed2z(Number) {
  if (Number < 10) return "0" + Number;else return "" + Number;
} //------------------------------------------------------------------------------------------------------------------------------------------


String.prototype.replaceAll = function (str1, str2, ignore) {
  return this.replace(new RegExp(str1.replace(/([\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, function (c) {
    return "\\" + c;
  }), "g" + (ignore ? "i" : "")), str2);
}; //------------------------------------------------------------------------------------------------------------------------------------------


function setajax(url, id) {
  $.ajax({
    url: url,
    data: {
      id: id
    },
    success: function success(data) {
      return data;
    },
    error: function error(xhr, status, _error9) {
      return "false";
    }
  });
}

function saveCar() {
  var carname = $('#carname').val();
  var carnumber = $('#carnumber').val();
  var url = $('#carstore').val();
  $.ajax({
    url: url,
    method: "GET",
    data: {
      carname: carname,
      carnumber: carnumber
    },
    success: function success(data) {
      if (data['success'] == "true") {
        var area = data['curcar'];
        $("#carstore").attr('disabled', false);
        $("#carstore").append('<option  selected value=' + area + '>' + area + '</option>');
      } else {
        var msg = $('#errormsg').val();
        toastr['success'](msg);
      }

      $('#carmodal').modal(msg);
    }
  });
} // function addRow(data)
// {
// 	table.row.add( {
//         "name":       "Tiger Nixon",
//         "position":   "System Architect",
//         "salary":     "$3,120",
//         "start_date": "2011/04/25",
//         "office":     "Edinburgh",
//         "extn":       "5421"
//     } ).draw();
// }