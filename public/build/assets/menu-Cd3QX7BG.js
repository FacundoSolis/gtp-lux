document.addEventListener("DOMContentLoaded",function(){const e=document.querySelector(".hamburger-menu"),t=document.querySelector(".mobile-menu"),o=document.querySelector(".close-menu"),c=document.body;e&&e.addEventListener("click",function(){t.classList.toggle("active"),e.classList.toggle("active"),c.classList.toggle("no-scroll")}),o&&o.addEventListener("click",function(){t.classList.remove("active"),e.classList.remove("active"),c.classList.remove("no-scroll")});const s=document.querySelectorAll(".mobile-menu ul li a");s&&s.forEach(n=>{n.addEventListener("click",function(){t.classList.remove("active"),e.classList.remove("active"),c.classList.remove("no-scroll")})})});