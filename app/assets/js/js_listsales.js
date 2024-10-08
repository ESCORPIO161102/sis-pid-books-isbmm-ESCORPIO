document.addEventListener("DOMContentLoaded", () => {
    loadTable();
    setTimeout(() => {
        deleteVenta();
        updateVenta();
        formUpdate();
    }, 1000);
})
document.addEventListener("click", () => {
    deleteVenta();
        updateVenta();
})

function loadTable() {
    let url = url_logic + "ventas/read.php";
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
                        row.innerHTML = `<td>${element.saleId}</td>
                                        <td>${element.bookId}</td> 
                                        <td>${element.dateSale}</td>
                                        <td>${element.amount}</td>                                   
                                        <td>
                                            <button data-id="${element.saleId}" data-bookid="${element.bookId}" data-fecha="${element.dateSale}" data-monto="${element.amount}" class="btn-update">Actualizar</button>
                                            <button data-id="${element.saleId}" data-fecha="${element.dateSale}" class="btn-delete">Eliminar</button>
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

function deleteVenta() {
    let btnDelete = document.querySelectorAll(".btn-delete");
    btnDelete.forEach(element => {
        element.addEventListener("click", () => {
            let id = element.getAttribute("data-id");
            let name = element.getAttribute("data-fecha")
            let data = new FormData();
            data.append("idVenta", id);
            let encabezados = new Headers();
            let config = {
                method: "POST",
                headers: encabezados,
                node: "cors",
                cache: "no-cache",
                body: data,
            }
            let url = url_logic + "ventas/delete.php";
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
                                        text: "Se elimino correctamente el registro",
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

function updateVenta(){
    let btnUpdate = document.querySelectorAll(".btn-update");
    btnUpdate.forEach(element => {
        element.addEventListener("click", () => {
            let formUpdate = document.querySelector(".form-update");
            formUpdate.classList.toggle("hidden");
            document.querySelector("#txtVenta").value=element.getAttribute("data-id");
            document.querySelector("#txtFecha").value=element.getAttribute("data-fecha");
            let txtMonto= document.querySelector("#txtMonto");
            txtMonto = element.getAttribute("data-monto")
            txtMonto[0].selected = true
            txtMonto[0].disable = false
            txtMonto[0].innerHTML = element.getAttribute("data-monto")
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
        let url = url_logic + "ventas/update.php";
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