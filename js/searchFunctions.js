function searchNormal(searchId, selectId, table, idField, outputField){
  var search = $(searchId);
  var select = $(selectId);

  var searchString;
  if(!search.val()){
    searchString = '';
  }else{
    searchString = search.val();
  }

  var data = {
    searchString : searchString,
    table : table,
    idField : idField,
    outputField: outputField
  };

  $.post('/StudentLogger/php/search_normal.php',data,
    function(results){
      select.empty();
      $.each(results, function(index, value){
        select.append(`<option value=${index}>${value}</option>`);
      });
    }, 'json');
}

function searchCriterion(searchId, selectId, criterionId, table, idField, outputFields, blankSearch = false){
  var search = $(searchId);
  var select = $(selectId);
  var criterion = $(criterionId);
  var data;

  if(blankSearch){
    //conduct an empty search if blankSearch is set to true
    data = {
      searchString: '',
      table : table,
      idField : idField,
      inputField : idField,
      outputFields:  outputFields
    }
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
      table : table,
      idField : idField,
      inputField : criterion.val(),
      outputFields : outputFields
    };
  }

  $.post('/StudentLogger/php/search_criterion.php',data,
    function(results){
      select.empty();
      $.each(results, function(index, value){
        select.append(`<option value=${index}>${value}</option>`);
      });
    }, 'json');
}
