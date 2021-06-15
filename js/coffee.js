$(document).ready(function(){

   $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
    
    $('#alertExist').hide();
    $("#username").keyup(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("username");
      var comenzarBtn = document.getElementById("comenzarBtn");
      
      if(username != ''){
         $("#uname_response").show();
         $.ajax({
            url: '../../admin/check.php',
            type: 'post',
            data: {username:username},
            success: function(response){
               // Show response
               //$("#uname_response").html(response);
               
               if(response == "1"){
                  $('#alertExist').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtn").setAttribute("disabled", '');
               }else{
                  $('#alertExist').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtn").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_response").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtn").setAttribute("disabled", '');
      }
    });

    $("#username").mouseleave(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("username");
      var comenzarBtn = document.getElementById("comenzarBtn");
      
      if(username != ''){
         $("#uname_response").show();
         $.ajax({
            url: '../../admin/check.php',
            type: 'post',
            data: {username:username},
            success: function(response){
               // Show response
               //$("#uname_response").html(response);
               
               if(response == "1"){
                  $('#alertExist').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtn").setAttribute("disabled", '');
               }else{
                  $('#alertExist').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtn").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_response").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtn").setAttribute("disabled", '');
      }
    });

    //Modal
    $('#alertExistModal').hide(); 
    $("#usernameModal").keyup(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("usernameModal");
      var comenzarBtn = document.getElementById("comenzarBtn");
      
      if(username != ''){
         $("#uname_response").show();
         $.ajax({
            url: '../../admin/check.php',
            type: 'post',
            data: {username:username},
            success: function(response){
               // Show response
               //$("#uname_response").html(response);
               
               if(response == "1"){
                  $('#alertExistModal').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtnModal").setAttribute("disabled", '');
               }else{
                  $('#alertExistModal').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtnModal").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_response").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtnModal").setAttribute("disabled", '');
      }
    });

    $("#usernameModal").mouseleave(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("usernameModal");
      var comenzarBtn = document.getElementById("comenzarBtn");
      
      if(username != ''){
         $("#uname_response").show();
         $.ajax({
            url: '../../admin/check.php',
            type: 'post',
            data: {username:username},
            success: function(response){
               // Show response
               //$("#uname_response").html(response);
               
               if(response == "1"){
                  $('#alertExistModal').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtnModal").setAttribute("disabled", '');
               }else{
                  $('#alertExistModal').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtnModal").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_response").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtn").setAttribute("disabled", '');
      }
    });

    $('#alertExistModalCreator').hide(); 
    $("#usernameModalCreator").keyup(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("usernameModalCreator");
      
      if(username != ''){
         
         $.ajax({
            url: '../../admin/check.php',
            type: 'post',
            data: {username:username},
            success: function(response){
               // Show response
               //$("#uname_response").html(response);
               
               if(response == "1"){
                  $('#alertExistModalCreator').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtnModalCreator").setAttribute("disabled", '');
               }else{
                  $('#alertExistModalCreator').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtnModalCreator").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_responseCreator").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtnModalCreator").setAttribute("disabled", '');
      }
    });

    $("#usernameModalCreator").mouseleave(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("usernameModalCreator");
      
      if(username != ''){
         
         $.ajax({
            url: '../../admin/check.php',
            type: 'post',
            data: {username:username},
            success: function(response){
               // Show response
               //$("#uname_response").html(response);
               
               if(response == "1"){
                  $('#alertExistModalCreator').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtnModalCreator").setAttribute("disabled", '');
               }else{
                  $('#alertExistModalCreator').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtnModalCreator").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_responseCreator").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtnModalCreator").setAttribute("disabled", '');
      }
    });

   $('#cancelmodifyPayment').hide();
   $('#savemodifyPayment').hide();
   $("#modifyPayment").click(function(evt){
      $('#cancelmodifyPayment').show();
      $('#savemodifyPayment').show();
      document.getElementById("inputPaypal").removeAttribute("readonly");
      document.getElementById("inputClabeBank").removeAttribute("readonly");
      document.getElementById("inputClabeBankNumber").removeAttribute("readonly");
      document.getElementById("radioActivePaypal").removeAttribute("disabled");
      document.getElementById("radioActiveClabe").removeAttribute("disabled");
      
   });

   $("#cancelmodifyPayment").click(function(evt){
      document.getElementById("inputPaypal").setAttribute("readonly", '');
      document.getElementById("inputClabeBank").setAttribute("readonly", '');
      document.getElementById("inputClabeBankNumber").setAttribute("readonly", '');
      document.getElementById("radioActivePaypal").setAttribute("disabled", '');
      document.getElementById("radioActiveClabe").setAttribute("disabled", '');
      $('#cancelmodifyPayment').hide();
      $('#savemodifyPayment').hide();
   });

   $('#cancelmodifyNotifications').hide();
   $('#savemodifyNotifications').hide();
   $("#modifyNotifications").click(function(evt){
      document.getElementById("checkFan").removeAttribute("disabled");
      document.getElementById("checkCoffe").removeAttribute("disabled");
      $('#cancelmodifyNotifications').show();
      $('#savemodifyNotifications').show();
   });

   $("#cancelmodifyNotifications").click(function(evt){
      document.getElementById("checkFan").setAttribute("disabled", '');
      document.getElementById("checkCoffe").setAttribute("disabled", '');
      $('#cancelmodifyNotifications').hide();
      $('#savemodifyNotifications').hide();
   });

   $('#cancelmodifyProfile').hide();
   $('#savemodifyProfile').hide();
   $("#modifyProfile").click(function(evt){
      document.getElementById("correo").removeAttribute("disabled");
      document.getElementById("pwd").removeAttribute("disabled");
      document.getElementById("nombre").removeAttribute("disabled");
      document.getElementById("apellido").removeAttribute("disabled");
      document.getElementById("telefono").removeAttribute("disabled");
      $('#cancelmodifyProfile').show();
      $('#savemodifyProfile').show();
   });

   $("#cancelmodifyProfile").click(function(evt){
      document.getElementById("correo").setAttribute("disabled", '');
      document.getElementById("pwd").setAttribute("disabled", '');
      document.getElementById("nombre").setAttribute("disabled", '');
      document.getElementById("apellido").setAttribute("disabled", '');
      document.getElementById("telefono").setAttribute("disabled", '');
      $('#cancelmodifyProfile').hide();
      $('#savemodifyProfile').hide();
   });

   $('#video').on('click', function(){
      
      //remove all class .active
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".video").show();
   });

   $('#all').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter      
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".card").show(); 
   });

   $('#writter').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".writter").show();
   });

   $('#developer').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".developer").show();
   });

   $('#podcaster').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".podcaster").show();
   });

   $('#artist').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".artist").show();
   });

   $('#influencer').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.other').hide();
      $(".influencer").show();
   });

   $('#other').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $(".other").show();
   });
   

   $('.currency').blur(function(){
      $('.currency').formatCurrency();
   });

   $('.currency').on('input', function (event) { 
      this.value = this.value.replace(/[^0-9]/g, '');
   });

   function openPasswordForgotten(){
      $('#iniciarSesion').modal('hide');
      $('#contrasenaOlvidada').modal('show');
   }

   let valueRadioGive = document.querySelector("valueRadioGive");
   if(valueRadioGive){
      valueRadioGive.addEventListener("change",function () {
         var frst = document.querySelector("#valueRadioGive").value;
         var priceExtra = $('#hiddenExtra').val();
         var newPrice = frst*priceExtra;
         if(frst == "1"){
            $("#test0").prop("checked", true);
         }else if(frst == "3"){
            $("#test1").prop("checked", true);
         }else if(frst == "5"){
            $("#test2").prop("checked", true);
         }else{
            $('input:radio[name=same-group-name]').each(function () { $(this).prop('checked', false); });
         }
         document.getElementById("amountCoffe").value = newPrice;
         document.getElementById("quantityCoffe").value = frst;
         $("#valueBtnExtra").text(newPrice);
      });
   }
   

   setTimeout(function() {
      $("#alertPaging").alert('close');
  }, 5000);

   $("#btnPayCreditDebit").click(function(evt){
      $('#apoyar').modal('hide');
      $('#apoyarSiguiente').modal('show');
      document.getElementById("payment-form").style.display = "block";
      document.getElementById("payment-form-paypal").style.display = "none";
   });

   $('#alertBank').hide();

   let inputMailFan1 = document.querySelector("inputMailFan1");
   if(inputMailFan1){
      inputMailFan1.addEventListener("change",function () {
         var frst = document.querySelector("#inputMailFan1").value;
         document.getElementById("inputMailFan2").value = frst;
      });
   }
   
   let inputTextFan1 = document.querySelector("inputTextFan1");
   if(inputTextFan1){
      inputTextFan1.addEventListener("change",function () {
         var frst = document.querySelector("#inputTextFan1").value;
         document.getElementById("inputTextFan2").value = frst;
      });
   }
   

   $('#inlineRadio1').click(function() {
      if($('#inlineRadio1').is(':checked')) { $("#inlineRadio12").attr('checked', 'checked'); }
   });

   $('#inlineRadio2').click(function() {
      if($('#inlineRadio2').is(':checked')) { $("#inlineRadio22").attr('checked', 'checked'); }
   });
   

   $('#preguntaSection').hide();
   $('#endLabelPaying').hide();


   let questionAnswer = document.getElementById("questionAnswer");
   if(questionAnswer){
      document.getElementById("questionAnswer").removeAttribute("required");
   }

});


