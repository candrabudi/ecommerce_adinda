document.addEventListener("DOMContentLoaded",function(e){var t=document.getElementById("createApp");let r=document.querySelector(".app-credit-card-mask"),a=document.querySelector(".app-expiry-date-mask"),n=document.querySelector(".app-cvv-code-mask");setTimeout(()=>{r&&(r.addEventListener("input",e=>{var e=e.target.value.replace(/\D/g,""),t=getCreditCardType(e);r.value=formatCreditCard(e),document.querySelector(".app-card-type").innerHTML=t&&"unknown"!==t&&"general"!==t?`<img src="${assetsPath}img/icons/payments/${t}-cc.png" height="26"/>`:""}),registerCursorTracker({input:r,delimiter:" "}))},200),a&&(a.addEventListener("input",e=>{a.value=formatDate(e.target.value,{delimiter:"/",datePattern:["m","y"]})}),registerCursorTracker({input:a,delimiter:"/"})),n&&n.addEventListener("input",e=>{e=e.target.value.replace(/\D/g,"");n.value=formatNumeral(e,{numeral:!0,numeralPositiveOnly:!0})}),t.addEventListener("show.bs.modal",function(e){var r=document.querySelector("#wizard-create-app");if(null!==r){var a=[].slice.call(r.querySelectorAll(".btn-next")),n=[].slice.call(r.querySelectorAll(".btn-prev")),i=r.querySelector(".btn-submit");let t=new Stepper(r,{linear:!1});a&&a.forEach(e=>{e.addEventListener("click",e=>{t.next()})}),n&&n.forEach(e=>{e.addEventListener("click",e=>{t.previous()})}),i&&i.addEventListener("click",e=>{alert("Submitted..!!")})}})});