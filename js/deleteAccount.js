function deleteAccount(username){
  if(confirm("Are you sure you want to delete ".concat(username, "?"))){
    $.post("/StudentLogger/php/delete_account.php",
      {usr: username},
      alert("Successfully deleted ".concat(username))
    );
    window.location = "/StudentLogger/index.php";
  }
}
