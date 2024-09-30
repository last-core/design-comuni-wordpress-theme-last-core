function borderCardRadio(){var t=document.querySelectorAll(".radio-card");document.querySelectorAll(".radio-input").forEach(function(e,n){e.addEventListener("change",function(){t.forEach(function(e,t){n==t?e.classList.add("has-border-green"):e.classList.remove("has-border-green")})})})}const serviceChange=()=>{var e=serviceSelect?.value,t=serviceSelect?.querySelector(`[value="${e}"]`)?.innerText;saveAnswerByValue("service",encodeObject({id:e,name:t}),!0)};var servizio=new Proxy(new URLSearchParams(window.location.search),{get:(e,t)=>e.get(t)})?.servizio,content=document.querySelector(".section-wrapper"),currentStep=1,navscroll=document.querySelector('[data-index="'.concat(currentStep,'"]')),progressBar=document.querySelector('[data-progress="'.concat(currentStep,'"]')),btnNext=content.querySelector(".btn-next-step"),btnBack=content.querySelector(".btn-back-step");function pageSteps(){var e;content&&(e=content.querySelectorAll(".saveBtn"),navscroll.classList.add("d-lg-block"),progressBar.classList.remove("d-none"),e.forEach(function(e){e.classList.add("invisible")}),btnNext&&btnNext.addEventListener("click",function(){openNext()}),btnBack)&&btnBack.addEventListener("click",function(){backPrevious()})}function openNext(){btnBack.disabled=!1;content.querySelectorAll(".saveBtn");var e=content.querySelectorAll("[data-steps]"),t=content.querySelector('[data-steps="'.concat(currentStep+1,'"]')),n=content.querySelector("[data-steps].active");navscroll.classList.remove("d-lg-block"),progressBar.classList.remove("d-block"),progressBar.classList.add("d-none"),currentStep==e.length?confirmAppointment():(n.classList.add("d-none"),n.classList.remove("active"),t.classList.add("active"),t.classList.remove("d-none"),currentStep+=1,checkMandatoryFields(),(progressBar=document.querySelector('[data-progress="'.concat(currentStep,'"]'))).classList.add("d-block"),progressBar.classList.remove("d-none"),currentStep<e.length&&(navscroll=document.querySelector('[data-index="'.concat(currentStep,'"]'))).classList.add("d-lg-block"),currentStep==e.length&&content.classList.remove("offset-lg-1"),currentStep==e.length&&(btnNext.disabled=!1,content.querySelector(".steppers-btn-confirm span").innerHTML="Invia",setReviews()))}function backPrevious(){btnNext.disabled=!1;var e=content.querySelectorAll(".saveBtn"),t=content.querySelectorAll("[data-steps]"),n=content.querySelector("[data-steps].active"),a=content.querySelector('[data-steps="'.concat(currentStep-1,'"]'));1!=currentStep&&(a.classList.remove("d-none"),a.classList.add("active"),n.classList.add("d-none"),n.classList.remove("active"),navscroll.classList.remove("d-lg-block"),progressBar.classList.add("d-none"),currentStep-=1,(progressBar=document.querySelector('[data-progress="'.concat(currentStep,'"]'))).classList.toggle("d-none"),content.querySelector(".steppers-btn-confirm span").innerHTML="Avanti",currentStep<t.length&&((navscroll=document.querySelector('[data-index="'.concat(currentStep,'"]'))).classList.add("d-lg-block"),content.classList.add("offset-lg-1")),currentStep<t.length&&e.forEach(function(e){e.classList.remove("visible"),e.classList.add("invisible")}),1==currentStep)&&(btnBack.disabled=!0)}pageSteps();const answers={},encodeObject=e=>encodeURIComponent(JSON.stringify(e)),decodeObj=e=>JSON.parse(decodeURIComponent(e)),saveAnswerByValue=(e,t,n=!1)=>{n?(n=decodeObj(t),answers[e]=n):answers[e]=t,checkMandatoryFields()},saveAnswerById=(e,t,n)=>{t=document.getElementById(t)?.value;answers[e]=JSON.parse(t),"function"==typeof n&&n(),checkMandatoryFields()},privacy=document.getElementById("privacy"),officeSelect=(privacy.addEventListener("change",()=>{checkMandatoryFields(),saveAnswerByValue("privacy",privacy.checked,!0)}),document.getElementById("office-choice")),appointment=(officeSelect.addEventListener("change",()=>{var e=officeSelect?.value,t=officeSelect?.querySelector(`[value="${e}"]`)?.innerText;saveAnswerByValue("office",encodeObject({id:e,name:t}),!0),officeSelect?.value?(e=new URLSearchParams({id:officeSelect.value}),fetch(window.wpRestApi+"wp/v2/sedi/ufficio/?"+e).then(e=>e.json()).then(e=>{document.querySelector("#place-cards-wrapper").innerHTML='<legend class="visually-hidden">Seleziona un ufficio</legend>';for(const n of e){var t={nome:n.post_title,indirizzo:n.indirizzo,apertura:n.apertura,id:n.identificativo};document.querySelector("#place-cards-wrapper").innerHTML+=`
          <div class="cmp-info-radio radio-card">
            <div class="card p-3 p-lg-4">
              <div class="card-header mb-0 p-0">
                <div class="form-check m-0">
                    <input
                    class="radio-input"
                    name="beneficiaries"
                    type="radio"
                    id=${n?.ID}
                    value='${JSON.stringify(t)}'
                    onclick="saveAnswerById('place', ${n?.ID}, ${()=>setSelectedPlace()})"
                    />
                    <label for=${n?.ID}>
                    <h3 class="big-title mb-0 pb-0">
                        ${n?.post_title}
                    </h3></label
                    >
                </div>
              </div>
              <div class="card-body p-0">
                <div class="info-wrapper">
                  <span class="info-wrapper__label">Indirizzo</span>
                  <p class="info-wrapper__value">
                  ${n?.indirizzo}
                  </p>
                </div>
                <div class="info-wrapper">
                    <span class="info-wrapper__label">Apertura</span>
                    <p class="info-wrapper__value">
                    ${n?.apertura}
                    </p>
                </div>
              </div>
            </div>
          </div>
          `}borderCardRadio()}).catch(e=>{console.log("err",e)}),fetch(window.wpRestApi+"wp/v2/servizi/ufficio?"+e).then(e=>e.json()).then(e=>{if(servizio){var t=e.find(e=>e.post_name===servizio);document.querySelector("#motivo-appuntamento").innerHTML+=`
          <option value="${t?.ID}">${t?.post_title}</option>
          `,serviceChange()}else{document.querySelector("#motivo-appuntamento").innerHTML='<option selected="selected" value="">Seleziona opzione</option>';for(const n of e)document.querySelector("#motivo-appuntamento").innerHTML+=`
            <option value="${n?.ID}">${n?.post_title}</option>
            `}}).catch(e=>{console.log("err",e)})):document.querySelector("#place-cards-wrapper").innerHTML=""}),document.getElementById("appointment")),onDateChange=(appointment.addEventListener("change",()=>{answers.appointment=null,checkMandatoryFields(),fetch(window.wpRestApi+"wp/v2/prenotazioni/date"+`?month=${appointment?.value}&office=`+answers?.office?.id).then(e=>{if(e.ok)return e.json();throw new Error("HTTP error "+e.status)}).then(e=>{if(!e.error){document.querySelector("#date-appointment-div").innerHTML=`<div class="select-wrapper p-0 mt-1 select-partials">
                        <label for="appointment-date" class="visually-hidden">
                            Seleziona un giorno
                        </label>
                        <select id="appointment-date" class="">
                            <option selected="selected" value="">
                                Seleziona un giorno
                            </option>
                        </select></div>`;for(const n of e){var t=new Date(n).toLocaleString([],{weekday:"long",day:"numeric",month:"long",year:"numeric"});document.querySelector("#appointment-date").innerHTML+=`
        <option value="${n}">
        ${t}
        </option>
        `}e=document.getElementById("appointment-date");e&&e.addEventListener("change",onDateChange)}}).catch(e=>{console.log("err",e)})}),e=>{e=e.target.value;fetch("/wp-json/wp/v2/prenotazioni/orari"+`?date=${e}&office=`+answers?.office?.id).then(e=>{if(e.ok)return e.json();throw new Error("HTTP error "+e.status)}).then(e=>{if("object"==typeof e&&0!==e.length&&!e.error){document.querySelector("#hour-appointment-div").innerHTML=`<div class="select-wrapper p-0 mt-1 select-partials">
                        <label for="appointment-time" class="visually-hidden">
                            Seleziona un orario
                        </label>
                        <select id="appointment-time" class="" onchange="saveAnswerByValue('appointment', this.value, true)">
                            <option selected="selected" value="">
                                Seleziona un orario
                            </option>
                            </select></div>`;for(const o of e){var{start_time:t,end_time:n}=o,a=new Date(t).toLocaleString([],{hour:"numeric",minute:"numeric"}),r=new Date(n).toLocaleString([],{hour:"numeric",minute:"numeric"}),t=encodeObject({startDate:""+t,endDate:""+n});document.querySelector("#appointment-time").innerHTML+=`
        <option value="${t}">
        ${a} - ${r}
        </option>
        `}}}).catch(e=>{console.log("err",e)})}),setSelectedPlace=()=>{var e=answers?.place;document.querySelector("#selected-place-card").innerHTML=`  
  <div class="cmp-info-summary bg-white mb-4 mb-lg-30 p-4">
  <div class="card">
      <div
      class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end"
      >
      <h3 class="title-large-semi-bold mb-3">
        ${e?.nome}
      </h3>
      </div>

      <div class="card-body p-0">
      <div class="single-line-info border-light">
          <div class="text-paragraph-small">Indirizzo</div>
          <div class="border-light">
          <p class="data-text">
            ${e?.indirizzo}
          </p>
          </div>
      </div>
      <div class="single-line-info border-light">
          <div class="text-paragraph-small">Apertura</div>
          <div class="border-light">
          <p class="data-text">
            ${e?.apertura}
          </p>
          </div>
      </div>
      </div>
      <div class="card-footer p-0"></div>
  </div>
  </div>
</div>
  `},validate=new bootstrap.FormValidate("#form-steps",{errorFieldCssClass:"is-invalid",errorLabelCssClass:"form-feedback",errorLabelStyle:"",focusInvalidField:!1}),serviceSelect=(validate.addField("#email",[{rule:"required",errorMessage:"Questo campo è richiesto"},{rule:"email",errorMessage:"Email non valida"}]),document.getElementById("motivo-appuntamento")),moreDetailsText=(serviceSelect.addEventListener("change",serviceChange),document.getElementById("form-details")),nameInput=(moreDetailsText.addEventListener("input",()=>{saveAnswerByValue("moreDetails",moreDetailsText?.value)}),document.getElementById("name")),surnameInput=(nameInput.addEventListener("input",()=>{saveAnswerByValue("name",nameInput?.value)}),document.getElementById("surname")),emailInput=(surnameInput.addEventListener("input",()=>{saveAnswerByValue("surname",surnameInput?.value)}),document.getElementById("email")),getDay=(emailInput.addEventListener("input",()=>{validate.revalidateField("#email"),validate.fields["#email"].isValid?saveAnswerByValue("email",emailInput?.value):checkMandatoryFields()}),()=>{var e=answers?.appointment?.startDate?.split("T")[0];return new Date(e).toLocaleString([],{weekday:"long",day:"2-digit",month:"long",year:"numeric"})}),getHour=()=>{var e=answers?.appointment;return[e?.startDate?.split("T")[1],e?.endDate?.split("T")[1]]},setReviews=()=>{document.getElementById("review-office").innerHTML=answers?.office?.name,document.getElementById("review-place").innerHTML=answers?.place?.nome,document.getElementById("review-date").innerHTML=getDay(),document.getElementById("review-hour").innerHTML=getHour()[0]+" - "+getHour()[1],document.getElementById("review-service").innerHTML=answers?.service?.name,document.getElementById("review-details").innerHTML=answers?.moreDetails,document.getElementById("review-name").innerHTML=answers?.name,document.getElementById("review-surname").innerHTML=answers?.surname,document.getElementById("review-email").innerHTML=answers?.email},checkMandatoryFields=()=>{switch(currentStep){case 1:privacy.checked?btnNext.disabled=!1:btnNext.disabled=!0;break;case 2:answers?.office&&answers?.place?btnNext.disabled=!1:btnNext.disabled=!0;break;case 3:answers?.appointment?btnNext.disabled=!1:btnNext.disabled=!0;break;case 4:answers?.service&&answers?.moreDetails?btnNext.disabled=!1:btnNext.disabled=!0;break;case 5:answers?.name&&answers?.surname&&answers?.email&&validate.fields["#email"].isValid?btnNext.disabled=!1:btnNext.disabled=!0}};async function successFeedback(){document.getElementById("email-recap").innerText=answers?.email,document.getElementById("date-recap").innerText=` ${getDay()} dalle ore ${getHour()[0]} alle ore `+getHour()[1];var e=await getServiceDetail(answers?.service?.id);if(0<e?._dci_servizio_cosa_serve_list?.length||e?._dci_servizio_cosa_serve_introduzione){const t=document.getElementById("needed-recap");t.innerHTML=`
      <p class="font-serif">${e?._dci_servizio_cosa_serve_introduzione}</p>
    `,0<e?._dci_servizio_cosa_serve_list?.length&&(t.innerHTML+="<ul>",e._dci_servizio_cosa_serve_list.forEach(e=>{t.innerHTML+=`<li>${e}</li>`}),t.innerHTML+="</ul>")}document.getElementById("office-recap").innerHTML=`
    <a
      href="#"
      class="text-decoration-none"
      >${answers?.office?.name}</a
    >  
  `,document.getElementById("address-recap").innerHTML=answers?.place?.nome,document.getElementById("form-steps").classList.add("d-none"),document.getElementById("final-step").classList.remove("d-none")}const confirmAppointment=()=>{var e,t=new URLSearchParams;for(e in answers)"object"==typeof answers[e]?t.append(e,JSON.stringify(answers[e])):t.append(e,answers[e]);t.append("action","save_appuntamento"),fetch(urlConfirm,{method:"POST",credentials:"same-origin",headers:{"Content-Type":"application/x-www-form-urlencoded","Cache-Control":"no-cache"},body:t}).then(async e=>{if(e.ok)return e.json();throw{...await e.json()}}).then(e=>{successFeedback();var t=document.querySelector("#main-container");t&&t.scrollIntoView({behavior:"smooth"})}).catch(e=>{var t;1===e?.data?.code?(t=document.getElementById("error-alert"))&&(t.classList.remove("d-none"),t.textContent=e?.data?.message,t=document.querySelector("#appointment-time")?.selectedIndex,document.querySelectorAll("#appointment-time option")?.[t].remove(),delete answers.appointment,checkMandatoryFields(),document.getElementById("error-alert")?.scrollIntoView({behavior:"smooth"}),document.querySelector("#appointment-time")?.addEventListener("change",e=>{e?.target?.value&&!document.getElementById("error-alert")?.classList.contains("d-none")&&document.getElementById("error-alert")?.classList.add("d-none")}),goBackTo(3)):console.log("err",e)})};async function getServiceDetail(e){try{return await fetch(window.wpRestApi+"wp/v2/servizi/"+e).then(e=>{if(e.ok)return e.json();throw new Error("HTTP error "+e.status)}).then(e=>e?.cmb2?._dci_servizio_box_cosa_serve).catch(e=>{console.log("err",e)})}catch(e){console.error(e)}}function goBackTo(e){if(!isNaN(e))for(;0<e;)backPrevious(),e--}