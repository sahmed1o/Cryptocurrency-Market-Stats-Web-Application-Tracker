var showPrice = [];
var mkcap = [];
var vol = []; //volume in usd
var volcoin = []; //volume in crypto
var i;

var showPricedaily = [];
var mkcapdaily = [];
var voldaily = []; //volume in usd
var volcoindaily = []; //volume in crypto
var k;


var yMax = 0;

//dailydata
for(k = 0; k < (jdailyArray.length-1); k++){
	showPricedaily.push([jdailyArray[k].timestamp*1000,jdailyArray[k].price]);
	mkcapdaily.push([jdailyArray[k].timestamp*1000,parseInt(jdailyArray[k].marketCap)]);
	voldaily.push([jdailyArray[k].timestamp*1000,parseInt(jdailyArray[k].volume24)]);
	volcoindaily.push([jdailyArray[k].timestamp*1000,parseInt(jdailyArray[k].volume24/jdailyArray[k].price)]);

}



//All data
for(i = 0; i < (jArray.length-1); i++){
	showPrice.push([jArray[i].timestamp*1000,jArray[i].price]);
	mkcap.push([jArray[i].timestamp*1000,parseInt(jArray[i].marketCap)]);
	vol.push([jArray[i].timestamp*1000,parseInt(jArray[i].volume24)]);
	volcoin.push([jArray[i].timestamp*1000,parseInt(jArray[i].volume24/jArray[i].price)]);

}

var all_dat = 0; //All year
var month12_dat = Date.now() - 31556952000; //12 months (1year)
var month3_dat = Date.now() - 7889238000; //3 months
var month1_dat = Date.now() - 2629746000; //1 month
var day7_dat = Date.now() - 828718250; //7 days
var daily_dat = Date.now() - 118388321;

var newvol;
var newvolcoin;
var newmkcap;
var newshowPrice;
var chartData;



var drawchart = function() {
  nv.addGraph(function() {
	   if ($(window).width() <= 970) {
			var chart = nv.models.stackedAreaChart()
						  .margin({right: 10})
						  .margin({left: 10})
						  .x(function(d) { return d[0] })   //We can modify the data accessor functions...
						  .y(function(d) { return d[1] })   //...in case your data is formatted differently.
						  .useInteractiveGuideline(true)    //Tooltips which show all data points. Very nice!
						  .rightAlignYAxis(true)      //Let's move the y-axis to the right side.
						  .duration(500)
						  .showControls(true)       //Allow user to choose 'Stacked', 'Stream', 'Expanded' mode.
						  .color(['#00c7ff','#2fabce','#3a90a8'])
						  .showYAxis(false)
						  .tooltips(true)
						  .showLegend(false)
						  .clipEdge(true);
	   }
	   else {
	   	var chart = nv.models.stackedAreaChart()
						  .margin({right: 100})
						  .x(function(d) { return d[0] })   //We can modify the data accessor functions...
						  .y(function(d) { return d[1] })   //...in case your data is formatted differently.
						  .useInteractiveGuideline(true)    //Tooltips which show all data points. Very nice!
						  .rightAlignYAxis(true)      //Let's move the y-axis to the right side.
						  .tooltips(true)
						  .showLegend(false)
						  .duration(500)
						  .showControls(true)       //Allow user to choose 'Stacked', 'Stream', 'Expanded' mode.
						  .color(['#00c7ff','#2fabce','#3a90a8']) 
						  .clipEdge(true);
	   }

    //Format x-axis labels with custom function.
    chart.xAxis
        .tickFormat(function(d) { 
          return d3.time.format('%x')(new Date(d)) 
    });

    chart.yAxis.tickFormat(d3.format(','));
	
	chart.interactiveLayer.tooltip.contentGenerator(function (d) {
          var html = "<table><tr><td colspan='2'>" + d.value + "</td></tr>";

          d.series.forEach(function(elem){
			  if(elem.key === "Coin Price (USD)" || elem.key === "Market Cap (USD)" || elem.key === "Daily Volume (USD)"){
				html += "<tr><td>" + elem.key + "</td> <td>$" + elem.value.toLocaleString('en', {maximumSignificantDigits : 21}) + "</td></tr>";
			  }
			  else{
				html += "<tr><td>" + elem.key + "</td> <td>" + elem.value.toLocaleString('en', {maximumSignificantDigits : 21}) + "</td></tr>";
			  }
          })
		  
		  html+= "</table>";
          return html;
        })
	
	chart.yAxis.showMaxMin(false);

	
	//chart.tooltip.valueFormatter(d3.format('.8f'));
	//chart.interactiveLayer.tooltip.valueFormatter(function(d) { return d.toFixed(8) });
	//chart.interactiveLayer.tooltip.valueFormatter(d3.format(',.8f'));
	

		var ydomain = yMax*1.2;
		chart.yDomain([0,ydomain]);

	
    d3.select('#chart svg')
      .datum(chartData)
      .call(chart);
	

    nv.utils.windowResize(chart.update);
	
		chart.stacked.dispatch.on('areaClick.toggle', null);
	chart.stacked.dispatch.on('areaClick', null);
	
    return chart;
  });
}

