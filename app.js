data = {};
function True(value, question) {
  data[question] = 1
  transition(value)
};
function False(value, question) {
  data[question] = 0
  transition(value);
};
function transition(value) {
  if (value < 7) {
    document.getElementById("form-container" + "#" + value).classList.remove("fadeIn");
    document.getElementById("form-container" + "#" + value).classList.remove("delay-200");
    document.getElementById("form-container" + "#" + value).style.cursor = "default";
    document.getElementById("form-container" + "#" + (parseInt(value) + 1).toString()).classList.add("delay-200");
    document.getElementById("form-container" + "#" + value).classList.add("duration-200");
    document.getElementById("form-container" + "#" + value).classList.add("fadeOut");
    document.getElementById("form-container" + "#" + (parseInt(value) + 1).toString()).style["display"] = "block";
    document.getElementById("form-container" + "#" + (parseInt(value) + 1).toString()).classList.add("fadeIn");

  if (value > 1) {
    document.getElementById("information-container").classList.remove("fadeIn");
    document.getElementById("information-container").classList.add("fadeOut");
  };
  if (value > 2 && value <= 3) {
    document.getElementById("information-container").classList.remove("fadeOut");
    document.getElementById("information-container").classList.add("fadeIn");
    if (window.screen.width > 600 && window.screen.height > 500) {
      document.getElementById("information-p").textContent = "Le mandat ad hoc est une procédure préventive de règlement des difficultés. Elle est amiable et confidentielle et a pour but de prévenir la cessation des paiements et aider le chef d’entreprise à trouver un accord avec ses principaux créanciers et partenaires.";
    } else {
      document.getElementById("information-container").style.display = "none";
    };
  };
  if (value > 4 && value <= 5) {
    document.getElementById("information-container").classList.remove("fadeIn");
    document.getElementById("information-container").classList.add("delay-200");
    document.getElementById("information-container").classList.add("fadeOut");
    if (window.screen.width > 600 && window.screen.height > 500) {
      document.getElementById("information-p").textContent = "Le chiffre d'affaires correspond à la somme des prix de vente des marchandises, des produits fabriqués ou des services rendus qui sont facturés par une vous à tous vos clients."
    } else {
      document.getElementById("information-container").style.display = "none";
    };
    document.getElementById("information-container").classList.remove("fadeOut");
    document.getElementById("information-container").classList.remove("delay-200");
    document.getElementById("information-container").classList.add("fadeIn");
  };
  } else {
    document.getElementById("form-container" + "#" + value).classList.remove("delay-200");
    document.getElementById("form-container" + "#" + value).classList.remove("fadeIn");
    document.getElementById("form-container" + "#" + value).classList.add("duration-200");
    document.getElementById("form-container" + "#" + value).classList.add("fadeOut");
    formSubmit()
    document.getElementById("results-container").classList.add("fadeIn");
    document.getElementById("results-container").classList.add("duration-300");
    document.getElementById("results-container").style.display = "block";
    document.getElementById("form-container" + "#" + value).style.display = "none";
  }
};

function hideDownloaderMarginZone(){
  document.getElementById("form-container#1").style["display"] = "block";
  document.getElementById("form-container#1").classList.add("fadeIn");
  if (window.screen.width > 600 && window.screen.height > 500) {
    document.getElementById("information-p").textContent = "La cessation des paiements est le statut juridique d'une personne physique ou d'une personne morale qui ne peut pas rembourser ses dettes parvenues à échéances avec ses liquidités. L’actif disponible, correspondant à tout ce qui peut être transformé en liquidités immédiates ou à très court terme, ne peut compenser le passif exigible."
    document.getElementById("information-container").style["display"] = "block";
      document.getElementById("information-container").classList.add("fadeIn");
  } else {
    document.getElementById("information-container").style.display = "none";
  };
};
hideDownloaderMarginZone()

function formSubmit() {
  $.ajax({
    type: "post",
    url: "backend/procedure.php",
    dataType: "json",
    async: false,
    data: data,
    complete : function(data){
      resultsData = data.responseJSON;
      lenDict = Object.keys(resultsData).length;
      if (lenDict == 0) {
        document.getElementById('downloader-margin-zone').style.display = "none";
        document.getElementById('submit-section').style.display = "block";
      }
      else if (lenDict == 1) {
        document.getElementById('solution#1').innerHTML = Object.keys(resultsData)[0];
        document.getElementById('solution-p#1').innerHTML = Object.values(resultsData)[0];
        document.getElementById('step-bubble#2').style.display = "none";
      }
      else if (lenDict == 2) {
        document.getElementById('solution#1').innerHTML = Object.keys(resultsData)[0];
        document.getElementById('solution-p#1').innerHTML = Object.values(resultsData)[0];
        document.getElementById('solution#2').innerHTML = Object.keys(resultsData)[1];
        console.log(Object.keys(resultsData)[1])
        document.getElementById('solution-p#2').innerHTML = Object.values(resultsData)[1];
      }

    },
  });

};
