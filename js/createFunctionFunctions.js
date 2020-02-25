function renderValues(Dataset_IDs){
  $('#valueSelection').empty();
  if(Dataset_IDs.length > 0){
    //search for Dataset_names corresponding to IDs
    $.post('/StudentLogger/php/retrieve_dataset_names.php', {Dataset_IDs: Dataset_IDs},
    function(Dataset_names){
      $.each(Dataset_IDs, function(index, value){
        addValue(Dataset_IDs, index, Dataset_names[value], value);
      });
      //Final value to select new dataset
      addValue(Dataset_IDs, Dataset_IDs.length);
    }, 'json');
  }else{
    //If dataset_ID list is empty, only display first empty value
    addValue(Dataset_IDs, Dataset_IDs.length);
  }
}

function addValue(Dataset_IDs, index, Dataset_name = '(Select Data Set)', Dataset_ID = null){
  var buttonClass;
  if(Dataset_name == '(Select Data Set)'){
    buttonClass = 'btn-default';
  }else{
    buttonClass = 'btn-primary';
  }
  var Dataset_IDs_string = `[${Dataset_IDs.toString()}]`;

  $('#valueSelection').append(`
    <div class="row row-padded">
      <input name="Dataset_IDs[${index}]" style="display: none;" value=${Dataset_ID} />
      <label class="label-text text-right col-lg-6">Value ${index}:</label>
      <button class="btn btn-regular ${buttonClass}" type="button" onclick="selectDataset(${Dataset_IDs_string}, ${index})">${Dataset_name}</button>
    </div>
  `);
}

function selectDataset(Dataset_IDs, index){
  var url = '/StudentLogger/pages/data_representation/select_dataset_page.php';
  var postback = 'create_function_page.php';
  var form = $('#functionForm');
  //Dataset_index determines which value the dataset corresponds to
  //Postback tells the select_dataset_page to send the data back to create_function_page
  form.append(`
    <div style="display: none;">
      <input name="Dataset_index" value="${index}"/>
      <input name="Postback" value="${postback}"/>
    </div>
  `);
  form.attr('action', url); //change action of form to submit (temporily) to select_dataset_page
  //Posts Dataset_IDs[], Dataset_index, Function_title, and Function_description to select_dataset_page
  form.submit();
}

function cancel(){
  $.post('/StudentLogger/php/discard_datasets.php', {}, function(){
    window.location = 'data_representation_page.php';
  });
}
