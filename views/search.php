
<div class="content" style="margin-top: 6%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-offset-2 col-md-12 col-sm-12">
                <div class="card card-user">
                    <?php
                    if (!isset($_POST['q'])) {
                        if (!empty($_GET['id'])) {
                            $ProfileBox = userModel::get_Data_by_id($_GET['id']);
                        } else {
                            die();
                        }
                    } else {
                        $ProfileBox = userModel::search('u_username', $_POST['q']);
                    }
                    if (empty($ProfileBox)) {
                        die();
                    }
                    ?>
                    <div class="image">
                        <?php
                        if (empty($ProfileBox[0]['u_img_cover'])) {
                            $i = 'background.jpg';
                        } else {
                            $i = $ProfileBox[0]['u_img_cover'];
                        }
                        ?>
                        <img class="img-responsive" style="height: 100%" src="<?= HostName . DS . "assets/img/" . $i ?>" />
                    </div>
                    <div class="content">
                        <div class="author">
                            <?php
                            if (empty($ProfileBox[0]['u_img_profile'])) {
                                $i = 'face.jpg';
                            } else {
                                $i = $ProfileBox[0]['u_img_profile'];
                            }
                            ?>
                            <img class="avatar border-white"  src="<?= HostName . DS . "assets/img/" . $i ?>"/>
                            <h4 class="title"><?= $ProfileBox[0]['u_f_name'] . " " . $ProfileBox[0]['u_s_name'] ?><br />
                                <a href="?rt=HomePage/profile&id=<?= $ProfileBox[0]['u_id'] ?>"><small><?= $ProfileBox[0]['u_username'] ?></small></a>
                            </h4>
                        </div>
                        <p class="description text-center">
                            "<?= $ProfileBox[0]['u_bio'] ?>"
                        </p>
                        <h5 class="text-center"><?= $ProfileBox[0]['u_email'] ?></h5>
                        <h5 class="text-center"><?= $ProfileBox[0]['u_city'] ?></h5>
                        <h5 class="text-center"><?= $ProfileBox[0]['u_country'] ?></h5>

                        <?php
                        if ($ProfileBox[0]['u_id'] != $_SESSION['u_id']) {
                            $check = FriendsModel::checkFriend($_SESSION['u_id'], $ProfileBox[0]['u_id']);
                            if (!empty($check)) {
                                if ($check[0]['role'] == 0 && $check[0]['user_id1'] == $_SESSION['u_id']) {
                                    ?>
                                    <button  onclick="unFriend(<?= $ProfileBox[0]['u_id'] ?>)" class = "active btn btn-default center-block">You Send Request</button>
                                    <?php
                                } else if ($check[0]['role'] == 0 && $check[0]['user_id2'] == $_SESSION['u_id']) {
                                    ?>
                                    <button onclick="confirmFriend(<?= $ProfileBox[0]['u_id'] ?>)"  class="active btn btn-default center-block">Confirm Request</button>
                                <?php } else { ?>
                                    <button onclick="unFriend(<?= $ProfileBox[0]['u_id'] ?>)" class="active btn btn-default center-block">Un Friend</button>
                                    <?php
                                }
                            } else {
                                ?>
                                <button onclick="addFriend(<?= $_SESSION['u_id'] ?>,<?= $ProfileBox[0]['u_id'] ?>)" class="btn btn-default center-block">Add Friend</button>
                                <?php
                            }
                        }
                        ?></div>
                    <hr>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <h5>12<br /><small>Posts</small></h5>
                            </div>
                            <div class="col-md-4">
                                <h5>212<br /><small>Followers</small></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>24,100<br /><small>Following</small></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