$("#username").change(function() {
   $("#usernametxt").val($("#username").val());
});

$("#usernametxt").change(function() {
   $("#username").val($("#usernametxt").val());
});

$("#username").keyup(function() {
   $("#usernametxt").val($("#username").val());
});

$("#usernametxt").keyup(function() {
   $("#username").val($("#usernametxt").val());
});
 
function setTooltip(message) {
   $('#copy').tooltip('hide')
     .attr('data-original-title', message)
     .tooltip('show');
 }
 
 function hideTooltip() {
   setTimeout(function() {
     $('#copy').tooltip('hide');
   }, 1000);
 }
 

function CheckSession() {
   var session = '<%=Session["uname"] != null%>';
   if (session == false) {
       alert("Your Session has expired");
       window.location = "login.aspx";
   }
}

$('#bologna-list a').on('click', function (e) {
   e.preventDefault()
   $(this).tab('show')
})

$('input[name=same-group-name]').click(function() {
   var valueRadioGive = $('input[name=same-group-name]:checked').val();
   var priceExtra = $('#hiddenExtra').val();
   var newPrice = valueRadioGive*priceExtra;
   document.getElementById("valueRadioGive").value = valueRadioGive;
   document.getElementById("amountCoffe").value = newPrice;
   document.getElementById("quantityCoffe").value = valueRadioGive;
   $("#valueBtnExtra").text(newPrice);
});

