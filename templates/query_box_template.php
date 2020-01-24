<!--
VARIABLES:
$is_container:    boolean       (optional)
$label:           String
$id_querybox:     String        (optional)
$id_searchbar:    String        (optional)
$id_criteriabox:  String        (optional)
$id_searchbutton: String        (optional)
$id_selection:    String        (optional)
$search_script:   String
$select_script:   String        (optional)
$search_criteria  array[String] (optional)
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
  <p class="label-text"><?php echo $label; ?></p>
  <!-- When user types in searchbar and presses enter/deselects it, the searchscript is run -->
  <input id="<?php if(!empty($id_searchbar)){echo $id_searchbar;} ?>" class="searchbar"
  onchange="<?php if(!empty($search_script)){echo $search_script;} ?>"
  placeholder="Search..." type="search" <?php if(!empty($search_criteria)){echo 'style="width: 448px;"';} ?>></input>
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
  <button id="<?php if(!empty($id_searchbutton)){echo $id_searchbutton;} ?>"
  onclick="<?php if(!empty($search_script)){echo $search_script;} ?>" class="searchbutton" type="button">
    <span class="glyphicon glyphicon-search"></span>
  </button>

  <select id="<?php if(!empty($id_selection)){echo $id_selection;} ?>" size=10
  onchange="<?php if(!empty($select_script)){echo $select_script;} ?>" class="scrollbox col-centered">
  </select>
</div>
<?php
  if(!empty($buttons)){echo $buttons;}

  unset($id_querybox);
  unset($id_searchbar);
  unset($id_criteriabox);
  unset($id_searchbutton);
  unset($id_selection);
  unset($search_script);
  unset($select_script);
  unset($search_criteria);
  unset($buttons);
?>
