
/**
 * affiche les elements "none"
 * @returns
 */
function affiche() {
  document.getElementById("footer").style.display = "none";
  document.getElementById("formedit").style.display = "block";
  return false;
}
/**
 * cache les elements visibles dans tavleau
 */
function cacherTableau() {
  var tab = document.getElementById("table");
  var line = tab.getElementsByClassName("visible");

  for (var i = 0; i < line.length; i++) {
    var cells = line[i].getElementsByClassName("cell"); //recupération valeurs cellules
    if (cells[4].innerHTML != 0) {
      //boucle pour ne pas afficer les lignes ou il y a la valeur "disable" dans la 4eme cellule
      if (line[i].style.display == "") {
        line[i].style.display = "none";
      } else {
        line[i].style.display = "";
      }
    } else {
      line[i].style.display == "initial";
    }
  }
}
/**
 * css de validations de champs succes
 * @param {} element
 */
function succes(element) {
  element.className = "inpsucces";
}
/**
 * css de validations de champs error
 * @param {*} element
 */
function error(element) {
  element.className = "inperror";
}
/**
 * change le style color
 * @param {*} element
 */
function styleColorRed(element) {
  element.style.color = "red";
}
/**
 * validation de remplissage des champs entreprise
 * @returns
 */
function validateEntreprise() {
  var entreprise = document.forms["formEntreprise"]["user_name"];
  var ville = document.forms["formEntreprise"]["ville"];
  var inputEntreprise = document.getElementById("nameEntreprise");
  var inputVille = document.getElementById("ville");
  if (entreprise.value == "" || entreprise.value.length < 2) {
    var e = document.getElementById("errorentreprise");
    error(inputEntreprise);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez un nom valide avec 2carcatères minimum";
    entreprise.focus();
    return false;
  } else {
    document.getElementById("errorentreprise").innerHTML = "";
    succes(inputEntreprise);
  }
  if (ville.value == "" || ville.value.length < 3) {
    var e = document.getElementById("errorville");
    error(inputVille);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez une ville valide avec 2 caractères minimum";
    ville.focus();
    return false;
  } else {
    document.getElementById("errorville").innerHTML = "";
    succes(inputVille);
  }
  return true;
}
/**
 * validation des champs login
 * @returns
 */
function validateLoginForm() {
  var mail = document.forms["loginForm"]["user_name"];
  var password = document.forms["loginForm"]["password"];
  var inputMail = document.getElementById("user_name");
  var inputPassword = document.getElementById("password_login");
  var result = true;
  if (!checkEmail(mail.value)) {
    var e = document.getElementById("erroremail_login");
    error(inputMail);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez votre email";
    mail.focus();
    result = false;
  } else {
    document.getElementById("erroremail_login").innerHTML = "";
    succes(inputMail);
  }
  if (password.value == "") {
    var e = document.getElementById("errorpassword_login");
    error(inputPassword);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez votre password";
    password.focus();
    result = false;
  } else {
    document.getElementById("errorpassword").innerHTML = "";
    succes(inputPassword);
  }
  return result;
}
/**
 * validation des champs formulaire
 * @returns
 */
function validationForm() {
  var name = document.forms["RegForm"]["lastname"];
  var email = document.forms["RegForm"]["email"];
  var firstname = document.forms["RegForm"]["user_firstname"];
  var origin_password = document.forms["RegForm"]["password1"];
  var confirm_password = document.forms["RegForm"]["password2"];
  var inputName = document.getElementById("lastname");
  var inputFistName = document.getElementById("firstname");
  var inputEmail = document.getElementById("e-mail");
  var inputPassword = document.getElementById("password");
  var confirmPassword = document.getElementById("password2");
  var result = true;
  if (!checkEmail(email.value)) {
    var e = document.getElementById("erroremail");
    error(inputEmail);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez un email valide";
    email.focus();
    result = false;
  } else {
    document.getElementById("erroremail").innerHTML = "";
    succes(inputEmail);
  }
  if (origin_password == "") {
    var e = document.getElementById("errorpassword");
    error(inputPassword);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez un mot de passe avec 4 caractères";
    origin_password.focus();
    result = false;
  } else {
    document.getElementById("errorpassword").innerHTML = "";
    succes(inputPassword);
  }
  if (origin_password.value.length < 4) {
    var e = document.getElementById("errorpassword");
    error(inputPassword);
    styleColorRed(e);
    e.innerHTML =
      "La taille de votre password doit être de minimum 4 caractères";
    origin_password.focus();
    result = false;
  } else {
    document.getElementById("errorpassword").innerHTML = "";
    succes(inputPassword);
  }

  if (confirm_password.value == "") {
    var e = document.getElementById("errorpassword2");
    error(confirmPassword);
    styleColorRed(e);
    e.innerHTML = "Veuillez confirmer votre password";
    confirm_password.focus();
    result = false;
  } else {
    document.getElementById("errorpassword2").innerHTML = "";
    succes(confirmPassword);
  }

  if (
    origin_password.value !== confirm_password.value ||
    confirm_password.value == ""
  ) {
    var e = document.getElementById("errorpassword2");
    error(confirmPassword);
    styleColorRed(e);
    e.innerHTML = "Les 2 passwords ne sont pas équivalents";
    confirm_password.focus();
    result = false;
  } else {
    document.getElementById("errorpassword2").innerHTML = "";
    succes(confirmPassword);
  }
  if (name.value == "" || name.value.length < 2) {
    var e = document.getElementById("errorname");
    error(inputName);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez un nom valide avec 2carcatères minimum";
    name.focus();
    result = false;
  } else {
    document.getElementById("errorname").innerHTML = "";
    succes(inputName);
  }
  if (firstname.value == "" || firstname.value.length < 2) {
    var e = document.getElementById("errorfirstname");
    error(inputFistName);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez un prénom valide avec 2 caractères minimum";
    name.focus();
    result = false;
  } else {
    document.getElementById("errorfirstname").innerHTML = "";
    succes(inputFistName);
  }
  return result;
}
/**
 * triage de tableau par ordre alphabetique
 * @param {*} n
 */
