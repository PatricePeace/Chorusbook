

function modifier_participation(idevenement,idchoriste,status){
//alert(status);
   donees = "{ idevenement :"+idevenement+", idchoriste: "+idchoriste+", status:"+status+" }";
$.ajax({
   type: "post",
   url: "./modifier_participation.php",
   data: { idevenement : idevenement, idchoriste: idchoriste, status:status },

   //data: "idevenement="+idevenement"
   error: function() {
     alert('La requête n\'a pas abouti'); }
   });   
}
