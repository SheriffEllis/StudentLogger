function selectTable(){
  var tableId = $('#tableSelect').val();
  if(tableId){
    $.post('/StudentLogger/php/retrieve_table_properties.php', {Data_table_ID : tableId},
      function(results){
        var description = results.description;
        var columns = results.columns;

        $('#table-description').text(description);
        $('#table-columns').text(columns);
      }
    , 'json');
  }
}

function selectFunction(){
  var functionId = $('#functionSelect').val();
  if(functionId){
    $.post('/StudentLogger/php/retrieve_function_properties.php', {Function_ID : functionId},
      function(results){
        var description = results.description;
        var inputs = results.inputs;
        var functionType = results.functionType;

        $('#function-description').text(description);
        $('#function-inputs').text(inputs);
        $('#function-type').text(functionType);
      }
    , 'json');
  }
}