$(document).ready(function () {
   showGraph();
});

function openRegister(){
   $('#iniciarSesion').modal('hide');
   $('#crearCuenta').modal('show');
}

function openInicio(){
   $('#iniciarSesion').modal('show');
   $('#crearCuenta').modal('hide');
}


$(document).on("click", ".browse", function() {
   var file = $(this).parents().find(".file");
   file.trigger("click");
 });
 $('input[type="file"]').change(function(e) {
   var fileName = e.target.files[0].name;
   $("#file").val(fileName);
 
   var reader = new FileReader();
   reader.onload = function(e) {
     // get loaded data and render thumbnail.
     document.getElementById("preview").src = e.target.result;
   };
   // read the image file as a data URL.
   reader.readAsDataURL(this.files[0]);
 });


let btnContainer = document.getElementById("myFansButtons");
if(btnContainer){
// Get all buttons with class="btn" inside the container
   let btns = btnContainer.getElementsByClassName("btnFans");
   if(btns){
   // Loop through the buttons and add the active class to the current/clicked button
      for (var i = 0; i < btns.length; i++) {
         btns[i].addEventListener("click", function() {
         var current = document.getElementsByClassName("btn-warning");
         current[0].className = current[0].className.replace(" btn-warning", "btn-outline-warning");
         this.className += " btn-warning";
         });
      }
   }
}





