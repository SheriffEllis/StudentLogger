//TODO: implement search criteria
function searchNormal(searchId, selectId, table, inputField, outputField){
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
    inputField : inputField,
    outputField: outputField
  };

  $.post('/StudentLogger/php/search_normal.php',data,
    function(results){
      select.empty();
      $.each(results, function(index, value){
        select.append(`<option value=${value}>${value}</option>`);
      });
    }, 'json');
}
