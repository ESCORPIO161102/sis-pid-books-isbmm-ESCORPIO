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
        let url = url_logic + "ventas/create.php";
        try {
            fetch(url, config).
                then(response => response.json()).
                then(data => {
                    if (data.status) {
                        alertas(data)
                    } else {
                        alertas(data)
                    }
                })
        } catch (error) {
            console.log(error)
        }
    })
}