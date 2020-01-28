function renderGradeBox(){
  var selectedClass = $('#classSelect').val();
  //Check if selection is empty, null or undefined
  if(!selectedClass || selectedClass.length === 0){
    //If nothing selected, hide the grade selection section
    $('#gradeBox').hide();
  }else{
    //If something selected, reset format selection and display section
    $('#format').prop('selectedIndex',0);
    renderGrades();
    $('#gradeBox').show();
  }
}

function renderGrades(){
  var selectedFormat = $('#format').val();
  var selectedClass = $('#classSelect').val();
  var gradeSelections = $('#gradeSelections');

  if(!selectedFormat){
    $('#gradeSelections').empty();
  }else{

    var data = {
      Class_ID : selectedClass,
      Format_ID: selectedFormat
    };

    $.post('/StudentLogger/php/find_students_in_class_and_grades.php', data,
    function(results){
      var students = results.students;
      var grades = results.grades;

      //grades available for selection
      var gradeOptions = '';
      $.each(grades, function(index, value){
        gradeOptions = gradeOptions.concat(`
          <option value="${value}">${value}</option>
        `);
      });

      //Reset if different format selected
      $('#gradeSelections').empty();

      //append a grade selection for each student in the class
      $.each(students, function(index, value){
        //index is pupil id, value is student's full name
        gradeSelections.append(`
          <div class="row row-padded">
            <label class="label-text text-right col-lg-6" for="${index}">${value}:</label>
            <select class="vertical-text-padding output-text col-lg-2" name="${index}" required>
              <option value="" disabled selected hidden>Grade</option>
              ${gradeOptions}
            </select>
          </div>
        `);
      });

    }, 'json');
  }
}
