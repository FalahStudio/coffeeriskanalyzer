$(document).ready(function () {
    var currentStep = 1;
    showStep(currentStep);
    let jsonDataElement = $("#data-ism");

    const descRisk = jsonDataElement.data("desc-risk");
    const decodedRiskData = atob(descRisk);

    const descRiskRawData = JSON.parse(decodedRiskData);

    const varResiko = descRiskRawData.reduce((acc, item, index) => {
        acc[`E${index + 1}`] = item;
        return acc;
    }, {});

    const data_ism = jsonDataElement.data("process-ism");
    const decodeDataIsm = atob(data_ism);
    const dataIsm = JSON.parse(decodeDataIsm);

    let linkage = dataIsm.data_result.linkage;
    let independent = dataIsm.data_result.independent;

    let input_data = $.merge(linkage, independent);

    let tooltipSeverity = [
        "Tidak ada pengaruh",
        "Sistem dapat beroperasi dengan sedikit gangguan",
        "Sistem dapat beroperasi dengan penurunan pada beberapa performa",
        "Sistem dapat beroperasi namun dengan penurunan performa yang signifikan",
        "Sistem tidak dapat beroperasi tanpa kerusakan",
        "Sistem tidak dapat beroperasi dengan tingkat kerusakan yang kecil",
        "Sistem tidak dapat beroperasi dengan kerusakan pada peralatan",
        "Sistem tidak dapat beroperasi dengan kegagalan yang menyebabkan kerusakan",
        "Tingkat keparahan sangat tinggi dan dengan peringatan",
        "Tingkat keparahan sangat tinggi dan tanpa peringatan",
    ];

    let tooltipOccurance = [
        "Kemungkinan Kegagalan < 1 dalam 1.500.000",
        "Kemungkinan Kegagalan 1 dalam 150.000",
        "Kemungkinan Kegagalan 1 dalam 15.000",
        "Kemungkinan Kegagalan 1 dalam 2000",
        "Kemungkinan Kegagalan 1 dalam 400",
        "Kemungkinan Kegagalan 1 dalam 80",
        "Kemungkinan Kegagalan 1 dalam 20",
        "Kemungkinan Kegagalan 1 dalam 8",
        "Kemungkinan Kegagalan 1 dalam 3",
        "Kemungkinan Kegagalan >1 dalam 2",
    ];

    let tooltipDetection = [
        "Kontrol desain akan mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya",
        "Kontrol desain sangat tinggi kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya",
        "Kontrol desain tinggi kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya",
        "Kontrol desain cukup tinggi kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya",
        "Kontrol desain sedang kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya",
        "Kontrol desain kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya",
        "Kontrol desain sangat kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya",
        "Kontrol desain kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya",
        "Kontrol desain sangat kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya",
        "Kontrol desain tidak dapat mendeteksi penyebab/mekanisme potensial dan mode kegagalan berikutnya",
    ];

    const generateTooltipHTML = (id, text, index) => `
        <div id='${id}' role='tooltip' class='absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-neutral-600 transition-opacity duration-300 bg-white rounded-lg tooltip shadow-[0px_4px_8px_-2px_#10182810,0px_4px_8px_-2px_#10182806] border border-neutral-300'>
            ${index + 1}: ${text}
            <div class='tooltip-arrow' data-popper-arrow></div>
        </div>
    `;

    function createInput(
        input_name,
        input_target,
        left_text,
        right_text,
        tooltipData
    ) {
        input_data.forEach((element, index) => {
            var text = varResiko[`E${element}`];
            var $newElement = $("<div>")
                .addClass("flex flex-col mt-6 gap-5")
                .append(
                    $("<div>")
                        .addClass("flex flex-col gap-2")
                        .append(
                            $("<h5>")
                                .addClass(
                                    "text-base text-neutral-800 font-semibold"
                                )
                                .text(element + " - " + text)
                        )
                        .append(
                            $("<h5>")
                                .addClass(
                                    "text-base text-neutral-600 font-normal"
                                )
                                .text("Komponen Risiko")
                        )
                )
                .append(
                    $("<div>")
                        .addClass("flex items-center justify-center gap-8")
                        .append(
                            $("<p>")
                                .addClass(
                                    "pl-[77px] py-2 pr-3 text-neutral-800 text-sm font-medium inline-flex flex-nowrap whitespace-nowrap"
                                )
                                .text(left_text)
                        )
                        .append(
                            $("<ul>")
                                .addClass("grid w-full gap-5 grid-cols-10")
                                .attr("id", `${input_name}_question_${index}`)
                                .append(
                                    createRadioButtons(
                                        input_name,
                                        element,
                                        index,
                                        tooltipData
                                    )
                                )
                        )
                        .append(
                            $("<p>")
                                .addClass(
                                    "pr-[77px] py-2 pl-3 text-neutral-800 text-sm font-medium inline-flex flex-nowrap whitespace-nowrap"
                                )
                                .text(right_text)
                        )
                );
            input_target.append($newElement);
        });
    }

    let sod_text = {
        saverity: "Severity (Dampak)",
        occurance: "Occurance (Kejadian)",
        detection: "Detection (Deteksi)",
    };

    let sod_input_text = {
        1: "Very   Low (VL) / Sangat Rendah",
        2: "Low (L) / Rendah",
        3: "Medium (M) / Sedang",
        4: "High (H) / Tinggi",
        5: "Very High (VH) / Sangat Tinggi",
    };

    function createlinguistic(input_name, input_target) {
        let target = $(input_target);
        target.empty();

        Object.keys(sod_text).forEach((key, index) => {
            let value = sod_text[key];

            let newElement = $("<div>")
                .addClass("flex flex-col mt-6 gap-5")
                .append(
                    $("<div>")
                        .addClass("flex flex-col gap-2")
                        .append(
                            $("<h5>")
                                .addClass(
                                    "text-base text-neutral-800 font-semibold"
                                )
                                .text(value)
                        )
                        .append(
                            $("<h5>")
                                .addClass(
                                    "text-base text-neutral-600 font-normal"
                                )
                                .text("Bobot faktor")
                        )
                )
                .append(
                    $("<div>")
                        .addClass("flex items-center justify-center gap-8")
                        .append(
                            $("<ul>")
                                .addClass("grid w-full gap-5 grid-cols-5")
                                .append(
                                    createRadioButtonsLinguistic(
                                        input_name,
                                        key,
                                        index
                                    )
                                )
                        )
                );

            input_target.append(newElement);
        });
    }

    function createRadioButtonsLinguistic(input_name, element, index) {
        var radioButtons = [];
        for (let i = 1; i <= 5; i++) {
            let radioId = `${input_name}_${element}_${i}`;
            let radioName = `${input_name}_${element}_${index + 1}`;
            let radioValue = `${input_name}_${element}_${i}`;

            let text_input = sod_input_text[i];

            let $li = $("<li>")
                .append(
                    $("<input>").attr({
                        type: "radio",
                        id: radioId,
                        name: radioName,
                        value: radioValue,
                        class: "hidden peer",
                        required: true,
                    })
                )
                .append(
                    $("<label>")
                        .attr({
                            for: radioId,
                            "data-tooltip-target": `tooltip-${radioId}`,
                            "data-tooltip-placement": "right",
                        })
                        .addClass(
                            "flex items-center justify-between w-full p-2 text-neutral-600 bg-neutral-50 border border-neutral-400 rounded-lg cursor-pointer peer-checked:bg-primary-800 peer-checked:text-neutral-50 text-xs font-semibold"
                        )
                        .append(
                            $("<div>")
                                .addClass("flex justify-center w-full")
                                .text(text_input)
                        )
                );

            radioButtons.push($li);
        }

        return radioButtons;
    }

    function createRadioButtons(input_name, element, index, tooltipData) {
        var radioButtons = [];
        for (let i = 1; i <= 10; i++) {
            let radioId = `${input_name}_code_E${element}_${i}`;
            let radioName = `${input_name}_question_${index + 1}`;
            let radioValue = `${input_name}_code_E${element}_${i}`;

            let tooltipText = tooltipData[i - 1];

            let $li = $("<li>")
                .append(
                    $("<input>").attr({
                        type: "radio",
                        id: radioId,
                        name: radioName,
                        value: radioValue,
                        class: "hidden peer",
                        required: true,
                    })
                )
                .append(
                    $("<label>")
                        .attr({
                            for: radioId,
                            "data-tooltip-target": `tooltip-${radioId}`,
                            "data-tooltip-placement": "top",
                        })
                        .addClass(
                            "flex items-center justify-between w-full p-2 text-neutral-600 bg-neutral-50 border border-neutral-400 rounded-lg cursor-pointer peer-checked:bg-primary-800 peer-checked:text-neutral-50 text-xs font-semibold"
                        )
                        .append(
                            $("<div>")
                                .addClass("flex justify-center w-full")
                                .text(i)
                        )
                );

            $("body").append(
                generateTooltipHTML(`tooltip-${radioId}`, tooltipText, i - 1)
            );

            radioButtons.push($li);
        }
        return radioButtons;
    }

    createInput(
        "s",
        $("#input_severity"),
        "Tidak ada dampak",
        "Dampak sangat berbahaya",
        tooltipSeverity
    );

    createInput(
        "o",
        $("#input_occurance"),
        "Tidak mungkin terjadi",
        "Sangat sering terjadi",
        tooltipOccurance
    );

    createInput(
        "d",
        $("#input_detection"),
        "Selalu terdeteksi",
        "Tidak dapat terdeteksi",
        tooltipDetection
    );

    createlinguistic("l", $("#input_linguistic"));

    $("#next-step-one").on("click", function () {
        currentStep++;
        showStep(currentStep);
    });

    $("#next-step-two").on("click", function () {
        currentStep++;
        showStep(currentStep);
    });

    $("#prev-step-two").on("click", function () {
        currentStep--;
        showStep(currentStep);
    });

    $("#next-step-three").on("click", function () {
        currentStep++;
        showStep(currentStep);
    });

    $("#prev-step-three").on("click", function () {
        currentStep--;
        showStep(currentStep);
    });

    $("#prev-step-four").on("click", function () {
        currentStep--;
        showStep(currentStep);
    });

    function showStep(step) {
        $(".step").removeClass("current-step");

        $("#step-" + step).addClass("current-step");

        $(".step").each(function (index, element) {
            if (index + 1 === step) {
                $(element).removeClass("hidden");
                $(element).addClass("block");
            } else {
                $(element).removeClass("block");
                $(element).addClass("hidden");
            }
        });
    }
});
