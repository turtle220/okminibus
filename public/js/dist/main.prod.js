"use strict";function savecar(){var e=$("#carstore").val(),a=$("input[name='carnumber']").val(),t=$("input[name='carname']").val();$.ajax({url:e,data:{carnumber:a,carname:t},success:function(e){if("true"==e.success){var a=e.carnumber,t=e.id;$("#car").attr("disabled",!1),$("#car").append("<option  selected value="+t+">"+a+"</option>"),$("#carmodal").modal("toggle")}else{var o=$("#successMsg").val();toastr.error(o)}},error:function(){var e=$("#errorMsg").val();toastr.error(e)}})}function resavecar(){var e=$("#carstore").val(),a=$("input[name='scarnumber']").val(),t=$("input[name='scarname']").val();$.ajax({url:e,data:{carnumber:a,carname:t},success:function(e){if("true"==e.success){var a=e.carnumber,t=e.id;$("#scar").attr("disabled",!1),$("#scar").append("<option  selected value="+t+">"+a+"</option>"),$("#scarmodal").modal("toggle")}else{var o=$("#successMsg").val();toastr.error(o)}},error:function(){var e=$("#errorMsg").val();toastr.error(e)}})}function inVoiceList(){var e=$("#username").val(),a=$("#invoicelist-pdf").val();$.ajax({url:a,method:"post",data:{name:e},success:function(e){console.log(e)}})}function resavearea(){var e=$("input[name=sdestination]").val(),a=$("#area-store").val();$.ajax({url:a,method:"GET",data:{destination:e},success:function(e){if("true"==e.success){var a=e.curarea;$("#sdestination").attr("disabled",!1),$("#sdestination").append("<option  selected value="+a+">"+a+"</option>")}else console.log("fa");$("#slocmodal").modal("hide")}})}function ticketValidation(e){validateInit();var a=!0;return $("#"+e+" input[type=text]").each(function(){console.log(this.name+":"+this.value),""==this.value&&($(this).addClass("invalid"),a=!1)}),a}function validateInit(){$("input").removeClass(".invalid")}function savearea(){var e=$("input[name=destination]").val();console.log(e);var a=$("#area-store").val();$.ajax({url:a,method:"GET",data:{destination:e},success:function(e){if("true"==e.success){var a=e.curarea;$("#destination").attr("disabled",!1),$("#destination").append("<option  selected value="+a+">"+a+"</option>")}else console.log("fa");$("#locmodal").modal("hide")}})}function modal1Dismiss(){$(".modal1-cancle").on("click",function(){location.reload()})}function FullReload(){window.location=""+window.location}function handler(){$("#myModal").modal("toggle")}function ShowBookingTicket(e){var a=$("#BookingTickets-show").val();$("#myModal").html(" "),$("#myModal").load(a+e),$("#myModal").modal("show")}function EditBookingTicket(e){var a=$("#BookingTickets-edit").val();$("#getuserlistajax").val();$("#myModal").html(" "),$("#myModal").load(a+e,function(){}),$("#myModal").modal("show")}function SaveBookingTicket(e){if(1==ticketValidation("ModalForm")){for(var a=$("#BookingTickets-save").val(),t="BTicketId="+e,o=document.getElementById("ModalForm"),r=o.elements.length,n=0;n<r;n++)""!=o.elements[n].name&&(t=t+"&"+o.elements[n].name+"="+urlencode(o.elements[n].value));$.ajax({type:"POST",url:a+e,data:t,success:function(e){if("Y"==e.ItsOk){$("#myModal").html(e.Html);var a=$("#successmsg").val();toastr.success(a)}else if("emptyuser"==e.Html){a=$("#existUserName").val();toastr.error(a),$("#Name").focus()}else toastr.error("data.Html")}}).always(function(){modal1Dismiss()})}else{var c=$("#required").val();toastr.warning(c)}}function reSaveBookingTicket(){if(1==ticketValidation("selectedModal")){for(var e=$("#BookingTickets-resave").val(),a="BTicketId=",t=document.getElementById("selectedModal"),o=t.elements.length,r=0;r<o;r++)""!=t.elements[r].name&&(a=a+"&"+t.elements[r].name+"="+urlencode(t.elements[r].value));$.ajax({type:"GET",url:e,data:a,success:function(){location.reload()},error:function(){var e=$("#required").val();toastr.warning(e)}}).always(function(){})}else{var n=$("#required").val();toastr.warning(n)}}function DoFilter(e,a){window.location="/"+e+"/"+a+"/"+$("#Filter").val()+"/"+urlencode($("#Search").val())}function urlencode(e){return e=(e=(e=(e=(e=(e=escape(e)).replaceAll("+","%2B")).replaceAll("%20","+")).replaceAll("*","%2A")).replaceAll("/","%2F")).replaceAll("@","%40")}function urldecode(e){return e=e.replace("+"," "),e=unescape(e)}function String2DateTime(e){var a="";if(""!=e){var t=e.split(" ");if(1<=t.length){var o=t[0],r=o.split("/"),n=o.split("-");if(lopera1=r.length,lopera2=n.length,1<lopera1)var c=o.split("/");else if(1<lopera2)c=o.split("-");var i=parseInt(c[2],10),s=parseInt(c[1],10),l=parseInt(c[0],10);a=i+"-"+Ed2z(s)+"-"+Ed2z(l)}2<=t.length&&(a=a+" "+t[1])}return a}function Ed2z(e){return e<10?"0"+e:""+e}function setajax(e,a){$.ajax({url:e,data:{id:a},success:function(e){return e},error:function(){return"false"}})}function saveCar(){var e=$("#carname").val(),a=$("#carnumber").val(),t=$("#carstore").val();$.ajax({url:t,method:"GET",data:{carname:e,carnumber:a},success:function(e){if("true"==e.success){var a=e.curcar;$("#carstore").attr("disabled",!1),$("#carstore").append("<option  selected value="+a+">"+a+"</option>")}else{var t=$("#errormsg").val();toastr.success(t)}$("#carmodal").modal(t)}})}$(document).ready(function(t){toastr.options={closeButton:!0,debug:!1,newestOnTop:!1,progressBar:!1,positionClass:"toast-top-right",preventDuplicates:!1,onclick:null,showDuration:"300",hideDuration:"1000",timeOut:"5000",extendedTimeOut:"1000",showEasing:"swing",hideEasing:"linear",showMethod:"fadeIn",hideMethod:"fadeOut"},t(".navbar-nav a, td a").click(function(){t(".loading-overlay").show()}),t(".role").change(function(){var e=t("#user-setrole").val();t.ajax({url:e,method:"GET",data:{id:t(this).parents("tr").find("input").val(),role:t(this).val()},success:function(e){if("true"==e.success){var a=t("#successMsg").val();toastr.success(a)}else{a=t("#errorMsg").val();toastr.success(a)}}})}),t(".update-user").click(function(){t("#useredit").submit()}),t(".update-save").click(function(){t("#update-invoice").trigger("click")}),t(function(){modal1Dismiss()}),t("#username").change(function(){t("#name").val(t("#username").val()),t("#invoice-submit").trigger("click")}),t("#bootstrap-data-table-export").on("click",".single-check1",function(){var e=t("#setcheck1").val(),a=t(this).find("#rowid").val();$t=t(this),t.ajax({url:e,data:{id:a},success:function(e){"check"==e.status?$t.find("input[type='checkbox']").prop("checked",!0):$t.find("input[type='checkbox']").prop("checked",!1)},error:function(){toastr.error("Error: please try again.")}})}),t("#bootstrap-data-table-export").on("click",".single-check",function(){var e=t("#setcheck").val(),a=t(this).find("#rowid").val();$t=t(this),t.ajax({url:e,data:{id:a},success:function(e){"check"==e.status?$t.find("input[type='checkbox']").prop("checked",!0):$t.find("input[type='checkbox']").prop("checked",!1)},error:function(){toastr.error("Error: please try again.")}})}),t("#bootstrap-data-table-export").on("click",".all",function(){t(".loading-overlay").show();var e=t("#allcheck").val();$t=t(this),t.ajax({url:e,data:{},success:function(e){"check"==e.status?t("input[type='checkbox']").prop("checked",!0):t("input[type='checkbox']").prop("checked",!1),t(".loading-overlay").hide()},error:function(){toastr.error("Error: please try again."),t(".loading-overlay").hide()}})}),t("#bootstrap-data-table-export").on("click",".all1",function(){t(".loading-overlay").show();var e=t("#all1").val();$t=t(this),t.ajax({url:e,data:{},success:function(e){"check"==e.status?t("input[type='checkbox']").prop("checked",!0):t("input[type='checkbox']").prop("checked",!1),t(".loading-overlay").hide()},error:function(){toastr.error("Error: please try again."),t(".loading-overlay").hide()}})}),t(document).on("click",".searchbtn-ticket",function(){var e=t("#ticket-keyword").val(),a=t("#BookingTickets-search").val();t.ajax({url:a,data:{keyword:e},success:function(){},error:function(){toastr.error("Error: please try again.")}})}),t(document).on("click",".sSaveBookingTicket",function(){reSaveBookingTicket()}),t(document).on("click",".ssave-area",function(){resavearea()}),t(document).on("click",".save-car",function(){savecar()}),t(document).on("click",".ssave-car",function(){resavecar()})}),String.prototype.replaceAll=function(e,a,t){return this.replace(new RegExp(e.replace(/([\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,function(e){return"\\"+e}),"g"+(t?"i":"")),a)};