/* globals Chart:false, feather:false */

(function () {
    "use strict";

    feather.replace({ "aria-hidden": "true" });

    // Graphs
    // var ctx = document.getElementById("myChart");
    var ctx = document.getElementById("myChart").getContext("2d");
    // eslint-disable-next-line no-unused-vars
    var myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ],
            datasets: [
                {
                    data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                    // lineTension: 0,
                    tension: 0, // Updated property for Chart.js v3+
                    backgroundColor: "transparent",
                    borderColor: "#007bff",
                    borderWidth: 4,
                    pointBackgroundColor: "#007bff",
                },
            ],
        },
        options: {
            // scales: {
            //     yAxes: [
            //         {
            //             ticks: {
            //                 beginAtZero: false,
            //             },
            //         },
            //     ],
            // },
            scales: {
                y: {
                    beginAtZero: false,
                },
            },
            legend: {
                display: false,
            },
        },
    });
})();
