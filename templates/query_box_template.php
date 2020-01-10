<!--
VARIABLES:
$is_container:       boolean       (optional)
$label:           String
$id_querybox:     String        (optional)
$id_searchbar:    String        (optional)
$id_criteriabox:  String        (optional)
$id_searchbutton: String        (optional)
$id_selection:    String        (optional)
$script_page:     String        (path)
$search_criteria  array[String] (optional)
$options:         array[String]
$buttons:         String        (html, optional)
standard buttons format:
<div class="text-center">
  <a class="btn-regular btn btn-success" href="#">Add []</a>
  <a class="btn-regular btn btn-warning" href="#">Edit []</a>
  <a class="btn-regular btn btn-danger" href="#">Remove []</a>
  <a class="btn-regular btn btn-primary" href="#">View []</a>
</div>
-->
<div id="<?php if(!empty($id_querybox)){echo $id_querybox;} ?>"
class="querybox <?php if(!empty($is_container)){echo "container";} ?> text-center">
  <label for="search" class="label-text"><?php echo $label; ?></label>
  <form action="<?php echo $script_page; ?>" method="post">
    <input name="search" id="<?php if(!empty($id_searchbar)){echo $id_searchbar;} ?>" class="searchbar"
    placeholder="Search..." type="text" <?php if(!empty($search_criteria)){echo 'style="width: 448px;"';} ?>></input>
    <!-- If there are search criteria, the searchbar width is adjusted for it -->
    <?php
      if(!empty($search_criteria)){
        $criteria_string = '<select id="';
        if(!empty($id_criteriabox)){
          $criteria_string = $criteria_string . $id_criteriabox;
        }
        $criteria_string = $criteria_string . '" class="criterionbox">
          <option disabled selected hidden>Search Criterion</option>';

        foreach($search_criteria as $criterion){
          $criteria_string = $criteria_string . '<option value="' . $criterion . '">' . $criterion . '</option>';
        }
        $criteria_string = $criteria_string . '</select>';

        echo $criteria_string;
        /*
        criteria_string comes in this format:
        <select id="[$id_criteriabox]" class="criterionbox">
          <option disabled selected hidden>Search Criterion</option>
          <option>[Criterion1]</option>
          <option>[Criterion2]</option>
          <option>[Criterion3]</option>
          etc...
        </select>
        */
      }
    ?>
    <button id="<?php if(!empty($id_searchbutton)){echo $id_searchbutton;} ?>" class="searchbutton" type="submit">
      <span class="glyphicon glyphicon-search"></span>
    </button>
  </form>

  <!-- TODO: Use javascript to allow multiple buttons to use same selection? -->
  <select id="<?php if(!empty($id_selection)){echo $id_selection;} ?>" size=10 class="scrollbox col-centered">
    <!-- TODO: Enter search results into these options -->
    <?php
    if(!empty($options)){
      foreach($options as $option){
        echo "<option>" . $option . "</option>";
      }
    }
    ?>
  </select>
</div>
<?php if(!empty($buttons)){echo $buttons;}?>
