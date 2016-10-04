function addSTRsite(){
	$(".viewAdmSTR").load("/controller/adm/ajax/strSite.php");
}
function addCatagoryCon(){
	$(".viewAdmSTR").load("/controller/adm/ajax/addCatagoryCon.php");
}
function editSTR(id){
	$(".loadmodal").load("/controller/adm/ajax/editSTR.php",{'id':id});
}