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
      <input type="text" name="Student_ID" value="${classId}"></input>
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
  
}
