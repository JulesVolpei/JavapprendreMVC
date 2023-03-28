  <!-- Slider main container -->
  <div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      <?php
      for ($x = 0; $x < $number_of_rows; ++$x) {
        echo '<div class="swiper-slide c1">
            <div class="nom-exo">' . $rows[$x]['nom_exo'] . '</div>
            <div class="description-exo">' . $rows[$x]['description_exo'] . '</div>
            <div class="image">
              <img src="/images/'.$rows[$x]['fichier'].'.png" alt="'.$rows[$x]['description_exo'] . '">
            </div>
            <a href="exercice.php?id=' . $x . '">
              <button class="learn-more" id="button1">
                <span class="circle" aria-hidden="true">
                  <span class="icon arrow"></span>
                </span>
                <span class="button-text">voir exo</span>
              </button>
            </a>
          </div>';
      }
      ?>

    </div>