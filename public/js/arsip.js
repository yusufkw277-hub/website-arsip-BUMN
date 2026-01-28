document.addEventListener("DOMContentLoaded", function () {
    const informasi = document.getElementById("informasi_berkas");
    const uraian = document.getElementById("uraian_informasi");
    const btn = document.getElementById("btnSearch");

    function checkRequired() {
        if (informasi.value.trim() !== "" && uraian.value.trim() !== "") {
            btn.disabled = false;
            btn.classList.add("active");
        } else {
            btn.disabled = true;
            btn.classList.remove("active");
        }
    }

    informasi.addEventListener("input", checkRequired);
    uraian.addEventListener("input", checkRequired);
});
