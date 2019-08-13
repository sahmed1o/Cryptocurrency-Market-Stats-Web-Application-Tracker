var temparr = new Array();
var btnstate = new Array();
//localStorage.clear();

//load array with localstorage
if (localStorage.getItem("portfcoins") === null) {
  //do nothing, localstorage is empty
}
else{
	temparr = JSON.parse(localStorage['portfcoins']);
}



//check if local url parameter value is equal to some value
//if it is equal to something, then ignore this if clause
if(window.location.href.indexOf('?local=') > 0)
{
		//alert("skipping this code");
		//load array with localstorage for button state
		if (localStorage.getItem("btnstate") === null) {
		  //localstorage is empty
		  //populate array with 0, then store in local storage
		  var m = 0;
		  for (m = 0; m <= totalrows; m++){
			  btnstate[m] = 0;
		  }
		  localStorage.setItem('btnstate', JSON.stringify(btnstate));
		}
		else{
			btnstate = JSON.parse(localStorage['btnstate']);
			//alert(btnstate);
			//open or close all coin bars
			var k = 0;
			for(k = 0; k < btnstate.length; k++){
				if(btnstate[k] == 1){
					$('.portrow' + k).toggleClass("hiddent");
				}
			}
			
		}
	
}
else{
	if (localStorage.getItem("portfcoins") === null) {
	  //do nothing, localstorage is empty
	}
	else{
		//if localstorage value portfcoins is available then refresh the page with url paramters local
		window.location.href = window.location.href+"?local="+localStorage.getItem('portfcoins');
		//alert("loaded webstorage");
		
	}
}

//check if popup appears from modifying coin value
var getname;
var isopen = 0;

if(getnameurl == 0){
	var url_string = window.location.href; //window.location.href
	var url = new URL(url_string);
	var nameofcoin = url.searchParams.get("coinname");

	 var popup = document.getElementById("myPopup");
    popup.classList.remove("noshow");
    popup.classList.remove("show");
	 void popup.offsetWidth;
    popup.classList.add("show");
	popup.innerHTML = "Applied Changes to " + nameofcoin + " Holdings";
	
	if(isopen == 0){
		isopen = 1;
	}
	
	if(isopen == 1){
		setTimeout(function(){ popup.classList.remove("noshow"); popup.classList.remove("show"); void popup.offsetWidth; popup.classList.add("noshow"); isopen = 0;}, 3000);
	}
}

if(getnameurl2 == 0){
	var url_string = window.location.href; //window.location.href
	var url = new URL(url_string);
	var nameofcoin = url.searchParams.get("coinname2");

	 var popup = document.getElementById("myPopup");
    popup.classList.remove("noshow");
    popup.classList.remove("show");
	 void popup.offsetWidth;
    popup.classList.add("show");
	popup.innerHTML = nameofcoin + " Removed";
	
	if(isopen == 0){
		isopen = 1;
	}
	
	if(isopen == 1){
		setTimeout(function(){ popup.classList.remove("noshow"); popup.classList.remove("show"); void popup.offsetWidth; popup.classList.add("noshow"); isopen = 0;}, 3000);
	}
}


//hide URL get parameters
window.history.replaceState(null, null, window.location.pathname); //hide url parameters



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

//hide this button on start
$("#men2").hide();

function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    return ( (elemTop >= docViewTop));
    //return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
	
}

