<?php
  function retrieveNotifications($Username){
    $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    //Aquire pupils indicated by unread, valid notifications
    $sql = "SELECT Notification_ID, Pupil_ID FROM grade_notification WHERE Username=? AND (Paper1 IS NOT NULL)
      AND (Paper2 IS NOT NULL) AND (Paper3 IS NOT NULL) AND isRead=false";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Username);
    $stmt->bind_result($Notification_ID, $Pupil_ID);
    $stmt->execute();
    $Notification_and_Pupil_IDs = array();
    while($stmt->fetch()){
      $Notification_and_Pupil_IDs[$Notification_ID] = $Pupil_ID;
    }
    $stmt->close();

    //Find Student_ID and Class_ID for each Pupil
    $sql = "SELECT Student_ID, Class_ID FROM pupil WHERE Pupil_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Pupil_ID);
    $stmt->bind_result($Student_ID, $Class_ID);
    $Notification_and_Student_and_Class_IDs = array();
    foreach($Notification_and_Pupil_IDs as $Notification_ID=>$pupil_ID){
      $Pupil_ID = $pupil_ID;
      $stmt->execute();
      $stmt->fetch();
      $Notification_and_Student_and_Class_IDs[$Notification_ID] = array("Student_ID"=>$Student_ID, "Class_ID"=>$Class_ID);
    }
    $stmt->close();

    //Find Student names and Class names
    $Notifications = array();
    foreach($Notification_and_Student_and_Class_IDs as $Notification_ID=>$Student_and_Class_ID){
      $Student_ID = $Student_and_Class_ID["Student_ID"];
      $Class_ID = $Student_and_Class_ID["Class_ID"];

      $sql = "SELECT First_name, Last_name FROM student WHERE Student_ID=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $Student_ID);
      $stmt->bind_result($First_name, $Last_name);
      $stmt->execute();
      $stmt->fetch();
      $Student_name = $First_name . " " . $Last_name;
      $stmt->close();

      $sql = "SELECT Year_group, Form_group, Subject FROM class WHERE Class_ID=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $Class_ID);
      $stmt->bind_result($Year_group, $Form_group, $Subject);
      $stmt->execute();
      $stmt->fetch();
      $Class_name = "Y$Year_group($Form_group)$Subject";
      $stmt->close();

      $Notifications[$Notification_ID] = "$Student_name is struggling in $Class_name";
    }
    $conn->close();

    return $Notifications;
  }
?>
