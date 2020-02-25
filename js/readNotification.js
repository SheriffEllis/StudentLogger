function readNotification(notificationId){
  $.post('/StudentLogger/php/read_notification.php', {Notification_ID: notificationId},
    function(){
      window.location.reload();
    }
  );
}
