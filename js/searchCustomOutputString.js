function searchCustomOutputString(searchId, selectId, table, idField, outputFields){
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
    outputFields : outputFields
  };

  $.post('/StudentLogger/php/search_custom_output_string.php',data,
    function(results){
      select.empty();
      $.each(results, function(index, value){
        select.append(`<option value=${index}>${value}</option>`);
      });
    }, 'json');
}
