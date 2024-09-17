document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        formInsert();
    }, 1000);
})

/*
funcion para registrar en el servidor php
 */
function formInsert() {
    let formSave = document.querySelector("#formSave");
    formSave.addEventListener("submit", (e) => {
        e.preventDefault();
        let data = new FormData(formSave);
        let encabezados = new Headers();
        let config = {
            method: "POST",
            headers: encabezados,
            node: "cors",
            cache: "no-cache",
            body: data
        };
        let url = url_logic + "autors/create.php";
        try {
            fetch(url, config).
                then(response => response.json()).
                then(data => {
                    if (data.status) {
                        let alertMsj = document.querySelector(".alert");
                        alertMsj.classList.toggle("hidden");
                        alertMsj.classList.toggle(data.type)
                        document.querySelector(".alert-title").innerHTML = data.title
                        document.querySelector(".alert-text").innerHTML = data.text
                        console.log(data);
                    } else {
                        let alertMsj = document.querySelector(".alert");
                        alertMsj.classList.toggle("hidden");
                        alertMsj.classList.toggle(data.type)
                        document.querySelector(".alert-title").innerHTML = data.title
                        document.querySelector(".alert-text").innerHTML = data.text
                    }

                })
        } catch (error) {
            console.log(error)
        }
    })
}