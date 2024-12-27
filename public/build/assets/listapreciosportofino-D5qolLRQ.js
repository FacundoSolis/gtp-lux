document.addEventListener("DOMContentLoaded",function(){const t=document.getElementById("price-list-button"),n=document.querySelector(".modal-price-list-container"),e=document.getElementById("priceListModal"),i=`
        <h4>Lista de Precios</h4>
        <ul>
            <li>01 enero - 31 mayo: <strong>2.200 € / día</strong></li>
            <li>01 junio - 30 junio: <strong>2.500 € / día</strong></li>
            <li>01 julio - 31 agosto: <strong>3.150 € / día</strong></li>
            <li>01 septiembre - 30 septiembre: <strong>2.500 € / día</strong></li>
            <li>01 octubre - 31 diciembre: <strong>2.200 € / día</strong></li>
        </ul>
    `,d=()=>{n.innerHTML=i,new bootstrap.Modal(e).show()};t.addEventListener("click",d),e.addEventListener("hidden.bs.modal",()=>{const o=document.querySelector(".modal-backdrop");o&&o.remove(),document.body.style.overflow="",document.body.classList.remove("modal-open")})});
