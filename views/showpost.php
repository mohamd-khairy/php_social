<input type="hidden" id="type" value="<?=$type?>">
<input type="hidden" id="post_id" value="<?=$post_id?>">
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
                    <?php
                    $posts = PostModel::getAllDataby_key_and_value('p_id', $post_id);
                    foreach ($posts as $post) {
                        $user = userModel::get_Data_by_id($post['u_id']);
                        $imgpost = ImgPostModel::getAllDataby_key_and_value('p_id', $post['p_id']);
                        ?>
                        <div class="header">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="avatar">
                                        <img src="<?= HostName . DS . 'assets/img/' . $user[0]['u_img_profile'] ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <h4 class="title"><?= $user[0]['u_f_name'] . " " . $user[0]['u_s_name'] ?></h4>                                                       
                                    <a href="?rt=HomePage/profile&id=<?= $user[0]['u_id'] ?>"><p class="category"><?= $user[0]['u_username'] ?></p>   </a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <p class="text-center"><?= $post['p_text'] ?> </p>
                            <?php foreach ($imgpost as $img) { ?>
                                <img src="<?= HostName . DS . 'assets/img/' . $img['imgpost'] ?>"  style="width: 100%"/>
                            <?php } ?>
                            <div class="footer">
                                <hr>
                                <div class="chart-legend" >
                                    <?php
                                    $checkLike = LikeModel::get_data_by_two_value('u_id', $_SESSION['u_id'], 'p_id', $post['p_id']);
                                    if (!empty($checkLike)) {
                                        ?>
                                        <i id="l" class="fa ti-thumb-down text-info"></i> <a href="#" id="l2" onclick="unlike(<?= $post['p_id'] ?>)" style="color: black;">Unlike</a>
                                    <?php } else { ?>
                                        <i id="l" class="fa ti-thumb-up text-info"></i> <a href="#" id="l2" onclick="addlike(<?= $post['p_id'] ?>)" style="color: black;">Like</a>
                                    <?php } ?>                                    <i class="fa fa-circle text-danger"></i> <a href="#login" onclick="showcomment(<?= $post['p_id'] ?>), window.setInterval('refreshcomment(<?= $post['p_id'] ?>)', 1000);" style="color: black">Comment</a>
                                    <i class="fa fa-circle text-warning"></i> <a href="#" style="color: black">Share</a>
                                </div><br>
                                <div class="stats">
                                    <i class="ti-timer"></i>At <?= date(" d M Y h:m A ", strtotime($post['p_datetime'])) ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="header">
                        <h4 class="title">Who Like This Post .</h4>
                    </div>
                    <div class="content">
                        <ul class="list-unstyled team-members">
                            <?php
                            if ($type == 'like') {
                                $all_like_user = LikeModel::getAllData_like_user($post_id);
                                foreach ($all_like_user as $u) {
                                    ?>
                                    <li>
                                        <div class="row">
                                            <a href="index.php?rt=HomePage/search&id=<?= $u['u_id'] ?>" style="color: black">  <div class="col-xs-3">
                                                    <div class="avatar">
                                                        <img src="<?= HostName . 'assets/img/' . $u['u_img_profile'] ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <?= $u['u_f_name'] . " " . $u['u_s_name'] ?>
                                                    <br />
                                                    <span class="text-muted"><small><?= $u['u_username'] ?></small></span>
                                                </div></a>

                                            <a href="#"><div class="col-xs-3 text-right">
                                                    <?php
                                                    if ($u['u_id'] != $_SESSION['u_id']) {
                                                        $check = FriendsModel::checkFriend($_SESSION['u_id'], $u['u_id']);
                                                        if (!empty($check)) {
                                                            if ($check[0]['role'] == 0 && $check[0]['user_id1'] == $_SESSION['u_id']) {
                                                                ?>
                                                                <button  onclick="unFriend(<?= $u['u_id'] ?>)" class=" active btn btn-sm btn-success btn-icon" title="Cancel Request"><i class="fa fa-user"></i></button>
                                                                <?php
                                                            } else if ($check[0]['role'] == 0 && $check[0]['user_id2'] == $_SESSION['u_id']) {
                                                                ?>
                                                                <button onclick="confirmFriend(<?= $u['u_id'] ?>)"  class="active btn btn-sm btn-success btn-icon" title="Confirm Request"><i class="fa fa-user"></i></button>
                                                            <?php } else { ?>
                                                                <button onclick="unFriend(<?= $u['u_id'] ?>)" class="active btn btn-sm btn-success btn-icon" title="Un Friend"><i class="fa fa-user"></i></button>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <button onclick="addFriend(<?= $_SESSION['u_id'] ?>,<?= $u['u_id'] ?>)" class="btn btn-sm btn-success btn-icon" title="Add Friend"><i class="fa fa-user"></i></button>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                </div></a>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    window.onload = function () {
        $("#profile").attr('class', 'active');
        if($("#type").val()== "comment"){
         showcomment($("#post_id").val());   
        }
    }

    function addlike(p_id) {
        $.post("?rt=PostController/addlike", {p_id: p_id}, function (res) {
            $("#l").attr("class", 'fa ti-thumb-down text-info');
            $("#l2").attr("onclick", "unlike(<?= $post['p_id'] ?>)");
            $("#l2").html("Unlike");
        });
    }
    function unlike(p_id) {
        $.post("?rt=PostController/unlike", {p_id: p_id}, function (res) {
            $("#l").attr("class", 'fa ti-thumb-up text-info');
            $("#l2").attr("onclick", "addlike(<?= $post['p_id'] ?>)");
            $("#l2").html("Like");
        });
    }

</script>