var hidemenphone = 0;
		 

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
	  $(".tablecellttun").css('z-index','99999999'); 

	  
		  $(".fixorder").css('display','table-row'); 
		  $(".tablecellttun").css('display','table-row'); 
		  $(".newtablr").css('display','table-row'); 
	  $(".fixorder").css('position','fixed'); 
			$(".tablecellttun").css('position','fixed');
	  if ($(window).width() < 970) {
		$(".newtablr").css('margin-top',($(".wrapper").height() + $("#gads").height()  + $("#searchtitle").height() + $("#searchtitle2").height() + $("#chart2").height() + 11)*-1); 
		$(".fixorder").css('margin-top',($(".wrapper").height() + $("#gads").height() + $("#searchtitle").height() + $("#searchtitle2").height() + $("#chart2").height() + 11)*-1); 
		$(".tablecellttun").css('margin-top',($(".wrapper").height() + $("#gads").height()  + $("#searchtitle").height() + $("#searchtitle2").height() + $("#chart2").height() + 11)*-1); 
	  
	  }
	  else{
		$(".newtablr").css('margin-top',($("#imgtop").height() + $("#cryptinflun").height() + $("#searchtitle").height() + $("#searchtitle").height() + $("#chart2").height() + $(".wrapper").height() + $("#gads").height()  + 11)*-1); 
		$(".fixorder").css('margin-top',($("#imgtop").height() + $("#cryptinflun").height() + $("#searchtitle").height() + $("#searchtitle").height() + $("#chart2").height() + $(".wrapper").height() + $("#gads").height()  + 11)*-1); 
		$(".tablecellttun").css('margin-top',($("#imgtop").height() + $("#cryptinflun").height() + $("#searchtitle").height() + $("#searchtitle").height() + $("#chart2").height() + $(".wrapper").height() + $("#gads").height()  + 11)*-1); 
	  
	  }
	  
		  fixpos = 2;
  }
  
	  if(fixpos == 0){
		  //$(".fixorder").eq(1).css('position','relative'); 
		  $(".fixorder").css('display','none'); 
		  $(".fixorder").css('position','relative');
		  $(".fixorder").css('z-index','999'); 
		  $(".tablecellttun").css('display','none'); 
		  $(".tablecellttun").css('position','relative');
		  $(".tablecellttun").css('z-index','99999999'); 
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
	

	$('#myHeader').css("z-index", "999999999");	
	
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


//Button to hide rows
$(document).on('click', '.btnclose', function () {
  $('.portrow' + $(this).val()).toggleClass("hiddent");
  
		if (localStorage.getItem("btnstate") !== null) {
			btnstate = JSON.parse(localStorage['btnstate']);
		}
  
  //save to local storage
  if(btnstate[$(this).val()] === 1){
	btnstate[$(this).val()] = 0;
  }
  else{
	btnstate[$(this).val()] = 1;
  }
  localStorage.setItem('btnstate', JSON.stringify(btnstate));
  //alert(btnstate);
});

//button to remove coin from localStorage
$(document).on('click', '.btndelete', function () {
  confirmationpopuyp($(this).val(),$(this).attr("data-value"),$(this).attr("data-value2"),$(this).attr("data-value3"),$(this).attr("data-value4"));
});

var rowid = 0;

function confirmationpopuyp(getid, name, symbol, price, amthold) {
    document.getElementById("popupty").style.display = "flex";
	document.getElementById('nameprompt').innerHTML = name + " (" + symbol + ")";
	document.getElementById('priceprompt').innerHTML = "Current Price: $" + price;
	document.getElementById('heldamt').innerHTML = "Amount Held: " + amthold + " " + symbol;
	rowid = getid;
	getname = name;
}

function closeprompt() {
    document.getElementById("popupty").style.display = "none";
}



//function to remove coin from portfolio
function removefromportfolio() {
	//make coin row invisisble
  $('.portrow' + rowid).toggleClass("hiddent");
  $('.mainrowcoin' + rowid).toggleClass("hiddent");
  
		if (localStorage.getItem("btnstate") !== null) {
			btnstate = JSON.parse(localStorage['btnstate']);
		}
		
	
	//load array with localstorage
	if (localStorage.getItem("portfcoins") === null) {
	  //do nothing, localstorage is empty
	}
	else{
		temparr = JSON.parse(localStorage['portfcoins']);
	}
  
	var pos = rowid;
    
        temparr.splice(pos, 1);
		btnstate.splice(pos, 1);
		
	
	//store button state to localstorage
	localStorage.setItem('btnstate', JSON.stringify(btnstate));
   
	
	 totalrows = totalrows - 1;
	 //save to localstorage to update array
	 localStorage.setItem('portfcoins', JSON.stringify(temparr));
		
	 //close prompt
	 closeprompt();
	 
	 if(totalrows < 0){
		$('.nocoin1').toggleClass("hiddent");
		$('.nocoin2').toggleClass("hiddent");
		$('.nocoin3').toggleClass("hiddent");
	 }
	 
	 //output message for feedback
	 //popup message feedback
	 /*
	 var popup = document.getElementById("myPopup");
    popup.classList.remove("noshow");
    popup.classList.remove("show");
	 void popup.offsetWidth;
    popup.classList.add("show");
	popup.innerHTML = getname + " removed";
	
	if(isopen == 0){
		isopen = 1;
	}
	
	if(isopen == 1){
		setTimeout(function(){ popup.classList.remove("noshow"); popup.classList.remove("show"); void popup.offsetWidth; popup.classList.add("noshow"); isopen = 0;}, 3000);
	}
	*/
	
	window.location.href = window.location.href+"?local="+localStorage.getItem('portfcoins')+ "&coinname2=" + getname;
	 
	
}

/* ===================================  modify functions ===================================================== */
function closeprompt2() {
    document.getElementById("popupty2").style.display = "none";
}

//button to remove coin from localStorage
$(document).on('click', '.btnmodify', function () {
  confirmationpopuyp2($(this).val(),$(this).attr("data-value"),$(this).attr("data-value2"),$(this).attr("data-value3"),$(this).attr("data-value4"));
});


function confirmationpopuyp2(getid, name, symbol, price, amthold) {
    document.getElementById("popupty2").style.display = "flex";
	document.getElementById('nameprompt2').innerHTML = name + " (" + symbol + ")";
	document.getElementById('priceprompt2').innerHTML = "Current Price: $" + price;
	document.getElementById('heldamt2').innerHTML = "Amount Held: " + amthold + " " + symbol;
	document.getElementById('amntuser2').value = amthold;
	document.getElementById('amtcoin2').value = amthold + " " + symbol;
	symbolcoin = symbol;
	rowid = getid;
	getname = name;
}




//function to modify coin from portfolio
function modifycoinportfolio() {
  
  //position of data row
	var pos = totalrows - (totalrows-rowid);
	
	
	//load array with localstorage
	if (localStorage.getItem("portfcoins") === null) {
	  //do nothing, localstorage is empty
	}
	else{
		temparr = JSON.parse(localStorage['portfcoins']);
	}
	 
	 //store id of coin (its rank) and the amount held by the user
	var amnt = document.getElementById('amntuser2').value;
	var newvalarr = new Array(getname, amnt);
	temparr[pos] = newvalarr;
	 
	 //alert(temparr);
	 //save to localstorage to update array
	 localStorage.setItem('portfcoins', JSON.stringify(temparr));
	 
	 //close prompt
	 closeprompt2();
	 
	 
      //window.location.href = window.location.href;
	 //$( "#outtertable" ).load( window.location.href + " #outtertable" );

	 
	 //output message for feedback
	 //popup message feedback
	 window.location.href = window.location.href+"?local="+localStorage.getItem('portfcoins')+ "&coinname=" + getname;
	 
}


var symbolcoin;


$('#amntuser2').on('keyup', function (e) {
  document.getElementById('amtcoin2').value = document.getElementById('amntuser2').value + " " + symbolcoin;
})

function addcoin(){
 document.getElementById('amntuser2').value =  parseInt(document.getElementById('amntuser2').value) + 1;
  document.getElementById('amtcoin2').value = document.getElementById('amntuser2').value + " " + symbolcoin;
}

function subcoin(){
	if(document.getElementById('amntuser2').value <= 0){
		document.getElementById('amntuser2').value = 0;
		document.getElementById('amtcoin2').value = document.getElementById('amntuser2').value + " " + symbolcoin;
	}
	else{
		document.getElementById('amntuser2').value =  parseInt(document.getElementById('amntuser2').value) - 1;
		document.getElementById('amtcoin2').value = document.getElementById('amntuser2').value + " " + symbolcoin;
	}
}

//destroy all button
function destroyallco() {
	localStorage.removeItem("portfcoins");
      window.location.href = window.location.href;
}