modalReset = document.getElementById("modalReset");

modalReset.addEventListener("click", (e) => {
    console.log(e.srcElement.attributes[2]);
});