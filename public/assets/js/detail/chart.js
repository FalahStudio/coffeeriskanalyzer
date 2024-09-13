$(document).ready(function () {
    const canvas = $("#myChart")[0];
    const ctx = canvas.getContext("2d");
    const dataValue = JSON.parse($(canvas).attr("data-chart").trim());
    const dataValueLine = JSON.parse($(canvas).attr("data-line").trim());

    console.log(dataValue);

    const data = {
        datasets: [
            {
                type: "scatter",
                label: "Coordinate Level",
                data: dataValue.map((item) => ({
                    x: item.x,
                    y: item.y,
                })),
                backgroundColor: "#039855",
            },
            {
                type: "line",
                label: "Average Drive Power",
                data: [
                    {
                        x: parseFloat(dataValueLine.y.max.x),
                        y: dataValueLine.y.max.y,
                    },
                    {
                        x: parseFloat(dataValueLine.y.min.x),
                        y: 0,
                    },
                ],
                borderColor: "#FF5733",
            },
            {
                type: "line",
                label: "Average Dependence Power",
                data: [
                    {
                        x: parseFloat(dataValueLine.x.max.y),
                        y: dataValueLine.x.max.x,
                    },
                    {
                        x: 0,
                        y: parseFloat(dataValueLine.x.min.x),
                    },
                ],
                borderColor: "#38bdf8",
            },
        ],
    };

    // Konfigurasi chart
    const config = {
        type: "scatter", // Tipe utama chart
        data: data,
        options: {
            scales: {
                x: {
                    type: "linear",
                    position: "bottom",
                },
                y: {
                    type: "linear",
                    position: "left",
                },
            },
        },
    };

    new Chart(ctx, config);
});
