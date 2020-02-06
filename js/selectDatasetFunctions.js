function renderOptions(){
  var selectedTable = $('#tableSelect').val();
  if(!selectedTable){alert('Error: no table selected'); return;}

  var outputFieldRow = $('#outputFieldRow');
  var outputFieldSelect = $('#outputFieldSelect');
  var orderDeterminingRow = $('#orderDeterminingRow');
  var orderDeterminingFieldSelect = $('#orderDeterminingFieldSelect');
  var conditionsSection = $('#conditionsSection');

  $.post('/StudentLogger/php/retrieve_table_fields.php', {table: selectedTable},
    function(tableFields){
      outputFieldSelect.empty();
      orderDeterminingFieldSelect.empty();
      conditionsSection.empty();
      addCondition(0);
      outputFieldSelect.append('<option disabled selected hidden>Select Output Field</option>');
      orderDeterminingFieldSelect.append('<option disabled selected hidden>Order Determining Field</option>');
      $.each(tableFields, function(index, value){
        var optionString = `<option value="${value}">${value}</option>`;
        outputFieldSelect.append(optionString);
        orderDeterminingFieldSelect.append(optionString);
      });
      outputFieldRow.show();
      orderDeterminingRow.show();
    }, 'json'
  );
}

function addCondition(number){
  var selectedTable = $('#tableSelect').val();
  if(!selectedTable){alert('Error: no table selected'); return;}

  var conditionsSection = $('#conditionsSection');
  $.post('/StudentLogger/php/retrieve_table_fields.php', {table : selectedTable},
    function(tableFields){
      var optionString = '';
      $.each(tableFields, function(index, value){
        optionString = optionString.concat(`<option value="${value}">${value}</option>`);
      });
      conditionsSection.append(`
        <div id="condition${number}">
          <div class="col-lg-8 col-centered box">
            <div class="row row-padded label-text text-center">
              <label>Condition ${number}</label>
              <input id="checkbox${number}" name="ticked[${number}]" class="mediumCheckbox" type="checkbox"
              onchange="updateConditions()"></input>
            </div>

            <div class="row row-padded text-center">
              <select name="investigated_field[${number}]" class="output-text">
                <option disabled selected hidden>Investigated Field</option>
                ${optionString}
              </select>
            </div>

            <div class="row row-mid-padded text-center">
              <select name="comparator[${number}]" class="output-text">
                <option disabled selected hidden>Comparator</option>
                <option value="=="> == </option>
                <option value="!="> != </option>
                <option value="<" > <  </option>
                <option value="<="> <= </option>
                <option value=">" > >  </option>
                <option value="=>"> => </option>
              </select>
            </div>

            <div class="row row-mid-padded">
              <p class="col-lg-6 text-right output-text">Compared Value:</p>
              <input name="compared_value[${number}]" class="col-lg-3 vertical-text-padding" placeholder="Enter value..."></input>
            </div>
          </div>

          <div class="row row-mid-padded text-center">
            <select name="logic_operator[${number}]" class="col-centered output-text">
              <option selected disabled hidden>Logical Operator</option>
              <option value="AND">AND</option>
              <option value="OR">OR</option>
              <option value="XOR">XOR</option>
              <option value="NAND">NAND</option>
              <option value="NOR">NOR</option>
            </select>
          </div>
        </div>
      `);
    }, 'json'
  );
}

function updateConditions(){
  //checks if each condition box exists and if the box is checked
  for(i = 0; $(`#condition${i}`).length; i++){
    if($(`#checkbox${i}`).is(':checked')){         //If checkbox ticked
      if(!$(`#condition${i+1}`).length){  //And next condition doesn't exist
        addCondition(i+1);                //Create new condition
      }
    }else if($(`#condition${i+1}`).length){ //If checkbox unticked and next condition does exist
      //loop through all consecutive conditions and remove
      for(x = i+1; $(`#condition${x}`).length; x++){
        $(`#condition${x}`).remove();
      }
    }
  }
}

function selectDataset(Dataset_index){
  var form = $('#datasetForm');
  if(validateInput()){
    form.append(`<input style="display: none;" name="Dataset_index" value=${Dataset_index} />`);
    form.submit();
  }
}

function cancelDataset(){
  var form = $('#datasetForm');
  form.empty();
  form.submit();
}

function validateInput(){
  var datasetName = $('#datasetName').val();
  var tableSelection = $('#tableSelect').val();
  var outputFieldSelection = $('#outputFieldSelect').val();
  var orderDeterminingFieldSelection = $('#orderDeterminingFieldSelect').val();
  var orderSelection = $('#orderSelect').val();

  if(datasetName && tableSelection && outputFieldSelection && orderDeterminingFieldSelection && orderSelection){
    return true;
  }

  //TODO: more thorough name validation
  if(!datasetName){
    alert('Please type in a dataset name');
  }else if(!tableSelection){
    alert('Please select a table');
  }else if(!outputFieldSelection){
    alert('Please select an output field');
  }else if(!orderDeterminingFieldSelection){
    alert('Please select an order determining field');
  }else if(!orderSelection){
    alert('Please select an order of output');
  }
  return false;
}
