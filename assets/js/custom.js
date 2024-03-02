    const imgs = document.getElementById("imgs");
    const imgs2 = document.getElementById("imgs2");
    const inputs = document.querySelector("input");

        inputs.addEventListener("change", () => {
            imgs.src = URL.createObjectURL(inputs.files[0]);
            imgs2.src = URL.createObjectURL(inputs.files[0]);
    });