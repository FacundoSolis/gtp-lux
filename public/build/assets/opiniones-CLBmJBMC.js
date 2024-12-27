document.addEventListener("DOMContentLoaded",function(){const d=document.getElementById("review-form"),a=document.getElementById("review-text"),o=document.getElementsByName("rating"),i=document.getElementById("reviews-list"),l=document.getElementById("review-count");let n=[];d.addEventListener("submit",function(e){var c;e.preventDefault();const t=a.value.trim(),s=(c=Array.from(o).find(r=>r.checked))==null?void 0:c.value;if(!t||!s){alert("Por favor, completa todos los campos.");return}const u={text:t,rating:parseInt(s),date:new Date().toISOString()};n.push(u),a.value="",Array.from(o).forEach(r=>r.checked=!1),m()});function m(){i.innerHTML="",n.sort((e,t)=>new Date(t.date)-new Date(e.date)),n.forEach(e=>{const t=document.createElement("li");t.innerHTML=`
          <p>${e.text}</p>
          <div class="review-stars-display">
            ${"★".repeat(e.rating)}${"☆".repeat(5-e.rating)}
          </div>
          <small>${new Date(e.date).toLocaleDateString()}</small>
        `,i.appendChild(t)}),l.textContent=n.length}});
