var gainsarray = [];
var i;

for(i = 0; i < (gainchartdat.length); i++){
	if(gainchartdat[i].percentchange1h > 0){
	gainsarray.push({
				key : gainchartdat[i].name,
				values : gainchartdat[i].percentchange1h});
	}
}

if(gainsarray.length <= 0){
	gainsarray.push({
				key : "N/A",
				values : 1
	});
}

//alert(gainsarray);
//alert(gainsarray2);

//Donut chart example
var drawchart = function() {
nv.addGraph(function() {
  var chart = nv.models.pieChart()
      .x(function(d) { return d.key })
      .y(function(d) { return d.values })
      .showLabels(true)     //Display pie labels
      .labelThreshold(.05)  //Configure the minimum slice size for labels to show up
      .donut(true)          //Turn on Donut mode. Makes pie chart look tasty!
      .donutRatio(0.35)     //Configure how big you want the donut hole size to be.
      ;

	 chart.tooltip.valueFormatter(function (d, i) {
		 if(d > 0){
			return '+' + d + '%'
		 }
		 else{
			return d + '%'
		 }
	});
	  
    d3.select("#chart2 svg")
        .datum(gainsarray)
        .transition().duration(350)
        .call(chart);

  return chart;
});
}


	
	
drawchart();