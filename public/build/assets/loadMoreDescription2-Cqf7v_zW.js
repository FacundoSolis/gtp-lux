document.addEventListener("DOMContentLoaded",function(){const e=document.getElementById("loadMoreDescription2Button"),a=document.querySelector(".modal-description-container"),o=`
    <h4>Descripción</h4>
    <p>Alquiler de Yates en Denia</p>
    <p>Navegue en el exclusivo Princess V65, un lujoso barco abierto de día diseñado para el confort y la relajación. 
    Con capacidad para 10 invitados, este yate ofrece 3 baños completos y camarotes. 
    Un salón de planta abierta y una cocina completa, perfecta para una experiencia inolvidable.
    El patrón es obligatorio, lo que garantiza un día seguro en el mar.</p>

    <h4>Rutas y horarios</h4>
    <p>El NARTIC sale de Denia Marina y permite explorar las calas de Javea o navegar hacia Moraira. El day charter tiene una duración de 8 horas, con dos horarios disponibles:</p>
    <ul>
        <li>De 10:00 a 18:00</li>
        <li>De 11:00 a 19:00</li>
    </ul>
    <p>Si desea almorzar en tierra, sólo podrá hacerlo en Moraira, donde podrá disfrutar del Club Náutico (amarre no incluido).</p>

    <h4>Comida y bebida a bordo</h4>
    <p>Puede traer su propia comida y bebida o solicitar un servicio de catering. El barco dispone de un iglú para mantener sus bebidas frías, y puede pedir hielo a la llegada.</p>

    <h4>Servicios del yate</h4>
    <ul>
        <li>Abierto: fácil acceso alrededor del yate.</li>
        <li>Una mesa y sofás en cubierta y abajo: un espacio cómodo para comer y relajarse.</li>
        <li>Tumbona delantera: ideal para tomar el sol.</li>
        <li>Hard Top: proporciona sombra en la parte trasera.</li>
        <li>Escalera de baño y ducha: para mayor comodidad después de nadar.</li>
    </ul>

    <h4>Restricciones y condiciones</h4>
    <ul>
        <li>No se admiten animales a bordo.</li>
        <li>No es posible navegar a las islas en un día.</li>
    </ul>

    <p>Experimente el lujo y el confort del Princess V65. Reserve ahora y disfrute de una experiencia de navegación inolvidable.</p>
  `,i=()=>{a.innerHTML=o,new bootstrap.Modal(document.getElementById("descriptionModal2")).show(),e.style.display="none"};e.addEventListener("click",i),document.getElementById("descriptionModal2").addEventListener("hidden.bs.modal",function(){e.style.display="block"})});