function getSummary(id)
{
   $.ajax({
      url  : "../misfans/extras.php",
      type : "POST",
      cache: false,
      data : {page_no:1, extraid:id},
      beforeSend: function(){
         $("#imageLoading").show();
      },
      complete: function(){
         $("#imageLoading").hide();
      },
      success:function(response){
         $("#table-data").html(response);
      }
   });
}


function copyToClipboard(element) {
   var $temp = $("<input>");
   $("body").append($temp);
   $temp.val($(element).text()).select();
   document.execCommand("copy");
   $temp.remove();
   setTooltip('¡Copiado!');
   hideTooltip();
}

function copyLinkToClipboard(element) {
   var $temp = $("<input>");
   $("body").append($temp);
   $temp.val($(element).text()).select();
   document.execCommand("copy");
   $temp.remove();
   setTooltipLink('¡Copiado!');
   hideTooltipLink();
}
 
function setTooltipLink(message) {
   $('#copyLink').tooltip('hide')
     .attr('data-original-title', message)
     .tooltip('show');
}
 
function hideTooltipLink() {
   setTimeout(function() {
     $('#copyLink').tooltip('hide');
   }, 1000);
}



function showGraph()
{
	{
		$.post("../chart/data.php",
			function (data)
			{
				var ctx = document.getElementById("examChart").getContext("2d");
				var today = new Date();

                var days = 8; // Days you want to subtract
                var date = new Date();
                var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
                var day =last.getDate();
                var month=last.getMonth()+1;
                var year=last.getFullYear();
                var menossiete = year+"-"+month+"-"+day+" 13:3";

                var today = new Date();
                var newdate = new Date();
                newdate.setDate(today.getDate()+5);
                var newDay = newdate.getDate();
                var newMonth = newdate.getMonth()+1;
                var newYear = newdate.getFullYear();
                var mascinco = newYear+"-"+newMonth+"-"+newDay;

                var myChart = new Chart(ctx, {
                	type: 'line',
                	data: {
                		labels: [new Date(mascinco).toLocaleString(), new Date(menossiete).toLocaleString(), new Date(mascinco).toLocaleString()],
                		datasets: [{
                			label: 'Visitas',
                			data: data,
                			backgroundColor: [
                			'rgba(255, 99, 132, 0.2)',
                			'rgba(54, 162, 235, 0.2)',
                			'rgba(255, 206, 86, 0.2)',
                			'rgba(75, 192, 192, 0.2)',
                			'rgba(153, 102, 255, 0.2)',
                			'rgba(255, 159, 64, 0.2)'
                			],
                			borderColor: [
                			'rgba(255,99,132,1)',
                			'rgba(54, 162, 235, 1)',
                			'rgba(255, 206, 86, 1)',
                			'rgba(75, 192, 192, 1)',
                			'rgba(153, 102, 255, 1)',
                			'rgba(255, 159, 64, 1)'
                			],
                			borderWidth: 1
                		}]
                	},
                	options: {
                		scales: {
                			xAxes: [{
                            type: 'time',
                            time: {
                              unit: 'day'
                            }
                			}]
                      },
                      responsive: true
                	}
                });
            });
	}
}

function activateNavbarItem(item){
   var element = document.getElementById(item);
   $('.itemActive').removeClass('active');
   element.classList.add("active");
}

$('#filters button').click(function(){
   e.preventDefault();
});