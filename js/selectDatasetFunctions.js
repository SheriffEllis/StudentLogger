function renderOptions(){
  var selectedTable = $('#tableSelect').val();
  if(!selectedTable){alert('Error: no table selected'); return;}

  var outputFieldRow = $('#outputFieldRow');
  var outputFieldSelect = $('#outputFieldSelect');
  var orderDeterminingRow = $('#orderDeterminingRow');
  var orderDeterminingFieldSelect = $('#orderDeterminingFieldSelect');

  $.post('/StudentLogger/php/retrieve_table_fields.php', {table: selectedTable},
    function(tableFields){
      outputFieldSelect.empty();
      orderDeterminingFieldSelect.empty();
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
