<div class="container text-center">
  <!-- Post results to self -->
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <?php
      foreach($fields as $field){
        $readonly = ''; //used to make Student_ID readonly in edit page
        if(!empty($values)){
          $value = $values[$field];
          if($field == 'Student_ID'){$readonly = "readonly";}
        }else{
          $value = '';
        }

        echo '
        <div class="row form-group">
          <label for="' . $field . '" class="label-text text-center">' . $field .'</label>
          <input type="text" class="col-lg-4 col-centered form-control form-m" id="login-field"
          name="' . $field . '" value="' . $value . '" ' . $readonly . '>
        </div>
        ';
      }
    ?>

    <div class="row row-padded">
      <!-- TODO: create/edit student script -->
      <button class="btn btn-success btn-regular" type="submit">Save</button>
      <a class="btn btn-danger btn-regular" href="manage_students_page.php">Cancel</a>
    </div>
  </form>
</div>
