function valup(){


		if(document.getElementById("parte").value==""){
			alert("Debe diginar el numero del parte");
			document.getElementById("parte").focus();
			return false;
                }
return true;

}

function asignarllave(valor1){

    document.getElementById("parte").value=valor1;

    document.frmgrua.action = "grua_mod.php";
    document.frmgrua.submit();
    

    return valor1;
}

function asignarllave1(valor1){

    document.getElementById("dato").value=valor1;

    document.frmgrua.action = "ambulancia_mod.php";
    document.frmgrua.submit();


    return valor1;
}


function valced(){
    if(document.getElementById("ced_inv").value==""){
			alert("Debe digitar el documento de identidad");
			document.getElementById("ced_inv").focus();
                        return false;
		} else {
                    document.forminvol.action = "inv_ins.php";
                    document.forminvol.submit();
                }
     return true;
}









function asignarinv(valor1){

    document.getElementById("dato").value=valor1;

    document.frmmodinvo.action = "mod_invo.php";
    document.frmmodinvo.submit();


    return valor1;
}

function asignarvic(valor1){

    document.getElementById("dato").value=valor1;

    document.frmmodvic.action = "mod_vict.php";
    document.frmmodvic.submit();


    return valor1;
}