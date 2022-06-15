
$("#btn-nav").click(function(){
  $(".sidebar").slideToggle('fash');
});

//pdf checked
$("#pdf_btn").click(function(){
  $("#pdf_check").slideToggle("fash");
});

$("#addbtn").click(function(){
  $("#add").slideToggle("fash");
});

$("#btnCek").click(function(){
  $("#Cek").slideToggle("fash");
});

function popup() {
    var x = document.getElementById("popup");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

function goBack() {
    window.history.back();
}
$(document).ready(function(){  
  $('#Search').keyup(function(){  
       search_table(this.value);  
  });  
  function search_table(value){  
    $('#Table tbody tr').each(function(){  
     var found = 'false';  
     $(this).each(function(){  
          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
          {  
               found = 'true';  
          }  
     });  
     if(found == 'true')  
     {  
          $(this).show();  
     }  
     else  
     {  
          $(this).hide();  
     }  
    });  
  }
}); 

var table = '#Table';
  $('#maxRows').on('change',function(){
  $('.pagination').html('');
  var trnum = 0 ; 
  var maxRows = parseInt($(this).val());
  var totalRows = $(table+' tbody tr').length;
 $(table+' tr:gt(0)').each(function(){  
  trnum++;        
  if (trnum > maxRows ){    
    $(this).hide();   
  }
  if (trnum <= maxRows ){
  	$(this).show();
  }
 });                    
 if (totalRows > maxRows){            
  var pagenum = Math.ceil(totalRows/maxRows); 
  for (var i = 1; i <= pagenum ;){
  $('.pagination').append('<li data-page="'+i+'">\
                <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
              </li>').show();
  }                     
}

$('.pagination li:first-child').addClass('active');
$('.pagination li').on('click',function(){  
  var pageNum = $(this).attr('data-page');
  var trIndex = 0 ;           
  $('.pagination li').removeClass('active');
  $(this).addClass('active');        
  $(table+' tr:gt(0)').each(function(){ 
    trIndex++;  
    if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
      $(this).hide();   
    }else {$(this).show();}         
  });                     
      }); 
  });

window.onload = function() {
        $.ajax({
            url: '?stat=onload',
            type: 'GET',
            async: false,
            timeout: 4000
        });
        popup();
    };
 window.onbeforeunload = function() {
  $.ajax({
      url: '?stat=unload',
      type: 'GET',
      async: false,
      timeout: 4000
  });
};