let btnFrontend = document.querySelector('.btnFrontend')
let btnBackend = document.querySelector('.btnBackend')

let divFrontend = document.querySelector('.divFrontend')
let divBackend = document.querySelector('.divBackend')

btnFrontend.addEventListener('click', ()=>{
    divBackend.style.display = "none"
    divFrontend.style.display = "inherit"
})

btnBackend.addEventListener('click', ()=>{
    divFrontend.style.display = "none"
    divBackend.style.display = "inherit"
})
