function searchExam(searchId, selectId, criterionId, blankSearch = false){
  var search = $(searchId);
  var select = $(selectId);
  var criterion = $(criterionId);
  var data;

  if(blankSearch){
    //conduct an empty search if blankSearch is set to true
    data = {
      searchString : '',
      criterion : 'Paper'
    };
  }else{
    if(!criterion.val()){
      alert('No search criterion selected');
      return;
    }

    var searchString;
    if(!search.val()){
      searchString = '';
    }else{
      searchString = search.val();
    }

    data = {
      searchString : searchString,
      criterion : criterion.val()
    };
  }

  $.post('/StudentLogger/php/search_exam.php',data,
    function(results){
      select.empty();
      $.each(results, function(index, value){
        select.append(`<option value=${value}>${value}</option>`);
      });
    }, 'json');
}

function editExam(){
  var url = '/StudentLogger/pages/exam_data/edit_exam_page.php';
  var paper = $('#examSelect').val();
  if(!paper){
    alert('No exam selected');
    return;
  }
  var form = $(`
    <form action="${url}" method="post">
      <input type="text" name="Paper" value="${paper}"></input>
    </form>
  `);
  $('body').append(form);
  form.submit();
}

function removeExam(){
  var paper = $('#examSelect').val();
  if(!paper){
    alert('No exam selected');
    return;
  }
  if(confirm('Are you sure you want to delete this exam?')){
    $.post('/StudentLogger/php/delete_exam.php',
      {Paper: paper},
      alert('Successfully deleted exam')
    );
    window.location.reload();
  }
}

function viewExam(){
  var url = '/StudentLogger/pages/exam_data/view_exam_page.php';
  var paper = $('#examSelect').val();
  if(!paper){
    alert('No exam selected');
    return;
  }
  var form = $(`
    <form action="${url}" method="post">
      <input type="text" name="Paper" value="${paper}"></input>
    </form>
  `);
  $('body').append(form);
  form.submit();
}
