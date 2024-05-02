<?php
if (!isset($section)) {
  header("Location: ../index.php");
}
if (session_status() !== PHP_SESSION_ACTIVE)
  session_start(); ?>
<div class="navtop" style="background-color: rgb(207, 0, 138);">
  <div class="navitems">
    <div class="navlink navbrand">
      <a href="index.php"><img class="icon" src="img/org_3.png" width="100" height="90"></a>
    </div>
    <div class="navlink">
      <a href="settings.php" class="section"><b>Settings</b></a>
    </div>
    <div class="navlink">
      <a href="posts.php?pag=1" class="section"><b>Posts</b></a>
    </div>
    <div class="navlink">
      <a href="chat.php?pag=1" class="section" <?php if (!isset($_SESSION['usuario'])) {
        echo 'style="pointer-events:none; color:grey"';
      } ?>><b>Community</b></a>
    </div>
    <div class="navlink">
      <a href="sites.php" class="section"><b>Sites</b></a>
    </div>
    <div class="navlink">
      <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rango'] == "administrador") { ?><a class="section"
          href="admin.php"><b>Administrar</b></a><?php } ?>
    </div>
    <div class="navlink">
      <?php if (isset($_SESSION['usuario']) && ($section != "profile" || isset($_GET['usr']))) { ?><a class="section"
          href="profile.php?profile=my_profile" style="float: right;"><img class="profile"
            src="img/users/<?php echo ($_SESSION['usuario']['foto_perfil']); ?>" height="60" width="60"
            style="border-radius: 100rem; background-color: rgb(255,255,255); object-fit: cover;"></a><?php } ?>
    </div>
  </div>
</div>