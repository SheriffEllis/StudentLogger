<!--
VARIABLES:
$container:       boolean
$label:           String
$id_querybox:     String
$id_searchbar:    String
$id_searchbutton: String
$id_selection:    String
$script_page:     String (path)
$options:         array(String)
$buttons:         String (html)
buttons format:
<div class="btn-toolbar row row-padded">
  <div class="col-lg-4"></div>
  <button class="col-lg-2 btn btn-success" type="button">Button1</button>
  <button class="col-lg-2 btn btn-warning" type="button">Button2</button>
</div>
-->
<div id="<?php echo $id_querybox; ?>" class="querybox <?php if($container){echo "container";} ?> text-center">
  <label for="search" class="label-text"><?php echo $label; ?></label>
  <form action="<?php echo $script_page; ?>" method="post">
    <input name="search" id="<?php echo $id_searchbar; ?>" class="searchbar" placeholder="Search..." type="text"></input>
    <button id="<?php echo $id_searchbutton; ?>" class="searchbutton" type="submit"><span class="glyphicon glyphicon-search"></span></button>
  </form>

  <!-- TODO: Use javascript to allow multiple buttons to use same selection? -->
  <select id="<?php echo $id_selection; ?>" size=10 class="scrollbox col-lg-7 col-centered">
    <!-- TODO: Enter search results into these options -->
    <?php
    if(!empty($options)){
      foreach($options as $option){
        echo "<option>" . $option . "</option>";
      }
    }
    ?>
  </select>
  <?php if(!empty($buttons)){echo $buttons;}?>
</div>
