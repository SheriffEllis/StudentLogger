function selectTable(){
  var tableId = $('#tableSelect').val();
  if(tableId){
    $.post('/StudentLogger/php/retrieve_datatable_properties.php', {Data_table_ID : tableId},
      function(results){
        var description = results.description;
        var columns = results.columns;

        $('#table-description').text(description);
        $('#table-columns').text(columns);
      }
    , 'json');
  }
}

function editTable(){
  var url = '/StudentLogger/pages/data_representation/create_table_page.php';
  var tableId = $('#tableSelect').val();
  if(!tableId){
    alert('No datatable selected');
    return;
  }
  $.post('/StudentLogger/php/retrieve_full_datatable_properties.php', {Data_table_ID : tableId},
  function(properties){
    var Dataset_IDs_String = '';
    $.each(properties.Dataset_IDs, function(index, value){
      if(value != null){
        Dataset_IDs_String = Dataset_IDs_String.concat(`
          <input name="Dataset_IDs[${index}]" value=${value} />
        `);
      }
    });
    var form = $(`
      <form action="${url}" style="display: none;" method="post">
        <input name="_ID" value=${tableId} />
        <input name="Title" value="${properties.Title}" />
        <input name="Description" value="${properties.Description}" />
        ${Dataset_IDs_String}
      </form>
    `);
    $('body').append(form);
    form.submit();
  }, 'json');
}

function removeTable(){
  var tableId = $('#tableSelect').val();
  if(!tableId){
    alert('No table selected');
    return;
  }
  if(confirm('Are you sure you want to delete this data table?')){
    $.post('/StudentLogger/php/delete_datatable.php',
      {Data_table_ID: tableId},
      alert('Successfully deleted datatable')
    );
    window.location.reload();
  }
}

function viewTable(){
  alert('TODO');
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

function editFunction(){
  var url = '/StudentLogger/pages/data_representation/create_function_page.php';
  var functionId = $('#functionSelect').val();
  if(!functionId){
    alert('No function selected');
    return;
  }
  $.post('/StudentLogger/php/retrieve_full_function_properties.php', {Function_ID : functionId},
  function(properties){
    var Dataset_IDs_String = '';
    $.each(properties.Dataset_IDs, function(index, value){
      if(value != null){
        Dataset_IDs_String = Dataset_IDs_String.concat(`
          <input name="Dataset_IDs[${index}]" value=${value} />
        `);
      }
    });
    var form = $(`
      <form action="${url}" style="display: none;" method="post">
        <input name="_ID" value=${functionId} />
        <input name="Title" value="${properties.Title}" />
        <input name="Description" value="${properties.Description}" />
        <input name="Function_type" value="${properties.Function_type}" />
        ${Dataset_IDs_String}
      </form>
    `);
    $('body').append(form);
    form.submit();
  }, 'json');
}

function removeFunction(){
  var functionId = $('#functionSelect').val();
  if(!functionId){
    alert('No function selected');
    return;
  }
  if(confirm('Are you sure you want to delete this function?')){
    $.post('/StudentLogger/php/delete_function.php',
      {Function_ID: functionId},
      alert('Successfully deleted function')
    );
    window.location.reload();
  }
}

function viewFunctionOutput(){
  alert('TODO');
}
