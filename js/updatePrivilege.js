function updatePrivilege(){
  var selectedUser = $('#userSelect').val();
  var privilege = $('#privilege').val();

  if(privilege >= 0 && privilege <= 2){
    $.post('/StudentLogger/php/update_privilege.php',
      { usr : selectedUser, privilege : privilege },
      function (data){
        alert(selectedUser.concat('\'s privilege successfully updated to ', privilege));
      }
    );
  }else{
    alert(`${privilege} is not a valid privilege value!`);
  }
}
