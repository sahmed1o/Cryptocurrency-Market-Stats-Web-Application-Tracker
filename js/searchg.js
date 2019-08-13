//fix duplicate column
window.onbeforeunload = function () {
  window.scrollTo(0, 0);
}

window.onload = function() {
	
//click on table column one when website loads to rank by number
	document.getElementById("startclk").click(); // Click on the checkbox
	
	
	/*=================== FIXED COLUMN ======================================*/
	//only happen on mobile
	var $table = $('#customers');
	
	
    //Make a clone of our table
	var $fixedColumn = $table.clone().insertBefore($table).addClass('fixed-column');
	$('.fixed-column thead tr').removeClass('afas').addClass('newtablr');
	$('.fixed-column thead tr').removeClass('js-sort-table');
	$('.fixed-column thead tr th').removeAttr('id');

    //Remove everything except for first column
	$fixedColumn.find('th,td').not('.pinned').remove();
		$('.fixed-column thead tr th').removeClass('js-sort-number');
		$('.fixed-column thead tr th').removeClass('js-sort-string');
	
	//Match the height of the rows to that of the original table's
	$fixedColumn.find('tr').each(function (i, elem) {
		$(this).height($table.find('tr:eq(' + i + ')').height());
		$(this).width($table.find('tr:eq(' + i + ')').width());
		$(this).removeClass('js-sort-number');
		$(this).removeClass('js-sort-string');
	});
	
	$fixedColumn.css("z-index", "999");
	
			
			//third
				$(".tablecellttun th").each(function (i, elem) {
				$(this).height($('.afas th').eq(i).height());
				$(this).width($('.afas th').eq(i).width());
				$(this).removeClass('js-sort-number');
				$(this).removeClass('js-sort-string');
			});
			
			//second 
			/*
				$(this).css('min-height',$('.afas th').eq(i).height());
				$(this).css('min-width',$('.afas th').eq(i).width());
			*/
			$(".fixorder th").each(function (i, elem) {
				$(this).height($('.afas th').eq(i).height());
				$(this).width($('.afas th').eq(i).width());
				$(this).removeClass('js-sort-number');
				$(this).removeClass('js-sort-string');
			});
			$('.fixorder').width($('.afas').width());
			$('.fixorder').height($('.afas').height());
			
			//first
			$(".newtablr th").each(function (i, elem) {
				$(this).height($('.afas th').eq(i).height());
				$(this).width($('.afas th').eq(i).width());
				$(this).removeClass('js-sort-number');
				$(this).removeClass('js-sort-string');
			});
			$('.newtablr').width($('.afas').width());
			$('.newtablr').height($('.afas').height());
			
			
			$(".fixorder").css('position','fixed');
			$(".tablecellttun").css('position','fixed');
	/*=================== FIXED COLUMN ======================================*/
	

	//desktop text
	  if ($(window).width() > 970) {
		$(".negative_growth3").removeClass("negative_growth3").addClass("negative_growth2");
		$(".positive_growth3").removeClass("positive_growth3").addClass("positive_growth2");
	 }
	
	   
	 
};
	
/*================== sorting table functions ===============*/
function sortrank(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclk").click();
	}
}
	
function sortname(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclkname").click();
	}
}

function sortprice(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclkprice").click();
	}
}

function sortchange(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclkchange").click();
	}
}

function sortvol(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclkvol").click();
	}
}

function sortmkcap(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclkmkcap").click();
	}
}

function sortavsuppl(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclkavsupply").click();
	}
}

function sortchangehr(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclkchangehr").click();
	}
}

function sortchangehrtwent(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclkchangehrtwent").click();
	}
}

function sortchangeday(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclkchangeday").click();
	}
}

function sorttotsup(){
	var $window = $(window);
	if ($window.width() >= 970) {
	document.getElementById("startclktotsupply").click();
	}
}
/*================== sorting table functions ===============*/
	
(function($) {
    var $window = $(window),
        $html = $('.container');
		
    function resize() {
        if ($window.width() < 970) {
            return $html.removeClass('container');
        }
	
			$html.addClass('container');
			
    }

    $window
        .resize(resize)
        .trigger('resize');
})(jQuery);

jQuery(function($){
  var windowWidth = $(window).width();
  var windowHeight = $(window).height();
  //alert("current width");

  $(window).resize(function() {
    //if(windowWidth != $(window).width() || windowHeight != $(window).height()) {
		 if(windowWidth != $(window).width() ) {
			 
 // alert("executed");
      window.location.href = window.location.href;
      return;
    }
  });
});



