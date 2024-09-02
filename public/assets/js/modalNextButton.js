$(document).ready(function () {
    let currentStep = 1;
    let riskData = {};

    const showStep = (step) => {
        $("#input_risk_first").addClass("hidden");
        $("#input_risk_second").addClass("hidden");

        if (step === 1) {
            $("#input_risk_first").removeClass("hidden");
        } else if (step === 2) {
            $("#input_risk_second").removeClass("hidden");
            $("#input_risk_second").addClass("grid");
        }

        if (step === 1) {
            $("#schema_next_button_modal").removeClass("hidden");

            $("#schema_prev_button_modal").addClass("hidden");
            $("#schema_button_submit").addClass("hidden");
        } else {
            $("#schema_next_button_modal").addClass("hidden");

            $("#schema_prev_button_modal").removeClass("hidden");
            $("#schema_button_submit").removeClass("hidden");
        }
    };

    const generateInputs = (count) => {
        $("#loading_indicator").removeClass("hidden");
        $("#loading_indicator").addClass("flex");

        setTimeout(() => {
            $("#input_risk_second").empty();

            for (let i = 1; i <= count; i++) {
                $("#input_risk_second").append(`
                    <div>
                        <label for="risk_${i}" class="block mb-3 text-lg-body-medium text-neutral-800">Resiko ${i} <span class="text-primary-700">*</span></label>
                        <input
                            type="text"
                            id="risk_${i}"
                            name="risk_${i}"
                            class="bg-white border border-neutral-400 text-neutral-800 text-lg-body-medium placeholder:text-neutral-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-3 px-4"
                            placeholder="Masukkan detail resiko ${i}"
                            value="${riskData[`risk_${i}`] || ""}"
                        >
                    </div>
                `);
            }

            $("#loading_indicator").addClass("hidden");
        }, 1000);
    };

    const handleNext = () => {
        if (currentStep === 1) {
            const riskCount = parseInt($("#amount_of_risk").val(), 10);
            const expertOne = $("#expert_one").val();
            const expertTwo = $("#expert_two").val();
            const expertThree = $("#expert_three").val();
            const endDate = $("#end_date").val();

            if (isNaN(riskCount) || riskCount <= 0) {
                Swal.fire({
                    icon: "error",
                    title: "Terjadi Kesalahan",
                    text: "Masukkan jumlah risiko yang valid.",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#039855",
                });
                return;
            }

            if (
                expertOne === "" ||
                expertTwo === "" ||
                expertThree === "" ||
                endDate === ""
            ) {
                Swal.fire({
                    icon: "error",
                    title: "Terjadi Kesalahan",
                    text: "Semua data harus terisi sebelum melanjutkan.",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#039855",
                });
                return;
            }

            if (
                expertOne === expertTwo ||
                expertTwo === expertThree ||
                expertOne === expertThree
            ) {
                Swal.fire({
                    icon: "error",
                    title: "Email",
                    text: "Email tidak boleh sama",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#039855",
                });
                return;
            }

            $("#input_risk_first .input-field").each(function () {
                riskData[this.id] = $(this).val();
            });

            generateInputs(riskCount);
        }
        currentStep++;
        showStep(currentStep);
    };

    const handlePrev = () => {
        // Save current risk data
        $("#input_risk_second .input-field").each(function () {
            riskData[this.id] = $(this).val();
        });

        currentStep--;
        showStep(currentStep);
    };

    showStep(currentStep);

    $("#schema_next_button_modal").on("click", handleNext);
    $("#schema_prev_button_modal").on("click", handlePrev);
});
