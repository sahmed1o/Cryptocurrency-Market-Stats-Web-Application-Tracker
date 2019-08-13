

jQuery(function($){
  var windowWidth = $(window).width();
  var windowHeight = $(window).height();

  $(window).resize(function() {
	  //if(windowWidth != $(window).width() || windowHeight != $(window).height()) {
    if(windowWidth != $(window).width() ) {
      window.location.href = window.location.href;
      return;
    }
  });
});



$(document).ready(function(){

	 $("#homebtn").click(function(){
		window.location.href = "market";
    });

      $("#homebtn2").click(function(){
		window.location.href = "market";
    });
	
//on search button clicked
	$("#searchbtn").click(function() {
		//alert($("#getinput").val());
		window.location.href = 'searchpg?search=' + $("#getinput").val();
	});
	
	//mobile search button clicked
	$("#searchbtn2").click(function() {
		//alert($("#getinput").val());
		window.location.href = 'searchpg?search=' + $("#getinput2").val();
	});
	
});

		
function bottombarslideup() {
    //var x = document.getElementById("menugam");
    var y = document.getElementById("slidebottommenu");
                
    if (y.className == "bottomNav transformyt") { 
        y.className = "bottomNav turnback";
        //x.style.display = "block";
        //y.style.display = "none";
   
    } else {
        
       y.className = "bottomNav transformyt";
       // x.style.display = "none";
        //y.style.display = "block";
    }
}




	var offsetHeight = document.getElementById('myTab').offsetHeight;
	var offsetHeight2 = document.getElementById('txtitle').offsetHeight;

    document.getElementById('fillertop').style.height = ((offsetHeight + offsetHeight2)-2) + 'px';
	

	$('#myHeader').css("z-index", "999999999");	
	


// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if (($(this).scrollTop() >= 50) && ($(this).scrollTop() + $(this).height() <= ($(document).height()-50))) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
		 $('#return-to-bottom').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
		$('#return-to-bottom').fadeOut(200);   // Else fade out the arrow
    }
});

$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 100);
});

$('#return-to-bottom').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : $(document).height()                       // Scroll to top of body
    }, 100);
});