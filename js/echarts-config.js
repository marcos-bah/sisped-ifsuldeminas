// based on prepared DOM, initialize echarts instance
var myChart = echarts.init(document.getElementById('myChart'));

// specify chart configuration item and data
var option = {
	title: {
		text: ''
	},
	tooltip : {
		show: true,
		trigger: 'axis' //item | axis | none
	},
	legend: {
		data:['3%', '10%', '25%', '50%', '75%', '90%', '97%']
	},
	/*color:['#000','#2f4554'],*/
	xAxis: {
		data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36]
	},
	yAxis: {},
	series: [
		{
			name: '3%',
			type: 'line',
			smooth: false,
			symbol: 'circle',
			symbolSize: 0,
			tooltip: { show: false },
			data: [1.89, 2.33, 2.77, 3.2, 3.62, 4.01, 4.37, 4.71, 5.03, 5.32, 5.59, 5.83, 6.06, 6.27, 6.46, 6.65, 6.82, 6.98, 7.14, 7.3, 7.45, 7.6, 7.75, 7.9, 8.05, 8.2, 8.34, 8.49, 8.64, 8.79, 8.95, 9.1, 9.25, 9.41, 9.56, 9.72, 9.88],
			lineStyle: {
				normal: {
					opacity: 50
				}
			},/*
			areaStyle: {
				normal: {
					color: 'white'
				}
			},
			stack: 'confidence-band',
			symbol: 'none'*/
		},
		{
			name: '10%',
			type: 'line',
			color: 'red',
			smooth: false,
			tooltip: {
				show: true,
				trigger: 'axis',
				position: function (point, params, dom, rect, size) {
					  // fixed at top
					  return [point[0], '10%'];
				}
			},
			hoverAnimation: false,
			data: [2.27, 2.79, 3.31, 3.81, 4.28, 4.73, 5.14, 5.52, 5.87, 6.18, 6.47, 6.74, 6.98, 7.2, 7.41, 7.6, 7.78, 7.95, 8.12, 8.28, 8.44, 8.59, 8.75, 8.91, 9.06, 9.22, 9.37, 9.53, 9.69, 9.86, 10.02, 10.18, 10.35, 10.51, 10.68, 10.85, 11.02],
			lineStyle: {
				normal: {
					opacity: 50
				}
			},/*
			areaStyle: {
				normal: {
					color: 'gray'
				}
			},
			stack: 'confidence-band',
			symbol: 'none'*/
		},
		{
			name: '25%',
			type: 'line',
			smooth: false,
			symbol: 'circle',
			symbolSize: 0,
			tooltip: { show: false },
			data: [2.66, 3.26, 3.85, 4.41, 4.95, 5.45, 5.9, 6.32, 6.7, 7.05, 7.36, 7.64, 7.9, 8.13, 8.35, 8.55, 8.74, 8.92, 9.09, 9.26, 9.42, 9.59, 9.75, 9.91, 10.07, 10.24, 10.41, 10.57, 10.75, 10.92, 11.09, 11.27, 11.44, 11.62, 11.8, 11.98, 12.16],
			lineStyle: {
				normal: {
					opacity: 50
				}
			},/*
			areaStyle: {
				normal: {
					color: 'gray'
				}
			},
			stack: 'confidence-band',
			symbol: 'none'*/
		},
		{
			name: '50%',
			type: 'line',
			smooth: false,
			symbol: 'circle',
			symbolSize: 0,
			tooltip: { show: false },
			data: [3.04, 3.72, 4.38, 5.02, 5.61, 6.17, 6.67, 7.13, 7.54, 7.91, 8.25, 8.55, 8.82, 9.06, 9.29, 9.5, 9.7, 9.89, 10.07, 10.24, 10.41, 10.58, 10.75, 10.92, 11.09, 11.26, 11.44, 11.61, 11.8, 11.98, 12.16, 12.35, 12.54, 12.73, 12.92, 13.11, 13.3],
			lineStyle: {
				normal: {
					opacity: 50
				}
			},/*
			areaStyle: {
				normal: {
					color: 'gray'
				}
			},
			stack: 'confidence-band',
			symbol: 'none'*/
		},
		{
			name: 'blablabalba',
			type: 'line',
			smooth: true,
			//hoverAnimation: false,
			data: [,,,,,,11.86, 12.12, 12.36, 12.58, 12.79, 12.99, 13.18, 13.37, 13.56, 13.74, 13.93, 14.13, 14.33, 14.53, 14.74, 14.95, 15.16, 15.38, 15.6, 15.83, 16.05, 16.28, 16.5, 16.72,,,,,,,,],
			lineStyle: {
				normal: {
					opacity: 50,
					color: 'green',
					width: 4,
					type: 'dotted'
				}
			},
			symbol: 'circle',
			//stack: 'confidence-band',
			symbolSize: 10,
			
		},
		{
			name: '75%',
			type: 'line',
			smooth: false,
			symbol: 'circle',
			symbolSize: 0,
			tooltip: { show: false },
			data: [3.42, 4.18, 4.92, 5.62, 6.28, 6.89, 7.44, 7.93, 8.38, 8.78, 9.13, 9.45, 9.74, 10, 10.23, 10.45, 10.66, 10.85, 11.04, 11.22, 11.4, 11.57, 11.75, 11.92, 12.1, 12.28, 12.47, 12.65, 12.85, 13.04, 13.24, 13.44, 13.64, 13.84, 14.04, 14.24, 14.44],
			lineStyle: {
				normal: {
					opacity: 50
				}
			},/*
			areaStyle: {
				normal: {
					color: 'gray'
				}
			},
			stack: 'confidence-band',
			symbol: 'none'*/
		},
		{
			name: '90%',
			type: 'line',
			smooth: false,
			symbol: 'circle',
			symbolSize: 0,
			tooltip: { show: false },
			data: [3.81, 4.64, 5.46, 6.23, 6.95, 7.61, 8.2, 8.74, 9.21, 9.64, 10.02, 10.36, 10.66, 10.93, 11.18, 11.41, 11.62, 11.82, 12.01, 12.2, 12.38, 12.56, 12.75, 12.93, 13.11, 13.3, 13.5, 13.69, 13.9, 14.1, 14.31, 14.52, 14.73, 14.94, 15.16, 15.37, 15.58],
			lineStyle: {
				normal: {
					opacity: 50
				}
			},/*
			areaStyle: {
				normal: {
					color: 'gray'
				}
			},
			stack: 'confidence-band',
			symbol: 'none'*/
		},
		{
			name: '97%',
			type: 'line',
			smooth: false,
			symbol: 'circle',
			symbolSize: 0,
			tooltip: { show: false },
			data: [4.19, 5.11, 5.99, 6.83, 7.61, 8.33, 8.97, 9.54, 10.05, 10.5, 10.9, 11.26, 11.58, 11.86, 12.12, 12.36, 12.58, 12.79, 12.99, 13.18, 13.37, 13.56, 13.74, 13.93, 14.13, 14.33, 14.53, 14.74, 14.95, 15.16, 15.38, 15.6, 15.83, 16.05, 16.28, 16.5, 16.72],
			lineStyle: {
				normal: {
					opacity: 50
				}
			},/*
			areaStyle: {
				normal: {
					color: 'gray'
				}
			},
			stack: 'confidence-band',
			symbol: 'none'*/
		}
	
	]
};

// use configuration item and data specified to show chart
myChart.setOption(option);

//Resize automaticamente usando JQuery
$(window).on('resize', function(){
	if(myChart != null && myChart != undefined){
		myChart.resize();
	}
});