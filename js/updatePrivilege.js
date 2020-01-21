function updatePrivilege(){
  var selectedUser = $('#userSelect').val();
  var privilege = $('#privilege').val();

  $.post('/StudentLogger/php/update_privilege.php',
    { usr : selectedUser, privilege : privilege },
    function (data){
      alert(selectedUser.concat('\'s privilege successfully updated to ', privilege));
    }
  );
}
