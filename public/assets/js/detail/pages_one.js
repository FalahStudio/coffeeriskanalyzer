$(document).ready(function () {
    const createInputMatrix = (matrixCount, fixedData) => {
        var array = [];

        var columnHeader = "<div class='flex flex-row gap-2'>";
        columnHeader += `<div class='text-center flex justify-center items-center bg-neutral-50 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2'></div>`;
        for (let j = 1; j <= matrixCount; j++) {
            columnHeader += `<div class='text-center flex justify-center items-center bg-neutral-50 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2'>${j}</div>`;
        }
        columnHeader += "</div>";
        array.push(columnHeader);

        for (let i = 0; i < matrixCount; i++) {
            var rowInputs = [];

            var rowContent = "<div class='flex flex-row gap-2'>";
            rowContent += `<div class='text-center flex justify-center items-center bg-neutral-50 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2'>${
                i + 1
            }</div>`;

            for (let j = 1; j <= matrixCount; j++) {
                let value = "";
                let disabled = false;
                let bgClass = "";
                let borderClass = "";

                if (i === j - 1) {
                    value = "X";
                    disabled = true;
                    bgClass = "bg-primary-100";
                    borderClass = "border-primary-400";
                } else if (i > j - 1) {
                    value = "";
                    disabled = true;
                    bgClass = "bg-white";
                } else {
                    const index = ((j - 2) * (j - 3)) / 2 + i;
                    value = fixedData[index];
                    disabled = false;
                }

                rowInputs.push(
                    `<div type='text' name='row${i}column${j}' maxlength='1' ${
                        disabled ? "disabled" : ""
                    } class='text-uppercase text-center border border-neutral-400 text-neutral-600 text-sm rounded-lg focus:border-primary-400 focus:ring-primary-500 ${bgClass} ${borderClass} block w-full p-2' >${value}</div>`
                );
            }

            rowContent += rowInputs.join("");
            rowContent += "</div>";
            array.push(rowContent);
        }

        return array.join("");
    };

    $("[id^=matrix_]").each(function (index) {
        let matrixData = $(this).attr("data-matrix");
        let matrix = $(this).attr("data-risk");
        matrixData = matrixData.trim();
        var dataArray = matrixData.split(" ");

        let matrixHTML = createInputMatrix(matrix, dataArray);
        $(this).html(matrixHTML);
    });
});
