<div class="container text-center">
  <!-- Post results to self (used for both student data entry and class data entry)-->
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <?php
      foreach($fields as $field){
        $readonly = ''; //used to make Student_ID (and other ID's) readonly in edit page
        $hidden = ''; //used to make Class_ID hidden (is autoincremented)

        //Don't require entry of teacher: skip this entry
        if($field == 'Username'){
          continue;
        }

        //Do not show the Class_ID input
        if($field == 'Class_ID'){$hidden = 'style="display: none;"';}

        //If on edit page, do not allow edit of Student ID
        if(!empty($values)){
          $value = $values[$field];
          if($field == 'Student_ID'){$readonly = 'readonly';}
        }else{
          $value = '';
        }

        echo '
        <div class="row form-group">
          <label for="'. $field.'" class="label-text text-center"'.$hidden.'>'.$field.'</label>
          <input type="text" class="col-lg-4 col-centered form-control form-m"
          name="'.$field.'" value="'.$value.'" '.$readonly.' '.$hidden.' required>
        </div>
        ';
      }
    ?>

    <div class="row row-padded">
      <button class="btn btn-success btn-regular" type="submit">Save</button>
      <a class="btn btn-danger btn-regular" href="manage_students_page.php">Cancel</a>
    </div>
  </form>
</div>
