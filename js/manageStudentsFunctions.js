function editStudent(){
  var url = '/StudentLogger/pages/manage_students/edit_student_page.php';
  var studentId = $('#studentSelect').val();
  if(!studentId){
    alert('No student selected');
    return;
  }
  var form = $(`
    <form action="${url}" method="post">
      <input type="text" name="Student_ID" value="${studentId}"></input>
    </form>
  `);
  $('body').append(form);
  form.submit();
}

function removeStudent(){
  var studentId = $('#studentSelect').val();
  if(!studentId){
    alert('No student selected');
    return;
  }
  if(confirm('Are you sure you want to delete this student?')){
    $.post('/StudentLogger/php/delete_student.php',
      {Student_ID: studentId},
      alert('Successfully deleted student')
    );
    window.location.reload();
  }
}

function viewStudent(){
  var url = '/StudentLogger/pages/manage_students/view_student_page.php';
  var studentId = $('#studentSelect').val();
  if(!studentId){
    alert('No student selected');
    return;
  }
  var form = $(`
    <form action="${url}" method="post">
      <input type="text" name="Student_ID" value="${studentId}"></input>
    </form>
  `);
  $('body').append(form);
  form.submit();
}

function editClass(){
  var url = '/StudentLogger/pages/manage_students/edit_class_page.php';
  var classId = $('#classSelect').val();
  if(!classId){
    alert('No class selected');
    return;
  }
  var form = $(`
    <form action="${url}" method="post">
      <input type="text" name="Class_ID" value="${classId}"></input>
    </form>
  `);
  $('body').append(form);
  form.submit();
}

function removeClass(){
  var classId = $('#classSelect').val();
  if(!classId){
    alert('No class selected');
    return;
  }
  if(confirm('Are you sure you want to delete this class?')){
    $.post('/StudentLogger/php/delete_class.php',
      {Class_ID: classId},
      alert('Successfully deleted class')
    );
    window.location.reload();
  }
}

function assignStudentToClass(){
  var classId = $('#classSelect').val();
  var studentId = $('#studentSelect').val();

  if(!classId){
    alert('No class selected');
    return;
  }
  if(!studentId){
    alert('No student selected');
    return;
  }

  var data = {
    Class_ID : classId,
    Student_ID : studentId
  };

  $.post('/StudentLogger/php/assign_student_to_class.php', data,
    function(response){
      if(response == 'success'){
        alert('Successfully assigned student to class');
      }else if(response == 'exists'){
        alert('Student already assigned to that class');
      }else{
        alert('Error');
      }
    }
  );
}

function unassignStudentFromClass(){
  var classId = $('#classSelect').val();
  var studentId = $('#studentSelect').val();

  if(!classId){
    alert('No class selected');
    return;
  }
  if(!studentId){
    alert('No student selected');
    return;
  }

  var data = {
    Class_ID : classId,
    Student_ID : studentId
  };

  $.post('/StudentLogger/php/unassign_student_from_class.php', data,
    function(response){
      if(response == 'success'){
        alert('Successfully removed student from class');
      }else if(response == 'notexist'){
        alert('Student was not assigned to class');
      }else{
        alert('Error');
      }
    }
  );
}
