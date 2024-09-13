$(document).ready(function () {
    const createInputMatrix = (matrixCount, fixedData) => {
        let matrixHtml = [];

        let columnHeader = `<div class='flex flex-row gap-2'>`;
        columnHeader += `<div class='text-center flex justify-center items-center bg-neutral-50 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2'></div>`;

        for (let j = 1; j <= matrixCount; j++) {
            columnHeader += `<div class='text-center flex justify-center items-center bg-neutral-50 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2'>${j}</div>`;
        }

        columnHeader += `<div class='text-center flex justify-center items-center bg-neutral-200 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2'>Dr P</div>`;

        columnHeader += `</div>`;
        matrixHtml.push(columnHeader);

        for (let i = 0; i < matrixCount + 1; i++) {
            let rowInputs = [];

            let rowContent = `<div class='flex flex-row gap-2'>`;
            let isLastRow = i === matrixCount;

            rowContent += `<div class='text-center flex justify-center items-center bg-neutral-50 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2 ${
                isLastRow ? "bg-neutral-200" : ""
            }'>${i + 1 === 23 ? "De P" : i + 1}</div>`;

            for (let j = 1; j <= matrixCount + 1; j++) {
                let value = "";
                let disabled = false;
                let bgClass = "";
                let borderClass = "";
                let textColor = "text-neutral-600";

                let index = i * (matrixCount + 1) + (j - 1);
                value = fixedData[index];

                let isLastColumn = j === matrixCount + 1;
                if (i === j - 1) {
                    disabled = true;
                    bgClass = "bg-primary-100";
                    borderClass = "border-primary-400";
                } else if (i > j - 1) {
                    disabled = true;
                    bgClass = "bg-white";
                } else if (isLastColumn) {
                    bgClass = "bg-neutral-200";
                }

                if (i === 22) {
                    bgClass = "bg-neutral-200";
                }

                if (isLastRow && isLastColumn) {
                    bgClass = "bg-primary-700";
                    textColor = "text-neutral-50";
                    borderClass = "border-primary-800";
                }

                let inputHtml = `<div class='text-uppercase text-center border ${textColor} border-neutral-400 text-sm rounded-lg focus:border-primary-400 focus:ring-primary-500 ${bgClass} ${borderClass} block w-full p-2'>${value}</div>`;
                rowInputs.push(inputHtml);
            }

            rowContent += rowInputs.join("");
            rowContent += `</div>`;
            matrixHtml.push(rowContent);
        }

        return matrixHtml.join("");
    };

    let matrixData = $("#matrix_data_binner").attr("data-matrix").trim();
    let matrix = $("#matrix_data_binner").attr("data-risk");
    let dataArray = matrixData.split(" ");

    let matrixHTML = createInputMatrix(5, dataArray);
    $("#matrix_data_binner").html(matrixHTML);
});
