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
    var outputFields = ['Year_group', 'Form_group', 'Subject'];
    searchCustomOutputString('#classSearchBar', '#classSelect', 'class', 'Class_ID', outputFields);
  }
}
