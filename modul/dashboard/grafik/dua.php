<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script>

$(function () {
    var chart;
    $(document).ready(function() {
        
	    var container_chartCorrectiveAction = new Highcharts.Chart({
		chart: {
				renderTo: 'container_chartCorrectiveAction',
						
						type: 'bar',
						height: 195
						
					},
					title: {
						text: 'Corrective Action'
					},
					subtitle: {
						text: 'Sub-ATA () / ATA (20)'
					},
					xAxis: {
						categories: ['No Defects Found-Fastener-Loose / Displaced'],
						title: {
							text: 'Action'
						},
						labels: {
                            style: {
                                width: '12000px'
                            }
                        }
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Count',
							align: 'high'
						},
						labels: {
							overflow: 'justify'
						}
					},
					tooltip: {
						formatter: function() {
							return ''+ this.series.name +': '+ this.y +' Count';
						}
					},
					plotOptions: {
						bar: {
							dataLabels: {
								enabled: true
							}
						},
						series: {
							pointWidth:10,
                            groupPadding: .05,
							shadow: true
						}
					},
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom',
						floating: false,
						borderWidth: 1,
						backgroundColor: '#FFFFFF',
						shadow: true,
						labelFormatter: function() {
							return '<div class="' + this.name + '-arrow"></div><span style="font-family: \'Advent Pro\', sans-serif; font-size:12px">' + this.name +'</span><br/><span style="font-size:10px; color:#ababaa">   Total: ' + this.options.total + '</span>';
						}
					},
					credits: {
						enabled: false
					},
					exporting: { 
						enabled: true 
					},
					series: [{
				name: 'Heavy',
				total: '0',
				data: [null]
				},{
				name: 'Intermediate',
				total: '0',
				data: [null]
				},{
				name: 'Line',
				total: '0',
				data: [null]
				},{
				name: 'Lite',
				total: '1',
				data: [1]
				}]
				});
	
		
		var container_chartAtaFleetAvg = new Highcharts.Chart({
		chart: {
				renderTo: 'container_chartAtaFleetAvg',
						
						type: 'bar',
						height: 185
						
					},
					title: {
						text: 'Fleet Average'
					},
					subtitle: {
						text: 'ATA (20)'
					},
					xAxis: {
						categories: ['Fleet Average'],
						title: {
							text: ''
						},
						labels: {
                            style: {
                                width: '12000px'
                            }
                        }
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Average',
							align: 'high'
						},
						labels: {
							overflow: 'justify'
						}
					},
					tooltip: {
						formatter: function() {
							return ''+ this.series.name +': '+ this.y +' Average';
						}
					},
					plotOptions: {
						bar: {
							dataLabels: {
								enabled: true
							}
						},
						series: {
							pointWidth:10,
                            groupPadding: .05,
							shadow: true
						}
					},
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom',
						floating: false,
						borderWidth: 1,
						backgroundColor: '#FFFFFF',
						shadow: true,
						labelFormatter: function() {
							return '<div class="' + this.name + '-arrow"></div><span style="font-family: \'Advent Pro\', sans-serif; font-size:12px">' + this.name +'</span><br/><span style="font-size:10px; color:#ababaa">   Total: ' + this.options.total + '</span>';
						}
					},
					credits: {
						enabled: false
					},
					exporting: { 
						enabled: true 
					},
					series: [{
				name: 'Intermediate',
				total: '0.35',
				data: [0.35]
				},{
				name: 'Lite',
				total: '0.3',
				data: [0.30]
				},{
				name: 'Heavy',
				total: '0.1',
				data: [0.10]
				}]
				});
	
    });
   });

</script>

<div id="content">
    <div id="container_chartAtaFleetAvg" style="width: 700px;"></div>
    <div id="container_chartCorrectiveAction" style="width: 1400px;"></div>
</div>