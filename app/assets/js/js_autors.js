document.addEventListener("DOMContentLoaded",()=>{
    setTimeout(()=>{
       formInsert();
    }),1000;
})
/* 
funcion para registrar en el servidor php
*/

function formInsert(){
    let formSave = document.querySelector("#formSave");
    formSave.addEventListener("submit",(e)=>{
        e.preventDefault();
        let data=new FormData(formSave);
        let encabezado=new Headers();
        let config={
            method:"POST",
            Headers: encabezado,
            node: "cors",
            cache: "no-cache",
            body: data
        }
        let url = "../logic/autors.php";
        try{
            fetch(url, config).
            then(response => response.json()).
            then(data => {
                 console.log(data)
         })
        }catch (error) {
            console.log(error);
        }
    })
}