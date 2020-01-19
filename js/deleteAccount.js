//redirect variable determines which page will be redirected to when script complete
function deleteAccount(username, redirect = '/StudentLogger/index.php'){
  if(confirm('Are you sure you want to delete '.concat(username, '?'))){
    $.post('/StudentLogger/php/delete_account.php',
      {usr: username},
      alert('Successfully deleted '.concat(username))
    );
    window.location = redirect;
  }
}