var drawchartdaily = function() {
  nv.addGraph(function() {
	   if ($(window).width() <= 970) {
			var chart = nv.models.stackedAreaChart()
						  .margin({right: 10})
						  .margin({left: 10})
						  .x(function(d) { return d[0] })   //We can modify the data accessor functions...
						  .y(function(d) { return d[1] })   //...in case your data is formatted differently.
						  .useInteractiveGuideline(true)    //Tooltips which show all data points. Very nice!
						  .rightAlignYAxis(true)      //Let's move the y-axis to the right side.
						  .duration(500)
						  .showControls(true)       //Allow user to choose 'Stacked', 'Stream', 'Expanded' mode.
						  .color(['#00c7ff','#2fabce','#3a90a8'])
						  .showYAxis(false)
						  .tooltips(true)
						  .showLegend(false)
						  .clipEdge(true);
	   }
	   else {
	   	var chart = nv.models.stackedAreaChart()
						  .margin({right: 100})
						  .x(function(d) { return d[0] })   //We can modify the data accessor functions...
						  .y(function(d) { return d[1] })   //...in case your data is formatted differently.
						  .useInteractiveGuideline(true)    //Tooltips which show all data points. Very nice!
						  .rightAlignYAxis(true)      //Let's move the y-axis to the right side.
						  .tooltips(true)
						  .duration(500)
						  .showLegend(false)
						  .showControls(true)       //Allow user to choose 'Stacked', 'Stream', 'Expanded' mode.
						  .color(['#00c7ff','#2fabce','#3a90a8']) 
						  .clipEdge(true);
	   }

    //Format x-axis labels with custom function.
    chart.xAxis
        .tickFormat(function(d) { 
          return new Date(d).toLocaleTimeString()
    });
	
	chart.interactiveLayer.tooltip.contentGenerator(function (d) {
          var html = "<table><tr><td colspan='2'>" + d.value + "</td></tr>";

          d.series.forEach(function(elem){
			  if(elem.key === "Coin Price (USD)" || elem.key === "Market Cap (USD)" || elem.key === "Daily Volume (USD)"){
				html += "<tr><td>" + elem.key + "</td> <td>$" + elem.value.toLocaleString('en', {maximumSignificantDigits : 21}) + "</td></tr>";
			  }
			  else{
				html += "<tr><td>" + elem.key + "</td> <td>" + elem.value.toLocaleString('en', {maximumSignificantDigits : 21}) + "</td></tr>";
			  }
          })
		  
		  html+= "</table>";
          return html;
        })

    chart.yAxis.tickFormat(d3.format(','));
	
	chart.yAxis.showMaxMin(false);
	


		var ydomain = yMax*1.5;
		chart.yDomain([0,ydomain]);

	
	/*
		 maxValue = Math.max.apply(Math,data[0].values.map(function(o){return o[1];}));
	 minValue = Math.min.apply(Math,data[0].values.map(function(o){return o[1];}));
	 margin = 0.1 * (maxValue - minValue);
	 options.chart.yDomain = [minValue, maxValue+margin];

	*/
	
	//chart.tooltip.valueFormatter(d3.format('.8f'));
	//chart.interactiveLayer.tooltip.valueFormatter(function(d) { return d.toFixed(8) });
	//chart.interactiveLayer.tooltip.valueFormatter(d3.format(',.8f'));
	
	
	
    d3.select('#chart svg')
      .datum(chartData)
      .call(chart);
	

    nv.utils.windowResize(chart.update);
	
		chart.stacked.dispatch.on('areaClick.toggle', null);
	chart.stacked.dispatch.on('areaClick', null);
	
    return chart;
  });
}

var showwhichdat = 0;

