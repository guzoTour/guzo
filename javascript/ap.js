setInterval(() => {
    console.log("jashdhj")
    fetch('http://localhost:7882/Tour/utils/api.php?req=true')
    .then(res=>res.json())
    .then(data=>{
        console.log(data)
        var chart = new CanvasJS.Chart("month-chart", {
            animationEnabled: false,
            title: {
                text: "Booking Months Graph"
            },
            axisY: {
                minimum: 0,
                maximum: 100,
                suffix: "%"
            },
            data: [{
                type: "line",
                indexLabel: "{y}",
                dataPoints: data.monthData
            }]
        });

        chart.render();

        var chart1 = new CanvasJS.Chart("location-chart", {
            animationEnabled: false,
            title: {
                text: "Booking Location Graph"
            },
            axisY: {
                minimum: 0,
                maximum: 100,
                suffix: "%"
            },
            data: [{
                type: "column",
                indexLabel: "{y}",
                dataPoints: data.locationData
            }]
        });
        chart1.render();
        console.log(data)
 
    }).catch(err=>console.log(err))
}, 20000);