function sortTable(n) {
  
  var table,
    rows,
    switching,
    i,
    x,
    y,
    shouldSwitch,
    dir,
    switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < rows.length - 1; i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("td")[n];
      y = rows[i + 1].getElementsByTagName("td")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
/**
 * validation de champ mail
 * @param {*} string
 * @returns
 */
function checkEmail(string) {
  var regexEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; // "Syntax Coloring fix
  if (!regexEmail.test(string)) {
    return false;
  } else {
    return true;
  }
}

function validateSuperviseur() {
  
  var sujet = document.getElementById("sujet");
  var superviseur = document.getElementById("superviseur");
  var result = true;

  if (sujet.value == "" || sujet.value.length < 2) {
    var e = document.getElementById("error_sujet");
    error(sujet);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez un sujet valide avec 2 caractères minimum";
    
    result = false;
  } else {
    document.getElementById("error_sujet").innerHTML = "";
    succes(sujet);
  }
  if (superviseur.value == "" || superviseur.value.length < 2) {
    var e = document.getElementById("error_superviseur");
    error(superviseur);
    styleColorRed(e);
    e.innerHTML = "Veuillez entrez un nom de superviseur valide avec 2 caractères minimum";
    
    result = false;
  } else {
    document.getElementById("error_superviseur").innerHTML = "";
    succes(superviseur);
  }
  return result;
}
/**
 * insertion dans un tableau html
 * @param {*} element
 * @param {*} check
 */
function insertRow(element, id) {
  
  var cell, ligne;
  var tableau = document.getElementById("myTable2");
  index = element.parentNode.parentNode.rowIndex + 1;
  
  
  bouton1 = document.getElementById("tri1");
  bouton2 = document.getElementById("tri2");
  if (element.value == "s'inscrire") {
    // nombre de lignes dans la table (avant ajout de la ligne)
    bouton1.style.display = 'none';
    bouton2.style.display = 'none';
    tableau.style.marginBottom = '5%';
    
    ligne = tableau.insertRow(element.parentNode.parentNode.rowIndex + 1); // création d'une ligne pour ajout au début de la table
    // on récupère l'identifiant (id) de la table qui sera modifiée
    var tableau = document.getElementById("myTable2");
    // nombre de lignes dans la table (avant ajout de la ligne)
    
    ligne = tableau.insertRow(element.parentNode.parentNode.rowIndex + 1); // création d'une ligne pour ajout au début de la table
    // création et insertion des cellules dans la nouvelle ligne créée
    cell = ligne.insertCell(0);
    cell.colSpan = "3";
    cell.innerHTML =
      "<input type='hidden' name='choix' value='" + id +"' /><input type='text'class='inp' placeholder='description'id='sujet'name='sujet'></input></br><span class='error' id='error_sujet'></span></p><input type='text' class='inp' id='superviseur'placeholder='nom du superviseur' name='superviseur'></br></input><span class='error' id='error_superviseur'></span></p><input type='submit' class='bout'id='button2' name='submit2' value='valider'/>";
    element.value = "annuler";

  } else {
    tableau.deleteRow(index + 1);
    tableau.deleteRow(index);
    tableau.style.marginBottom = '';
    element.value = "s'inscrire";
    bouton1.style.display = '';
    bouton2.style.display = '';
  }
}
/**
 * suppression dans un tableau html
 * @param {*} check
 */
function supprimer(check) {
  document.getElementById("myTable2").deleteRow(check);
}



