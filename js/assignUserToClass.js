function assignUserToClass(userSelectId, classSelectId){
  var userId = $(userSelectId).val();
  var classId = $(classSelectId).val();

  var data = {
    userId : userId,
    classId : classId
  };

  $.post('/StudentLogger/php/assign_user_to_class.php',data,
    function(){
      alert(`${userId} has been assigned`);
      window.location.reload();
    }
  );
}
