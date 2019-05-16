$(document).ready(function(){


    $.ajax({
        url :"chart_data.php",
        type : "GET",

        success : function(data){
                data =JSON.parse(data);
                var values ={
                    time : [],
                    temperature : [],
                    humidity :[],
                    pressure : [],
                    soil_moisture :[],
                    leaf_moisture :[],

                };

                var len = data.length;

                for(var i=0;i<len;i++){
                    values.time.unshift(data[i].time); 
                    values.temperature.unshift(data[i].temperature);
                    values.humidity.unshift(data[i].humidity);
                    values.pressure.unshift(data[i].pressure);
                    values.soil_moisture.unshift(data[i].soil_moisture);
                    values.leaf_moisture.unshift(data[i].leaf_humidity);

                }
                

                
 

                var ctx =$("#line-chartcanvas-temperatures");

                var data = {
                    labels : values.time,
                    datasets :[
                        {
                            label : "Temperatura zraka",
                            data : values.temperature,
                            backgroundColor:"red",
                            borderColor:"yellow",
                            fill :false,
                            lineTension:0.4,
                            pointRadius:2
                        }
                    ]

                };
                var options={
                    responsive: true,
                        legend: {
                            position: 'top',
                        },
                        hover: {
                            mode: 'label'
                        },
                        scales: {
                            xAxes: [{
                                    display: false,
                                    scaleLabel: {
                                        display: true,
                                        
                                    },
                                
                                     
                
                                    
                                }],
                            yAxes: [{
                                    display: true,
                                    ticks: {
                                       
                                        steps: 10,
                                        stepValue: 5,
                                        max: 40
                                    }
                                }]
                        },
                        title: {
                            display: false,
                            text: 'Temperatura'
                        }
                    };
                

                var chart = new Chart(ctx ,{ 
                        type: "line",
                        data :data,
                        options:options,
                       
                });


                var ctx2 =$("#line-chartcanvas-hum");

                var data2 = {
                    labels : values.time,
                    datasets :[
                        
                        {
                            label : "Vlažnost zraka",
                            data : values.humidity,
                            backgroundColor:"blue",
                            borderColor:"lightblue",
                            fill :false,
                            lineTension:0.4, 
                            pointRadius:2
                        },

                        
                    ]
                };
                var options2={
                    responsive: true,
                        legend: {
                            position:'top'
                        },
                        hover: {
                            mode: 'label'
                        },
                        scales: {
                            xAxes: [{
                                    display: false,
                                    scaleLabel: {
                                        display: true,
                                        
                                    }
                                }],
                            yAxes: [{
                                    display: true,
                                    ticks: {
                                       beginAtZero:false,
                                        steps: 10,
                                        stepValue: 10,
                                        max: 100
                                    }
                                }]
                        },
                        title: {
                            display: false,
                            text: 'Vlažnost'
                        }
                    };

                var chart2 = new Chart(ctx2 ,{ 
                        type: "line",
                        data :data2,
                        options:options2
                });

                document.getElementById('removeDatatemp').addEventListener('click', function() {
                    data.labels.shift(); // remove the label first
        
                    data.datasets.forEach(function(dataset) {
                        dataset.data.shift();
                    });
        
                    chart.update();
                });
                
                document.getElementById('removeDataHum').addEventListener('click', function() {
                    data2.labels.shift(); // remove the label first
        
                    data2.datasets.forEach(function(dataset) {
                        dataset.data.shift();
                    });
        
                    chart2.update();
                });
                
        },
        error : function(data){
            console.log(data);

        }
        
    });

});