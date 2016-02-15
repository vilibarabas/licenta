window.onload = function () {
	
	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
			
			fontFamily: "arial black"
		},
                animationEnabled: true,
		legend: {
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		theme: "theme1",
		data: [
		{        
			type: "pie",
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 20,
			indexLabelFontWeight: "bold",
			startAngle:0,
			indexLabelFontColor: "MistyRose",       
			indexLabelLineColor: "darkgrey", 
			indexLabelPlacement: "inside", 
			toolTipContent: "{name}: {y}hrs",
			showInLegend: true,
			indexLabel: "#percent%", 
			dataPoints: [
				{  y: document.getElementById('precent').value, name: "Time At Work", legendMarkerType: "triangle"},
				{  y: (100 - document.getElementById('precent').value), name: "Time At Home", legendMarkerType: "square"}
			]
		}
		]
	});
	chart.render();
}