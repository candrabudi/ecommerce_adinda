document.addEventListener("DOMContentLoaded",function(e){let n=document.querySelector(".price-duration-toggler"),c=[].slice.call(document.querySelectorAll(".price-monthly")),o=[].slice.call(document.querySelectorAll(".price-yearly"));function t(){n.checked?(o.map(function(e){e.classList.remove("d-none")}),c.map(function(e){e.classList.add("d-none")})):(o.map(function(e){e.classList.add("d-none")}),c.map(function(e){e.classList.remove("d-none")}))}t(),n.onchange=function(){t()}});