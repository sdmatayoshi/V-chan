<?php if (isset($_SESSION['usuario'])) { ?>
        <div
            style="margin: auto; width: 80%; border: 0px solid black; padding: 10px; <?php if ($_COOKIE['dark_mode']=="false") {echo "background-color:lightblue;";}else{echo "background-color:lightslategray;";}?> border-radius: 50px 50px 1px 50px; float:right; padding-right:1rem; margin-bottom: 1rem;">

            <div style="float:right">
                <div style="display: inline-block;"><a href="profile.php?usr=<?php echo $_SESSION['usuario']['id'] ?>" style="<?php if ($_COOKIE['dark_mode']=="true"){echo "color:lightskyblue;";}?>"><b>You</b></a>
                    <div style="display: inline-block; padding-left: 1rem;padding-top: 1rem; padding-right: 1rem;"
                        class="profile">
                        <a href="profile.php?usr=<?php echo $_SESSION['usuario']['id'] ?>"><img
                                src="img/users/<?php echo $_SESSION['usuario']['foto_perfil']; ?>" alt="" class="note-img" width="50rem"
                                height="50rem" style="vertical-align: middle;"></a>
                    </div>
                </div>
            </div>
            <br>
            <br><br>
                <form method="post">
                    <textarea type="text" placeholder="Write something..." name="note" style="padding-left:2%;<?php if ($_COOKIE['dark_mode']=="true") {echo "color:white;";}?>font-size: 18px;width: 96%;height:200px;border:0px;<?php if ($_COOKIE['dark_mode']=="false") {echo "background-color:lightblue;";}else{echo "background-color:lightslategray;";}?>outline: none; resize: none;"></textarea>
                    <input type="submit" value="publish" style="width: 25%; float:right; border:none;">
                </form>
        </div>
        <br><br>
    <?php } ?>
<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
foreach ($notes as $note) {
    $query = "SELECT usuarios.id,usuarios.usu_nombre,usuarios.foto_perfil FROM usuarios LEFT JOIN online_chat ON online_chat.usuario_id = usuarios.id WHERE online_chat.id = '" . $note['id'] . "'";
    $query = mysqli_query($link, $query);
    $usudata = mysqli_fetch_assoc($query);
    $sql = "SELECT * FROM online_chat WHERE fecha_baja IS NULL";
    $query = mysqli_query($link, $sql); ?>

    <?php
    if (!$query) {
        echo "";
    } else { ?>
        <div style="margin: auto; width: 80%; border: 0px solid black; padding: 10px; <?php if (isset($_SESSION['usuario']) && $usudata['id'] == $_SESSION['usuario']['id']) {
            if ($_COOKIE['dark_mode']=="false") {echo "background-color:lightblue;";}else{echo "background-color:lightslategray;";}; echo"border-radius: 50px 50px 1px 50px; float:right; padding-right:1rem; margin-bottom: 1rem;";
        } else {
            if ($_COOKIE['dark_mode']=="false") {echo "background-color:white;";}else{echo "background-color:dimgrey;";} echo "border-radius: 50px 50px 50px 1px; float:left; padding-left:1rem; margin-bottom: 1rem;";
        } ?>">

            <?php if (isset($_SESSION['usuario']) && $usudata['id'] == $_SESSION['usuario']['id']) { ?>
                <div style="float:right">
                    <div style="display: inline-block;"><a href="profile.php?usr=<?php echo $usudata['id'] ?>" style="<?php if ($_COOKIE['dark_mode']=="true"){echo "color:lightskyblue;";}?>"><b>You</b></a>
                        <div style="display: inline-block; padding-left: 1rem;padding-top: 1rem; padding-right: 1rem;"
                            class="profile">
                            <a href="profile.php?usr=<?php echo $usudata['id'] ?>"><img
                                    src="img/users/<?php echo $usudata['foto_perfil']; ?>" alt="" class="note-img" width="50rem"
                                    height="50rem" style="vertical-align: middle;"></a>
                        </div>
                    </div>
                </div>
                <br>

                <?php 
                $str = $note['content'];
                $pattern = '/@/i';
                echo preg_replace($pattern, '<a href ="profile.php?usr='.$usudata['id'].'">'.$usudata['usu_nombre'].'</a>', $str);
                // if (strpos($note['content'],'@') !== false) { //first we check if the url contains the string 'en-us'
                //     $note['content'] = str_replace('@', 'AT', $note['content']); //if yes, we simply replace it with en
                // }
                // echo $note['content'];
                ?>



                
            <?php } else { ?>
                <div style="float:left">
                    <div style="display: inline-block; padding-left: 1rem;padding-top: 1rem; padding-right: 1rem;" class="profile">
                        <a href="profile.php?usr=<?php echo $usudata['id'] ?>"><img
                                src="img/users/<?php echo $usudata['foto_perfil']; ?>" alt="" class="note-img" width="50rem"
                                height="50rem" style="vertical-align: middle;"></a>
                    </div>
                    <div style="display: inline-block;"><a href="profile.php?usr=<?php echo $usudata['id'] ?>" style="<?php if ($_COOKIE['dark_mode']=="true"){echo "color:lightskyblue;";}?>"><b>
                                <?php echo $usudata['usu_nombre']; ?>
                            </b></a>

                    </div>
                </div>
                <br>
            <?php } ?>
            <br><br>
            <div>
            <p style="padding-left: 2rem;padding-bottom: 1rem;<?php if ($_COOKIE['dark_mode']=="true") {echo "color:white;";}?> width:96%">
                <?php echo wordwrap($note['content'], 146, "<br>",true) ?>
            </p>
            </div>
            <a style="text-decoration: none; <?php if ($_COOKIE['dark_mode']=="false") {echo "color:crimson;";}else{echo "color:lightpink;";}?> float:right; padding-right: 2rem; padding-bottom: 1rem;"
                href="chat_ans.php?comment=<?php echo $note['id'] ?>&pag=1">
                &nbsp&nbsp&nbsp<b>Comments</b>
            </a>
            <a style="<?php if ($_COOKIE['dark_mode']=="false") {echo "color:gray;";}else{echo "color:white;";}?> float: right; padding-left: 2rem;">
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