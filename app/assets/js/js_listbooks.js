document.addEventListener("DOMContentLoaded", () => {
    loadTable();
    setTimeout(() => {
        deleteLibro();
        updateLibro();
        formUpdate();
    }, 1000);
})
document.addEventListener("click", () => {
    deleteLibro();
        updateLibro();
})

function loadTable() {
    let url = url_logic + "libros/read.php";
    try {
        alertas({
            status: true,
            title: "Cargando",
            text: "La informacion de la tabla esta cargando",
            date: "",
            type: "info",
        })
        fetch(url)
            .then(response => response.json())
            .then(result => {
                if (result.status) {
                    data = result.data;
                    const tablebody = document.querySelector("#table tbody");
                    tablebody.innerHTML = "";
                    data.forEach(element => {
                        const row = document.createElement('tr');
                        row.innerHTML = `<td>${element.bookId}</td>
                                        <td>${element.b_title}</td>
                                        <td>${element.b_gender}</td> 
                                        <td>${element.b_price}</td>  
                                        <td>${element.autorId}</td>                                     
                                        <td>
                                            <button data-id="${element.bookId}" data-titulo="${element.b_title}" data-gender="${element.b_gender}" data-price="${element.b_price}" data-autorId="${element.autorId}" class="btn-update">Actualizar</button>
                                            <button data-id="${element.bookId}" data-titulo="${element.b_title}" class="btn-delete">Eliminar</button>
                                        </td>`
                        tablebody.appendChild(row);
                    });
                } else {
                    alertas(result, 3);
                }

            })
    } catch (error) {
        console.log(error);
    }
}

function deleteLibro() {
    let btnDelete = document.querySelectorAll(".btn-delete");
    btnDelete.forEach(element => {
        element.addEventListener("click", () => {
            let id = element.getAttribute("data-id");
            let name = element.getAttribute("data-title")
            let data = new FormData();
            data.append("bookid", id);
            let encabezados = new Headers();
            let config = {
                method: "POST",
                headers: encabezados,
                node: "cors",
                cache: "no-cache",
                body: data,
            }
            let url = url_logic + "libros/delete.php";
            Swal.fire({
                title: "¿Estas seguro?",
                text: "Estas seguro de eliminar el registro " + name,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si"
            }).then((result) => {
                if (result.isConfirmed) {
                    try {
                        fetch(url, config)
                            .then(response => response.json())
                            .then(result => {
                                if (result.status) {
                                    Swal.fire({
                                        title: "Eliminado",
                                        text: "Se elimino  el registro",
                                        icon: "success"
                                    });
                                    loadTable();
                                } else {
                                    alertas(result, 3);
                                }
                            })
                    } catch (error) {
                        console.log(error)
                    }
                }
            });

        })
    })
}

function updateLibro(){
    let btnUpdate = document.querySelectorAll(".btn-update");
    btnUpdate.forEach(element => {
        element.addEventListener("click", () => {
            let formUpdate = document.querySelector(".form-update");
            formUpdate.classList.toggle("hidden");
            document.querySelector("#bookid").value=element.getAttribute("data-id");
            document.querySelector("#txtTitle").value=element.getAttribute("data-titulo");
            let txtGender= document.querySelector("#txtGender");
            txtGender[0].value = element.getAttribute("data-gender")
            txtGender[0].selected = true
            txtGender[0].disable = false
            txtGender[0].innerHTML = element.getAttribute("data-gender")
        })
    });
    

}
function formUpdate() {
    let formUpdate = document.querySelector("#formUpdate");
    formUpdate.addEventListener("submit", (e) => {
        e.preventDefault();
        let data = new FormData(formUpdate);
        let encabezados = new Headers();
        let config = {
            method: "POST",
            headers: encabezados,
            node: "cors",
            cache: "no-cache",
            body: data
        };
        let url = url_logic + "libros/update.php";
        try {
            fetch(url, config).
                then(response => response.json()).
                then(data => {
                    if (data.status) {
                        alertas(data)
                        loadTable()
                    } else {
                        alertas(data)
                    }
                })
        } catch (error) {
            console.log(error)
        }
    })
}