function alldat(){
	
showwhichdat = 0;

$("#gr1").removeClass("graphclick");
$("#gr2").removeClass("graphclick");
$("#gr3").removeClass("graphclick");
$("#gr4").removeClass("graphclick");
$("#gr5").removeClass("graphclick");
$("#gr6").addClass("graphclick");
$(".nvtooltip").remove();
$("#chart svg").empty();

	if(graphtype == 0){
		
		newvol = vol.filter(function(data) {
			return data[0] >= all_dat;
		});
		
		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= all_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= all_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= all_dat;
		});
		
		
		chartData = [ 
				
			{ 
			  key : "Market Cap (USD)" , 
			  values : newmkcap 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];
		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));
		
		var yMaxmkcap = Math.max.apply(null,
                        Object.keys(newmkcap).map(function(e) {
                                return newmkcap[e][1];
                        }));
						
								
		yMax = yMaxPrice + yMaxmkcap;
		
		drawchart(); //draw graph
		
	}
	else{
		 newvol = vol.filter(function(data) {
			return data[0] >= all_dat;
		});

		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= all_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= all_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= all_dat;
		});
		
		chartData = [ 
				
			{ 
			  key : "Daily Volume (" + coinnamie + ")" , 
			  values : newvolcoin 
			} ,
			
			{ 
			  key : "Daily Volume (USD)" , 
			  values : newvol 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];

		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));

		var yMaxDailyVol = Math.max.apply(null,
                        Object.keys(newvolcoin).map(function(e) {
                                return newvolcoin[e][1];
                        }));
						
		var yMaxnewvol = Math.max.apply(null,
                        Object.keys(newvol).map(function(e) {
                                return newvol[e][1];
                        }));
								
		yMax = yMaxDailyVol + yMaxnewvol + yMaxPrice;
		
		drawchart(); //draw graph
	}
	
}

function month12year(){
	
showwhichdat = 1;

$("#gr1").removeClass("graphclick");
$("#gr2").removeClass("graphclick");
$("#gr3").removeClass("graphclick");
$("#gr4").removeClass("graphclick");
$("#gr5").addClass("graphclick");
$("#gr6").removeClass("graphclick");
$(".nvtooltip").remove();
$("#chart svg").empty();

if(graphtype == 0){
		
		newvol = vol.filter(function(data) {
			return data[0] >= month12_dat;
		});

		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= month12_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= month12_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= month12_dat;
		});
		
		
		chartData = [ 
				
			{ 
			    key : "Market Cap (USD)" , 
			  values : newmkcap 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];
		

		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));
		
		var yMaxmkcap = Math.max.apply(null,
                        Object.keys(newmkcap).map(function(e) {
                                return newmkcap[e][1];
                        }));
						
		yMax = yMaxPrice + yMaxmkcap;
		
		drawchart(); //draw graph
		
	}
	else{
		 newvol = vol.filter(function(data) {
			return data[0] >= month12_dat;
		});

		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= month12_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= month12_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= month12_dat;
		});
		
		
		chartData = [ 
					
			{ 
			  key : "Daily Volume (" + coinnamie + ")" , 
			  values : newvolcoin 
			} ,
			
			{ 
			  key : "Daily Volume (USD)" , 
			  values : newvol 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];
		

		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));

		var yMaxDailyVol = Math.max.apply(null,
                        Object.keys(newvolcoin).map(function(e) {
                                return newvolcoin[e][1];
                        }));
						
		var yMaxnewvol = Math.max.apply(null,
                        Object.keys(newvol).map(function(e) {
                                return newvol[e][1];
                        }));
								
		yMax = yMaxDailyVol + yMaxnewvol + yMaxPrice;
		
		drawchart(); //draw graph
	}

}

function month3(){
	
showwhichdat = 2;

$("#gr1").removeClass("graphclick");
$("#gr2").removeClass("graphclick");
$("#gr3").removeClass("graphclick");
$("#gr4").addClass("graphclick");
$("#gr5").removeClass("graphclick");
$("#gr6").removeClass("graphclick");
$(".nvtooltip").remove();
$("#chart svg").empty();

if(graphtype == 0){
		
		newvol = vol.filter(function(data) {
			return data[0] >= month3_dat;
		});

		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= month3_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= month3_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= month3_dat;
		});
		
		
		chartData = [ 
				
			{ 
			  key : "Market Cap (USD)" , 
			  values : newmkcap 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];

		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));
		
		var yMaxmkcap = Math.max.apply(null,
                        Object.keys(newmkcap).map(function(e) {
                                return newmkcap[e][1];
                        }));
						
		yMax = yMaxPrice + yMaxmkcap;
		
		drawchart(); //draw graph
		
	}
	else{
		 newvol = vol.filter(function(data) {
			return data[0] >= month3_dat;
		});

		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= month3_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= month3_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= month3_dat;
		});
		
		
		chartData = [ 
						
			{ 
			  key : "Daily Volume (" + coinnamie + ")" , 
			  values : newvolcoin 
			} ,
			
			{ 
			  key : "Daily Volume (USD)" , 
			  values : newvol 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];

		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));

		var yMaxDailyVol = Math.max.apply(null,
                        Object.keys(newvolcoin).map(function(e) {
                                return newvolcoin[e][1];
                        }));
						
		var yMaxnewvol = Math.max.apply(null,
                        Object.keys(newvol).map(function(e) {
                                return newvol[e][1];
                        }));
								
		yMax = yMaxDailyVol + yMaxnewvol + yMaxPrice;
		
		drawchart(); //draw graph
	}
	
}

