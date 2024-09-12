$(document).ready(function () {
    const descRisk = $("#matrix-form").data("desc-risk");
    const decodedRiskData = atob(descRisk);

    const descriptionTooltip = JSON.parse(decodedRiskData);

    const generateTooltipHTML = (id, text) => `
        <div id='${id}' role='tooltip' class='absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-neutral-600 transition-opacity duration-300 bg-white rounded-lg tooltip shadow-[0px_4px_8px_-2px_#10182810,0px_4px_8px_-2px_#10182806] border border-neutral-300'>
            ${text}
            <div class='tooltip-arrow' data-popper-arrow></div>
        </div>
    `;

    const createMatrix = (matrixCount, isRandom = false) => {
        let array = [];

        // Create header row
        let columnHeader =
            "<div class='" +
            (matrixCount >= 12
                ? "flex gap-2"
                : "grid grid-cols-" + (matrixCount + 1) + " gap-2") +
            "'>";

        columnHeader += `
            <div class='min-w-11 text-center flex justify-center items-center bg-neutral-50 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2 cursor-pointer'></div>
        `;
        for (let j = 1; j <= matrixCount; j++) {
            columnHeader += `
                <div class='min-w-11 text-center flex justify-center items-center bg-neutral-50 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2 cursor-pointer' data-tooltip-target='tooltip-default-ej${j}' data-tooltip-placement='right'>
                    ${j}
                </div>
                ${generateTooltipHTML(
                    `tooltip-default-ej${j}`,
                    `adalah Ej (horizontal)`
                )}
            `;
        }
        columnHeader += "</div>";
        array.push(columnHeader);

        for (let i = 1; i <= matrixCount; i++) {
            let rowInputs = [];
            let rowContent =
                "<div class='" +
                (matrixCount >= 12
                    ? "flex gap-2 flex-row w-full"
                    : "grid grid-cols-" + (matrixCount + 1) + " gap-2") +
                "'>";
            rowContent += `
                <div class='min-w-11 text-center flex justify-center items-center bg-neutral-50 border border-neutral-400 text-neutral-600 text-sm rounded-lg w-full p-2 cursor-pointer' data-tooltip-target='tooltip-default-ei${i}' data-tooltip-placement='right'>
                    ${i}
                </div>
                ${generateTooltipHTML(
                    `tooltip-default-ei${i}`,
                    `adalah Ei (vertical)`
                )}
            `;

            for (let j = 1; j <= matrixCount; j++) {
                let value = "";
                let disabled = false;
                let bgClass = "";
                let borderClass = "";

                if (i === j) {
                    value = "X";
                    disabled = true;
                    bgClass = "bg-primary-100";
                    borderClass = "border-primary-400";
                } else if (i > j) {
                    disabled = true;
                    bgClass = "bg-white";
                } else if (isRandom) {
                    value = ["V", "A", "X", "O"][Math.floor(Math.random() * 4)];
                }

                if (disabled) {
                    rowInputs.push(`
                        <input type='text' name='row${i}column${j}' maxlength='1' ${
                        disabled ? "disabled" : ""
                    } class='min-w-11 text-uppercase text-center border border-neutral-400 text-neutral-600 text-sm rounded-lg focus:border-primary-400 focus:ring-primary-500 ${bgClass} ${borderClass} block w-full p-2' value='${value}' data-tooltip-target='tooltip-default-input-row${i}-column${j}' data-tooltip-placement='right' />
                    `);
                } else {
                    rowInputs.push(`
                        <select name='row${i}column${j}' class='select__ism min-w-11 text-center border border-neutral-400 text-neutral-600 text-sm rounded-lg focus:border-primary-400 focus:ring-primary-500 ${bgClass} ${borderClass} block w-full p-2' data-tooltip-target='tooltip-default-input-row${i}-column${j}' data-tooltip-placement='right'>
                            <option value=''></option>
                            <option value='V' ${
                                value === "V" ? "selected" : ""
                            }>V</option>
                            <option value='A' ${
                                value === "A" ? "selected" : ""
                            }>A</option>
                            <option value='X' ${
                                value === "X" ? "selected" : ""
                            }>X</option>
                            <option value='O' ${
                                value === "O" ? "selected" : ""
                            }>O</option>
                        </select>
                    `);
                }

                rowInputs.push(
                    `${generateTooltipHTML(
                        `tooltip-default-input-row${i}-column${j}`,
                        `Ej:${j}, ${descriptionTooltip[j - 1]}<br> Ei:${i}, ${
                            descriptionTooltip[i - 1]
                        }`
                    )}`
                );
            }

            rowContent += rowInputs.join("");
            rowContent += "</div>";
            array.push(rowContent);
        }

        return array.join("");
    };

    const updateMatrix = (matrixCount, isRandom = false) => {
        $("#matrix-results").removeClass("hidden");

        // Create matrix HTML and update the container
        const matrixHtml = createMatrix(matrixCount, isRandom);
        $("#matrix-form").removeClass("hidden").html(matrixHtml);

        // Add scrollable-x class if matrixCount > 12
        if (matrixCount > 12) {
            $("#matrix-form").addClass("scrollable-x");
        } else {
            $("#matrix-form").removeClass("scrollable-x");
        }
    };

    const riskData = $("#matrix-form").data("risk");

    $("#random-data-btn").click(() => updateMatrix(riskData, true));
    updateMatrix(riskData);
});
