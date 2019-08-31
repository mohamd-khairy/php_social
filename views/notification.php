<div class="content" style="margin-top: 6%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12 col-sm-12 pull-right">
                <div class="card card-user">
                    <?php
                    $ProfileBox = userModel::getRandom(1);
                    ?>
                    <div class="image">
                        <?php
                        if (empty($ProfileBox[0]['u_img_cover'])) {
                            $i = 'background.jpg';
                        } else {
                            $i = $ProfileBox[0]['u_img_cover'];
                        }
                        ?>
                        <img style="height: 100%;width: 100%" src="<?= HostName . DS . "assets/img/" . $i ?>" />
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
                            <img class="avatar border-white"src="<?= HostName . DS . "assets/img/" . $i ?>"/>
                            <h4 class="title"><?= $ProfileBox[0]['u_f_name'] . " " . $ProfileBox[0]['u_s_name'] ?><br />
                                <a href="?rt=HomePage/profile&id=<?= $ProfileBox[0]['u_id'] ?>"><small><?= $ProfileBox[0]['u_username'] ?></small></a>
                            </h4>
                        </div>
                        <p class="description text-center">
                            "<?= $ProfileBox[0]['u_bio'] ?>"
                        </p>

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
                        ?>
                    </div>
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
            <div class="col-lg-8 col-xs-12 col-md-12 col-sm-12 pull-left">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Notifications</h4>
                    </div>
                    <div class="content">
                        <ul class="list-unstyled team-members">
                            <style>
                                .noti:hover{
                                    background-color: silver;
                                }
                            </style>
                            <?php
                            $likenoti = LikeModel::get_notify_like($_SESSION['u_id']);
                            $comnoti = ComModel::get_notify_comment($_SESSION['u_id']);
                            $allnoty = array_merge($likenoti, $comnoti);
                            foreach ($allnoty as $u) {
//                                if ($u['u_id'] == $_SESSION['u_id']) {
//                                    continue;
//                                }
                                if (isset($u['comment'])) {
                                    $type = "comment";
                                    $Id=$u['com_id'];
                                } else {
                                    $type = "like";
                                    $Id=$u['l_id'];
                                }
                                ?>
                                <li>
                                    <div class="row noti">
                                        <a  href="index.php?rt=PostController/showPostForNotification&id=<?= $Id ?>&type=<?= $type ?>" style="color: black">
                                            <div class="col-lg-1 col-md-1 col-xs-12 col-sm-1">
                                                <div class="avatar">
                                                    <img src="<?= HostName . 'assets/img/' . $u['u_img_profile'] ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                                <?= $u['u_f_name'] . " " . $u['u_s_name'] ?>
                                                <br />
                                                <span class="text-muted"><small><?= $u['u_username'] ?></small></span>
                                                <span ><small><?php
                                                        if (isset($u['comment'])) {
                                                            echo date("d M H:i A", strtotime($u['com_datetime']));
                                                        } else {
                                                            echo date("d M H:i A", strtotime($u['like_datetime']));
                                                        }
                                                        ?></small></span>
                                            </div>
                                            <div class="col-lg-7 col-md-7 col-xs-12 col-sm-7">
                                                <h5><?php
                                                    if (isset($u['comment'])) {
                                                        echo 'Comment "' . $u['com_text'] . '" On Your Post';
                                                    } else {
                                                        echo 'This User Like Your Post';
                                                    }
                                                    ?></h5>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



