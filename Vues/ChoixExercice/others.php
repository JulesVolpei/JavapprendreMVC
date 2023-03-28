    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>


  <div class="wrapper">
    <div id="cent">
      <a href="aPropos.html" class="bn14 btn-footer-right">À propos</a>
      <a href="https://github.com/JulesVolpei/Javapprendre" class="bn14 btn-footer-left">GitHub</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <script src="js/swiper.js"></script>


  <div class="popup">
    <button id="close">&times;</button>
    <h2>Information </h2>
    <p>

      Bonjour <strong><?php echo htmlentities(trim($_SESSION['pseudo'])); ?> </strong> </h3> nous sommes heureux de vous (re)voir. Nous espérons que notre site vous permettra d'apprendre de nombreuses choses !
    </p>

  </div>
  <!--Script-->
  <script src="js/popup.js"></script>
</body>

</html>