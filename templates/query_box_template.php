<div id="" class="querybox <?php if($container){echo "container";} ?> text-center">
  <label for="search" class="label-text"><?php echo $label; ?></label>
  <form action="admin_settings_page.php" method="post">
    <input name="search" id="" class="searchbar" placeholder="Search..." type="text"></input>
    <button id="" class="searchbutton" type="submit"><span class="glyphicon glyphicon-search"></span></button>
  </form>

  <!-- TODO: Use javascript to allow multiple buttons to use same selection? -->
  <select id="" size=10 class="scrollbox col-lg-7 col-centered">
    <!-- TODO: Enter search results into these options -->
    <option>13ENG</option>
    <option>12ENG</option>
    <option>13ECO</option>
  </select>
  <div class="btn-toolbar row row-padded">
    <div class="col-lg-4"></div>
    <button class="col-lg-2 btn btn-success" type="button">Assign User to Class</button>
    <button class="col-lg-2 btn btn-warning" type="button">Unassign User from Class</button>
  </div>
</div>
