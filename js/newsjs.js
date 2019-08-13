//fix duplicate column
window.onbeforeunload = function () {
  window.scrollTo(0, 0);
}
	


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

	var offsetHeight = document.getElementById('myTab').offsetHeight;
	var offsetHeight2 = document.getElementById('txtitle').offsetHeight;

    document.getElementById('fillertop').style.height = ((offsetHeight + offsetHeight2)-2) + 'px';
	

	$('#myHeader').css("z-index", "999999999");	

		var clickEvent = false;
	$('#myCarousel').carousel({
		interval:   4000	
	}).on('click', '.list-group li', function() {
			clickEvent = true;
			$('.list-group li').removeClass('active');
			$(this).addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.list-group').children().length -1;
			var current = $('.list-group li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.list-group li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});

	
	function getURLParameter(name) {
		return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
	}

	if(ok){
		var page = parseInt(getURLParameter('page'), 10); 
		
	}
	else{
		var page = 0;
	}
	
	
	
      $("#homebtn").click(function(){
		window.location.href = "market";
    });

      $("#homebtn2").click(function(){
		window.location.href = "market";
    });
	
     $("#nextbtn").click(function(){
		//if(page > 15) page = 0
		var totalPage = totalpaget;
		var totalp = totalPage-2;
		if(page > totalp){
			page = 0;
		}
		else{
			page = page+1;
		}
		window.location.href = window.location.href.split(/[?#]/)[0] + '?page=' + page;
    });

      $("#backbtn").click(function(){
		  //if(page < 0), page = 15
		var totalPage = totalpaget-1;
		if(page < 1){
			page = totalPage;
		}
		else{
			page = page-1;
		}
		window.location.href = window.location.href.split(/[?#]/)[0] + '?page=' + page;
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


$(window).on('load', function() {
    var boxheight = $('#myCarousel .carousel-inner').innerHeight();
    var itemlength = $('#myCarousel .item').length;
    var triggerheight = Math.round(boxheight/itemlength+1);
	$('#myCarousel .list-group-item').outerHeight(triggerheight);
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

/*===========================================other code=========================================*/

	
//Arrow mobile, when user scrolls on x position, make arrow vanish, else show arrows
jQuery(document).ready(function ($) {
    var lastLeftLocation = 0;
    $('#outtertable').scroll(

    function (e) {
        if (lastLeftLocation > $(this).scrollLeft()) {
			$('#indicatory').show();
        } else {
            $('#indicatory').hide();
        }
        lastLeftLocation = e.currentTarget.scrollLeft;
    });
});

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