function month1(){
	
showwhichdat = 3;

$("#gr1").removeClass("graphclick");
$("#gr2").removeClass("graphclick");
$("#gr3").addClass("graphclick");
$("#gr4").removeClass("graphclick");
$("#gr5").removeClass("graphclick");
$("#gr6").removeClass("graphclick");
$(".nvtooltip").remove();
$("#chart svg").empty();

if(graphtype == 0){
		
		newvol = vol.filter(function(data) {
			return data[0] >= month1_dat;
		});

		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= month1_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= month1_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= month1_dat;
		});
		
		
		chartData = [ 
				
			{ 
			  key : "Market Cap (USD)" , 
			  values : newmkcap 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];

		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));
		
		var yMaxmkcap = Math.max.apply(null,
                        Object.keys(newmkcap).map(function(e) {
                                return newmkcap[e][1];
                        }));
						
		yMax = yMaxPrice + yMaxmkcap;
		
		drawchart(); //draw graph
		
	}
	else{
		 newvol = vol.filter(function(data) {
			return data[0] >= month1_dat;
		});

		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= month1_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= month1_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= month1_dat;
		});
		
		
		chartData = [ 
						
			{ 
			  key : "Daily Volume (" + coinnamie + ")" , 
			  values : newvolcoin 
			} ,
			
			{ 
			  key : "Daily Volume (USD)" , 
			  values : newvol 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];
		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));

		var yMaxDailyVol = Math.max.apply(null,
                        Object.keys(newvolcoin).map(function(e) {
                                return newvolcoin[e][1];
                        }));
						
		var yMaxnewvol = Math.max.apply(null,
                        Object.keys(newvol).map(function(e) {
                                return newvol[e][1];
                        }));
								
		yMax = yMaxDailyVol + yMaxnewvol + yMaxPrice;
		
		drawchart(); //draw graph
	}

}

function day7dat(){
	
showwhichdat = 4;

$("#gr1").removeClass("graphclick");
$("#gr2").addClass("graphclick");
$("#gr3").removeClass("graphclick");
$("#gr4").removeClass("graphclick");
$("#gr5").removeClass("graphclick");
$("#gr6").removeClass("graphclick");
$(".nvtooltip").remove();
$("#chart svg").empty();

if(graphtype == 0){
		
		newvol = vol.filter(function(data) {
			return data[0] >= day7_dat;
		});

		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= day7_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= day7_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= day7_dat;
		});
		
		
		chartData = [ 
				
			{ 
			   key : "Market Cap (USD)" , 
			  values : newmkcap 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];
		

		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));
		
		var yMaxmkcap = Math.max.apply(null,
                        Object.keys(newmkcap).map(function(e) {
                                return newmkcap[e][1];
                        }));
						
			yMax = yMaxPrice + yMaxmkcap;
		
		drawchart(); //draw graph
		
	}
	else{
		 newvol = vol.filter(function(data) {
			return data[0] >= day7_dat;
		});

		newvolcoin = volcoin.filter(function(data) {
			return data[0] >= day7_dat;
		});

		 newmkcap = mkcap.filter(function(data) {
			return data[0] >= day7_dat;
		});

		 newshowPrice = showPrice.filter(function(data) {
			return data[0] >= day7_dat;
		});
		
		
		chartData = [ 
						
			{ 
			  key : "Daily Volume (" + coinnamie + ")" , 
			  values : newvolcoin 
			} ,
			
			{ 
			  key : "Daily Volume (USD)" , 
			  values : newvol 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];
		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));

		var yMaxDailyVol = Math.max.apply(null,
                        Object.keys(newvolcoin).map(function(e) {
                                return newvolcoin[e][1];
                        }));
						
		var yMaxnewvol = Math.max.apply(null,
                        Object.keys(newvol).map(function(e) {
                                return newvol[e][1];
                        }));
								
		yMax = yMaxDailyVol + yMaxnewvol + yMaxPrice;
		
		drawchart(); //draw graph
	}

}

