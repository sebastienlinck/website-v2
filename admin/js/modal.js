let svgModal = document.querySelector(".modalSvg");
let svgEditModal = document.querySelector(".modalEditSvg");

let overlay = document.querySelector(".overlay");
let overlayEdit = document.querySelector(".overlayEdit");

let btnAddModal = document.querySelector("#addBtn");

btnAddModal.addEventListener("click", () => {
    svgModal.classList.toggle("active");
    overlay.classList.toggle("active");
});

overlay.addEventListener("click", () => {
    svgModal.classList.remove("active");
    overlay.classList.remove("active");
});

document.querySelectorAll(".edit-svg-icon").forEach(btn => {
    btn.addEventListener("click", () => {
        const filename = btn.getAttribute("data-filename");
        document.getElementById("oldFilename").value = filename;
        svgEditModal.classList.toggle("active");
        overlayEdit.classList.toggle("active");
    });
});

overlayEdit.addEventListener("click", () => {
    svgEditModal.classList.remove("active");
    overlayEdit.classList.remove("active");
});
