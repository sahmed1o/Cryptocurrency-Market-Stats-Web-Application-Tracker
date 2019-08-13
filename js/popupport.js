var namecoin;
var getname;
var temparr = new Array();
var symbolcoin;

//localStorage.clear();

//load array with localstorage
if (localStorage.getItem("portfcoins") === null) {
  //do nothing, localstorage is empty
}
else{
	temparr = JSON.parse(localStorage['portfcoins']);
}


$(document).ready(function() {
    $("#amntuser").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});



$('#amntuser').on('keyup', function (e) {
  document.getElementById('amtcoin').value = document.getElementById('amntuser').value + " " + symbolcoin;
})

function addcoin(){
 document.getElementById('amntuser').value =  parseInt(document.getElementById('amntuser').value) + 1;
  document.getElementById('amtcoin').value = document.getElementById('amntuser').value + " " + symbolcoin;
}

function subcoin(){
	if(document.getElementById('amntuser').value <= 0){
		document.getElementById('amntuser').value = 0;
		document.getElementById('amtcoin').value = document.getElementById('amntuser').value + " " + symbolcoin;
	}
	else{
		document.getElementById('amntuser').value =  parseInt(document.getElementById('amntuser').value) - 1;
		document.getElementById('amtcoin').value = document.getElementById('amntuser').value + " " + symbolcoin;
	}
}



function openprompt(name,price,id,symbol) {
    document.getElementById("popupty").style.display = "flex";
	document.getElementById('nameprompt').innerHTML = name + " (" + symbol + ")";
	document.getElementById('priceprompt').innerHTML = "Current Price: $" + price;
	namecoin = name;
	getname = name;
	symbolcoin = symbol;
	document.getElementById('amntuser').value = 0;
  document.getElementById('amtcoin').value = "0 " + symbolcoin;
	//alert("name:" + name + " price:" + price);
	
	//load array stored in localstorage
}

function closeprompt() {
    document.getElementById("popupty").style.display = "none";
}

var isopen = 0;

function addtoportfolio() {
    document.getElementById("popupty").style.display = "none";
	
	
	//load array with localstorage
	if (localStorage.getItem("portfcoins") === null) {
	  //do nothing, localstorage is empty
	}
	else{
		temparr = JSON.parse(localStorage['portfcoins']);
	}
	
	//store in localstorage, portfolio page will load this data, if not then default it
	//store id of coin (its rank) and the amount held by the user
	var amnt = document.getElementById('amntuser').value;
	var newvalarr = new Array(getname, amnt);
	temparr.push(newvalarr);
	//alert(JSON.stringify(temparr));
	localStorage.setItem('portfcoins', JSON.stringify(temparr));
	//alert(JSON.parse(localStorage['portfcoins']));

	
	//popup message feedback
	 var popup = document.getElementById("myPopup");
    popup.classList.remove("noshow");
    popup.classList.remove("show");
	 void popup.offsetWidth;
    popup.classList.add("show");
	popup.innerHTML = namecoin + " Added";
	
	if(isopen == 0){
		isopen = 1;
	}
	
	if(isopen == 1){
		setTimeout(function(){ popup.classList.remove("noshow"); popup.classList.remove("show"); void popup.offsetWidth; popup.classList.add("noshow"); isopen = 0;}, 3000);
	}
	
	
}

function removefromportfolio() {
    document.getElementById("popupty").style.display = "none";
	
	//store in localstorage, portfolio page will load this data, if not then default it
	//store id of coin (its rank) and the amount held by the user
	
	
	//popup message feedback
	 var popup = document.getElementById("myPopup");
    popup.classList.remove("noshow");
    popup.classList.remove("show");
	 void popup.offsetWidth;
    popup.classList.add("show");
	popup.innerHTML = namecoin + " Removed";
	
	if(isopen == 0){
		isopen = 1;
	}
	
	if(isopen == 1){
		setTimeout(function(){ popup.classList.remove("noshow"); popup.classList.remove("show"); void popup.offsetWidth; popup.classList.add("noshow"); isopen = 0;}, 3000);
	}
	
	
}