function dailydat(){
	
showwhichdat = 5;

$("#gr1").addClass("graphclick");
$("#gr2").removeClass("graphclick");
$("#gr3").removeClass("graphclick");
$("#gr4").removeClass("graphclick");
$("#gr5").removeClass("graphclick");
$("#gr6").removeClass("graphclick");
$(".nvtooltip").remove();
$("#chart svg").empty();
	
if(graphtype == 0){
		
		newvol = voldaily.filter(function(data) {
			return data[0] >= daily_dat;
		});

		newvolcoin = volcoindaily.filter(function(data) {
			return data[0] >= daily_dat;
		});

		 newmkcap = mkcapdaily.filter(function(data) {
			return data[0] >= daily_dat;
		});

		 newshowPrice = showPricedaily.filter(function(data) {
			return data[0] >= daily_dat;
		});
		
		
		chartData = [ 
				
			{ 
			  key : "Market Cap (USD)" , 
			  values : newmkcap 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];
		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));
		
		var yMaxmkcap = Math.max.apply(null,
                        Object.keys(newmkcap).map(function(e) {
                                return newmkcap[e][1];
                        }));
						
		yMax = yMaxPrice + yMaxmkcap;

		
		drawchartdaily(); //draw graph
		
	}
	else{
		 newvol = voldaily.filter(function(data) {
			return data[0] >= daily_dat;
		});

		newvolcoin = volcoindaily.filter(function(data) {
			return data[0] >= daily_dat;
		});

		 newmkcap = mkcapdaily.filter(function(data) {
			return data[0] >= daily_dat;
		});

		 newshowPrice = showPricedaily.filter(function(data) {
			return data[0] >= daily_dat;
		});
		
		
		chartData = [ 
						
			{ 
			  key : "Daily Volume (" + coinnamie + ")" , 
			  values : newvolcoin 
			} ,
			
			{ 
			  key : "Daily Volume (USD)" , 
			  values : newvol 
			} ,
			
			{ 
			  key : "Coin Price (USD)" , 
			  values : newshowPrice 
			} 

		];
		
		var yMaxPrice = Math.max.apply(null,
                        Object.keys(newshowPrice).map(function(e) {
                                return newshowPrice[e][1];
                        }));

		var yMaxDailyVol = Math.max.apply(null,
                        Object.keys(newvolcoin).map(function(e) {
                                return newvolcoin[e][1];
                        }));
						
		var yMaxnewvol = Math.max.apply(null,
                        Object.keys(newvol).map(function(e) {
                                return newvol[e][1];
                        }));
								
	
		yMax = yMaxDailyVol + yMaxnewvol + yMaxPrice;

		
		drawchartdaily(); //draw graph
	}
	
}

function whichdat(){
	if(showwhichdat == 0){
		alldat();
	}
	else if(showwhichdat == 1){
		month12year();
	}
	else if(showwhichdat == 2){
		month3();
	}
	else if(showwhichdat == 3){
		month1();
	}
	else if(showwhichdat == 4){
		day7dat();
	}
	else if(showwhichdat == 5){
		dailydat();
	}
}

function changegraphtype(){
		graphtype = 1;
		whichdat();
		$("#graphchoice").addClass("graphclick");
		$("#graphchoice2").removeClass("graphclick");
}

function changegraphtype2(){
		graphtype = 0;
		whichdat();
		$("#graphchoice").removeClass("graphclick");
		$("#graphchoice2").addClass("graphclick");
}

//for exchange chart
var hideexchangedt = 0;

function showall(){
		if(hideexchangedt == 0){
			$("#shall").text("Hide");
			$("#showall").css('background-color','#d42020');
			$("#showall").css('border-color','#9e3838');
			$(".hidetr").show();
			hideexchangedt = 1;
		}
		else{
			$("#shall").text("Show All");
			$("#showall").css('background-color','#337ab7');
			$("#showall").css('border-color','#2e6da4');
			$(".hidetr").hide();
			hideexchangedt = 0;
		}
		$("#graphchoice").addClass("graphclick");
		$("#graphchoice2").removeClass("graphclick");
}

changegraphtype2();

