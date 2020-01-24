function renderUserEdit(){
  var selectedUser = $('#userSelect').val();
  //Check if selection is empty, null or undefined
  if(!selectedUser || selectedUser.length === 0){
    //If nothing selected, hide the user menu
    $('#userEdit').hide();
  }else{
    //If something selected, retrieve user data and show menu
    $('#userEdit').show();
    $('#selectedUserLabel').text(selectedUser);

    $.post('/StudentLogger/php/retrieve_user_data.php',
      { selectedUser: selectedUser },
      function(retrievedData){
        $('#privilege').val(retrievedData.privilege);

        //Iterate through classes array to make a string
        //in format: Class1, Class2, Class3
        var classes = retrievedData.classes;
        var classString = ' ';
        $.each(classes, function(index, value){
          classString = classString.concat(value);
          if(index < classes.length-1){
            classString = classString.concat(', ');
          }
        });
        $('#classesBox').text(classString);
      }, 'json');

    //run an empty search for classes
    var outputFields = ['Year_group', 'Form_group', 'Subject', 'Username'];
    searchCriterion('#classSearchBar', '#classSelect', '#classCriterion', 'class', 'Class_ID', outputFields, true);
  }
}

function assignUserToClass(userSelectId, classSelectId){
  var userId = $(userSelectId).val();
  var classId = $(classSelectId).val();

  if(!classId){
    alert('No class has been selected');
    return;
  }

  var data = {
    userId : userId,
    classId : classId
  };

  $.post('/StudentLogger/php/assign_user_to_class.php',data,
    function(){
      alert(`${userId} has been assigned to the selected class`);
      //update the displays of user's classes
      renderUserEdit();
    }
  );
}

function unassignUserFromClass(classSelectId){
  var classId = $(classSelectId).val();

  if(!classId){
    alert('No class has been selected');
    return;
  }

  var data = {
    classId : classId
  };

  $.post('/StudentLogger/php/unassign_user_from_class.php',data,
    function(){
      alert(`User has been removed from the selected class`);
      //update the displays of user's classes
      renderUserEdit();
    }
  );
}

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
