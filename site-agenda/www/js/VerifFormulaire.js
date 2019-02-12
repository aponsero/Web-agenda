//script de vérification des champs des formulaires selon les champs considérés

  <!--
function verifId(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      alerte(champ, true);
      return false;
   }
   else
   {
      alerte(champ, false);
      return true;
   }
}


function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
      alerte(champ, true);
      return false;
   }
   else
   {
      alerte(champ, false);
      return true;
   }
}
function verifMdp(champ)
{
	//doit contenir au moins 6 caractères, dont une minuscule, une majuscule et un chiffre
   var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/
   if(!regex.test(champ.value))
   {
      alerte(champ, true);
      return false;
   }
   else
   {
      alerte(champ, false);
      return true;
   }
}

function alerte(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}

function verifForm2(f)
{  
   var pseudoOk = verifId(f.identifiant);
   var mailOk = verifMail(f.mail);
   var mdpOk = verifMdp(f.pass);
   
   if(pseudoOk && mailOk && mdpOK)
   {
		return true;
	}
   else
   {
      alert("Veuillez remplir correctement tous les champs, le mot de passe doit contenir 6 caractères minimum dont 1 chiffre et 1 majuscule, l'identifiant doit entre compris entre 2 et 25 caractères.");
      return false;
   }
}
 
function verifForm3(f)
{  
   var pseudoOk = verifId(f.identifiant);
   var mailOk = verifMail(f.mail);
   var mdpOk = verifMdp(f.pass);
   
   if(pseudoOk && mailOk && mdpOk)
   {
		return true;
	}
   else
   {
      alert("Veuillez remplir correctement tous les champs, le mot de passe doit contenir 6 caractères minimum dont 1 chiffre et 1 majuscule, l'identifiant doit entre compris entre 2 et 25 caractères.");
      return false;
   }
}

function verifFormClient(f)
{  
   var nomOk = verifId(f.nom);
   var prenomOK = verifId(f.prenom);
   var mailOk = verifMail(f.mail);
   var mdpOk = verifMdp(f.pass);
   
   if(nomOk && prenomOK && mailOk && mdpOk)
   {
		return true;
	}
   else
   {
      alert("Veuillez remplir correctement tous les champs, le mot de passe doit contenir 6 caractères minimum dont 1 chiffre et 1 majuscule.");
      return false;
   }
}
  //-->