<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
foreach ($notes as $note) {
    $query = "SELECT usuarios.id,usuarios.usu_nombre,usuarios.foto_perfil FROM usuarios LEFT JOIN online_chat ON online_chat.usuario_id = usuarios.id WHERE online_chat.id = '" . $note['id'] . "'";
    $query = mysqli_query($link, $query);
    $usudata = mysqli_fetch_assoc($query);
    $sql = "SELECT * FROM online_chat WHERE fecha_baja IS NULL";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "";
    } else { ?>
        <div style="margin: auto; width: 80%; border: 0px solid black; padding: 10px; <?php if (isset($_SESSION['usuario']) && $usudata['id'] == $_SESSION['usuario']['id']) {
            echo "background-color:lightblue; border-radius: 50px 50px 1px 50px; float:right; padding-right:1rem; margin-bottom: 1rem;";
        } else {
            echo "background-color:white; border-radius: 50px 50px 50px 1px; float:left; padding-left:1rem; margin-bottom: 1rem;";
        } ?>">

            <?php if (isset($_SESSION['usuario']) && $usudata['id'] == $_SESSION['usuario']['id']) { ?>
                <div style="float:right">
                    <div style="display: inline-block;"><a href="profile.php?usr=<?php echo $usudata['id'] ?>"><b>You</b></a>
                        <div style="display: inline-block; padding-left: 1rem;padding-top: 1rem; padding-right: 1rem;"
                            class="profile">
                            <a href="profile.php?usr=<?php echo $usudata['id'] ?>"><img
                                    src="img/users/<?php echo $usudata['foto_perfil']; ?>" alt="" class="note-img" width="50rem"
                                    height="50rem" style="vertical-align: middle;"></a>
                        </div>
                    </div>
                </div>
                <br>
            <?php } else { ?>
                <div style="float:left">
                    <div style="display: inline-block; padding-left: 1rem;padding-top: 1rem; padding-right: 1rem;" class="profile">
                        <a href="profile.php?usr=<?php echo $usudata['id'] ?>"><img
                                src="img/users/<?php echo $usudata['foto_perfil']; ?>" alt="" class="note-img" width="50rem"
                                height="50rem" style="vertical-align: middle;"></a>
                    </div>
                    <div style="display: inline-block;"><a href="profile.php?usr=<?php echo $usudata['id'] ?>"><b>
                                <?php echo $usudata['usu_nombre']; ?>
                            </b></a>

                    </div>
                </div>
                <br>
            <?php } ?>

            <br><br>
            <p style="padding-left: 2rem;padding-bottom: 1rem;">
                <?php echo $note['content'] ?>
            </p>
            <a style="text-decoration: none; color: crimson; float:right; padding-right: 2rem; padding-bottom: 1rem;"
                href="chat_ans.php?comment=<?php echo $note['id'] ?>&pag=1">
                &nbsp&nbsp&nbsp<b>Comments</b>
            </a>
            <a style="color: gray; float: right; padding-left: 2rem;">
                <?php echo $note['fecha_alta'] ?>
            </a>
        </div>
        <br><br>
    <?php } ?>
    <?php
    $cont = $cont + 1;
} ?>
<div class="paginador" style="text-align: center;">
    <p>
        <?php for ($i = 1; $i <= ceil(intval($cant["n"]) / 10); $i++) { ?>
            <a href="chat.php?pag=<?php echo $i; ?>"><button>
                    <?php echo $i; ?>
                </button></a>
        <?php } ?>
    </p>
</div>
<?php if (isset($_SESSION['usuario'])) { ?>
    <div style="position: fixed; bottom: 0; right: 0; width: 300px; border: 3px solid #73AD21;">
        <form method="post">
            <input type="text" name="note" style="width: 75%;">
            <input type="submit" value="publish" style="float: right; width:22%">
        </form>
    </div>
<?php } ?>