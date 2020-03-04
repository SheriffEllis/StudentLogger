<?php
  function publishNotifications($conn, $Paper, $Format_ID, $Pupil_Grades){
    //Check for grades that are considered poor (below or equal to value of 1)
    $sql = "SELECT Symbol FROM format WHERE Format_ID=$Format_ID AND Value <= 1";
    $results = $conn->query($sql);
    //Array of which grades in this format are poor
    $poor_grades = array();
    while($row = $results->fetch_assoc()){
      array_push($poor_grades, $row["Symbol"]);
    }

    //Find which pupils have poor grades
    $poor_grade_pupils = array();
    foreach($Pupil_Grades as $Pupil_ID => $Grade){
      if(in_array($Grade, $poor_grades)){
        array_push($poor_grade_pupils, $Pupil_ID);
      }
    }

    //Check if notification for poor grade already exists
    foreach($poor_grade_pupils as $Pupil_ID){
      $sql = "SELECT Notification_ID FROM grade_notification WHERE Pupil_ID=$Pupil_ID
        AND isRead=false LIMIT 1";
      $results = $conn->query($sql);
      $row = $results->fetch_assoc();
      if(!$row){
        //If no notifications exist for this pupil, create new notification
        createNewNotification($conn, $Pupil_ID, $Paper);
        continue;
      }
      //Otherwise search for if notifications exist for this paper
      $sql = "SELECT Notification_ID FROM grade_notification WHERE Pupil_ID=$Pupil_ID AND
        (Paper1=? OR Paper2=? OR Paper3=?) LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $Paper, $Paper, $Paper);
      $stmt->bind_result($Flag);
      $stmt->execute();
      $stmt->fetch();
      $stmt->close();
      if($Flag == null){
        //If none of the existing notifications contain this paper, update to include this paper

        //Search for empty slot in existing notifications to insert paper
        $slots = array("Paper1", "Paper2", "Paper3");
        $found = false;
        foreach($slots as $slot){
          $Notification_ID = lookForEmptySlot($conn, $Pupil_ID, $slot);
          if($Notification_ID != null){
            //update notification in this slot
            $sql = "UPDATE grade_notification SET $slot=? WHERE Notification_ID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $Paper, $Notification_ID);
            $stmt->execute();
            $found = true;
            break;
          }
        }
        if(!$found){
          //If all notifications have all three slots full, create new notification
          createNewNotification($conn, $Pupil_ID, $Paper);
        }
      }
      //If notifications for this paper do exist, do nothing
    }
  }

  function lookForEmptySlot($conn, $Pupil_ID, $slot){
    $sql = "SELECT Notification_ID FROM grade_notification WHERE Pupil_ID=$Pupil_ID AND ($slot IS NULL) AND isRead=false LIMIT 1";
    $results = $conn->query($sql);
    $row = $results->fetch_assoc();
    if(!$row){
      return null;
    }else{
      return $row["Notification_ID"];
    }
  }

  function createNewNotification($conn, $Pupil_ID, $Paper){
    //Search for teacher of class
    $sql = "SELECT Class_ID FROM pupil WHERE Pupil_ID=$Pupil_ID LIMIT 1";
    $results = $conn->query($sql);
    $row = $results->fetch_assoc();
    $Class_ID = $row["Class_ID"];
    $sql = "SELECT Username FROM class WHERE Class_ID=$Class_ID LIMIT 1";
    $results = $conn->query($sql);
    $row = $results->fetch_assoc();
    $Username = $row["Username"];

    //Create new notification
    $sql = "INSERT INTO grade_notification (Username, Pupil_ID, Paper1) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $Username, $Pupil_ID, $Paper);
    return $stmt->execute();
  }
?>