$(document).ready(function(){

	
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

/*===========================================other code=========================================*/
var thead = document.querySelector(".adfadfa tr:first-child");
var fillertopsz = document.querySelector("#fillertop");
if ($(window).width() >= 970) {
	var elementTarget = document.querySelector("#myHeader2");
}
else{
	var elementTarget = document.querySelector("#myHeader2");
}

var hideTop = 0;
			
//$fixedColumn.css("z-index", "999");


function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    return ( (elemTop >= docViewTop));
    //return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
}

function checkever(){
  if (!isScrolledIntoView(elementTarget)) {
      hideTop = 1;
  }
   if((hideTop == 1) && isScrolledIntoView(elementTarget)){
	  hideTop = 0;
}
  
	  	if(hideTop == 1){
			var documentScrollLeft = $(".thistablu").scrollLeft() * -1;
			thead.style["-webkit-transform"] = "translateX("+ documentScrollLeft + "px)";
			thead.style.transform = "translateX("+ documentScrollLeft + "px)";
	   }
		else{
			if ($(window).width() >= 970) {
				$(".wrapper").css('border-top', '1px solid orange');
				$(".wrapper").css('border-bottom', '1px solid orange');
				$(".wrapper").css('margin-top', '5px');
				$(".wrapper").css('height', '3vw');
			}
		 else{
				$(".wrapper").css('border-top', '1px solid orange');
				$(".wrapper").css('border-bottom', '1px solid orange');
				$(".wrapper").css('margin-top', '5px');
				$(".wrapper").css('height', '35px');
		 }
			window.onscroll = null; // unbind the event before scrolling
				var documentScrollLeft = 0;
				thead.style["-webkit-transform"] = "translateX("+ documentScrollLeft + "px)";
				thead.style.transform = "translateX("+ documentScrollLeft + "px)";
			
		}
		
		
	
		
}


var fixpos = 0;

function checkmen(){
	if (!isScrolledIntoView(elementTarget) && fixpos == 0 ) {
		  fixpos = 1;
  }
  if((fixpos == 2) && isScrolledIntoView(elementTarget)){
		  fixpos = 0;
}

  if(fixpos == 1){
	  
	  	  
			
	  $(".fixorder").css('z-index','1'); 

	  
		  $(".fixorder").css('display','table-row'); 
		  if ($(window).width() < 970) {
			$(".tablecellttun").css('display','table-row'); 
			$(".tablecellttun").css('z-index','99999999'); 
			$(".tablecellttun").css('position','fixed');
		  }
		  else{
			$(".tablecellttun").css('display','none'); 
		  }
		  $(".newtablr").css('display','table-row'); 
	  $(".fixorder").css('position','fixed'); 
	  if ($(window).width() < 970) {
		$(".newtablr").css('margin-top',($(".wrapper").height() + $("#gads").height() + $("#gads2").height() + $("#searchtitle").height() + 11)*-1); 
		$(".fixorder").css('margin-top',($(".wrapper").height() + $("#gads").height() + $("#gads2").height()  + $("#searchtitle").height() + 11)*-1); 
		$(".tablecellttun").css('margin-top',($(".wrapper").height() + $("#gads").height() + $("#gads2").height()  + $("#searchtitle").height() + 11)*-1); 
	  
	  }
	  else{
		$(".newtablr").css('margin-top',($("#imgtop").height() + $("#cryptinflun").height() + $("#searchtitle").height() + $(".wrapper").height() + $("#gads").height() + $("#gads2").height()  + 11)*-1); 
		$(".fixorder").css('margin-top',($("#imgtop").height() + $("#cryptinflun").height() + $("#searchtitle").height() + $(".wrapper").height() + $("#gads").height() + $("#gads2").height()  + 11)*-1); 
		$(".tablecellttun").css('margin-top',($("#imgtop").height() + $("#cryptinflun").height() + $("#searchtitle").height() + $(".wrapper").height() + $("#gads").height() + $("#gads2").height()  + 11)*-1); 
	  
	  }
	  
		  fixpos = 2;
  }
  
	  if(fixpos == 0){
		  //$(".fixorder").eq(1).css('position','relative'); 
		  $(".fixorder").css('display','none'); 
		  $(".fixorder").css('position','relative');
		  $(".fixorder").css('z-index','999'); 
		   if ($(window).width() < 970) {
			$(".tablecellttun").css('display','none');
			$(".tablecellttun").css('position','relative');
			$(".tablecellttun").css('z-index','99999999'); 
		   }		  
	  }
  
	  
}


	if(none_found != 1){
		$(window).scroll(function(){
		  checkmen();
		});
	}
	
	
var Interval = window.setInterval(checkever, 1);


	var offsetHeight = document.getElementById('myTab').offsetHeight;
	var offsetHeight2 = document.getElementById('txtitle').offsetHeight;

    document.getElementById('fillertop').style.height = ((offsetHeight + offsetHeight2)-2) + 'px';
	

	
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