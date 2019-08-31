
<input type="hidden" id="u_id" value="<?= $_SESSION['u_id'] ?>">
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
                            <img class="avatar border-white" src="<?= HostName . DS . "assets/img/" . $i ?>"/>
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
                                <h5><?= count(PostModel::getAllDataby_key_and_value('u_id', $ProfileBox[0]['u_id'])) ?><br /><small>Posts</small></h5>
                            </div>
                            <div class="col-md-4"><?php
                                $friends1 = FriendsModel::getFriend1($_SESSION['u_id']);
                                $friends2 = FriendsModel::getFriend2($_SESSION['u_id']);
                                $allFriend = array_merge($friends1, $friends2);
                                ?>
                                <h5><?= count($allFriend) ?><br /><small>Friends</small></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>24,100<br /><small>Following</small></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Recent Members</h4>
                    </div>
                    <div class="content">
                        <ul class="list-unstyled team-members">
                            <?php
                            $recentUser = userModel::getAll_limit(0, 5);
                            foreach ($recentUser as $u) {
                                if ($u['u_id'] == $_SESSION['u_id']) {
                                    continue;
                                }
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
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xs-12 col-md-12 col-sm-12 pull-left" >
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <?php $userSession = userModel::get_Data_by_id($_SESSION['u_id']); ?>
                            <div class="col-xs-4">
                                <div class="avatar">
                                    <?php
                                    if (empty($userSession[0]['u_img_profile'])) {
                                        $i = 'face.jpg';
                                    } else {
                                        $i = $userSession[0]['u_img_profile'];
                                    }
                                    ?>
                                    <img src="<?= HostName . DS . 'assets/img/' . $i ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <h4  class="title"><?= $userSession[0]['u_f_name'] . " " . $userSession[0]['u_s_name'] ?><br />
                                    <a  href="?rt=HomePage/profile&id=<?= $userSession[0]['u_id'] ?>"><small><?= $userSession[0]['u_username'] ?></small></a>
                                </h4>   
                            </div>
                            <div class="col-xs-2 text-right">
                                <a  href="#" class="btn btn-sm btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                </ul>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="content">
                        <form id="myFormPost" onsubmit="return uploadimage(this)" method="post" action="index.php?rt=PostController/AddPost" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea row="3" id="p_text" name="p_text" class="form-control border-input" placeholder="Here can be your description"></textarea>
                                        <p id="p_text1" class="text-center" ></p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="file" id="imgPost" name="imgPost[]" style="display: none;">
                                <button type="submit" onclick="$('#imgPost').trigger('click');
                                        return false;" class="btn btn-default btn-fill btn-wd" ><i class="ti-image" ></i> Upload Photo</button>
                                <button type="button" onclick="AddPost()" class="btn btn-info btn-fill btn-wd">Post</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="new" style="display: none" class=" col-sm-12 col-xs-12 col-lg-8  col-md-12 pull-left">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="text-center">
                                <a href="index.php" type="submit"  class="btn btn-default  btn-wd"> <div id="newpost"><i class="ti-pencil-alt" ></i></div></a>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 pull-left" id="lastPost" style="display: none">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <?php $userSession = userModel::get_Data_by_id($_SESSION['u_id']); ?>
                            <div class="col-xs-4">
                                <div class="avatar">
                                    <?php
                                    if (empty($userSession[0]['u_img_profile'])) {
                                        $i = 'face.jpg';
                                    } else {
                                        $i = $userSession[0]['u_img_profile'];
                                    }
                                    ?>
                                    <img src="<?= HostName . DS . "assets/img/" . $i ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <h4  class="title"><?= $userSession[0]['u_f_name'] . " " . $userSession[0]['u_s_name'] ?><br />
                                    <a  href="?rt=HomePage/profile&id=<?= $userSession[0]['u_id'] ?>"><small><?= $userSession[0]['u_username'] ?></small></a>
                                </h4>   
                            </div>
                            <div class="col-xs-2 text-right">
                                <a  href="#" class="btn btn-sm btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"onclick="location.reload()">Edit</a></li>
                                    <li><a href="#" onclick="delete_last_post()">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <p id="p_te" class="text-center"></p>
                        <img id="p_img"  style="width: 100%"/>
                        <form id="last_post" method="post" action="index.php?rt=PostController/like_last_post">
                            <input type="hidden" name="p_last_id" id="p_last_id" >
                        </form>
                        <div class="footer">
                            <hr>
                            <div class="chart-legend" >
                                <i id="ls" class="fa fa-circle text-info"></i> <a onclick="$('#last_post').submit()" id="ls2" href="#" style="color: black;">Like</a>
                                <i class="fa fa-circle text-danger"></i> <a href="#login" style="color: black">Comment</a>
                                <i class="fa fa-circle text-warning"></i> <a href="#" style="color: black">Share</a>

                            </div><br>
                            <div class="stats">
                                <i class="ti-timer"></i> Just Now
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $friends[] = array("user" => $_SESSION['u_id']);
            $friends1 = FriendsModel::getFriend1($_SESSION['u_id']);
            $friends2 = FriendsModel::getFriend2($_SESSION['u_id']);
            $allFriend = array_merge($friends, $friends1, $friends2);
//            print_r($allFriend);
            $posts = PostModel::getAllData_By_reverse();
            foreach ($posts as $post) {
                foreach ($allFriend as $af) {
                    if ($af['user'] == $post['u_id']) {
                        $user = userModel::get_Data_by_id($post['u_id']);
                        $imgpost = ImgPostModel::getAllDataby_key_and_value('p_id', $post['p_id']);
                        ?>

                        <div class="col-lg-8 col-xs-12 col-md-12 col-sm-12 pull-left">
                            <div class="card">
                                <div class="header">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="avatar">
                                                <img src="<?= HostName . DS . 'assets/img/' . $user[0]['u_img_profile'] ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <h4 class="title"><?= $user[0]['u_f_name'] . " " . $user[0]['u_s_name'] ?></h4>                                                       
                                            <a href="?rt=HomePage/profile&id=<?= $user[0]['u_id'] ?>"> <p class="category"><?= $user[0]['u_username'] ?></p>   </a>
                                        </div>
                                        <?php if ($user[0]['u_id'] == $_SESSION['u_id']) { ?>
                                            <div class="col-xs-2 text-right">
                                                <a  href="#" class="btn btn-sm btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" onclick="editpost(<?= $post['p_id'] ?>)">Edit</a></li>
                                                    <li><a href="#" onclick="deletePost(<?= $post['p_id'] ?>)">Delete</a></li>
                                                </ul>
                                            </div><?php } ?>
                                    </div>
                                </div>

                                <div class="content" >
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
                                            <?php } ?>
                                            <i class="fa fa-circle text-danger"></i> <a href="#login" onclick="showcomment(<?= $post['p_id'] ?>), window.setInterval('refreshcomment(<?= $post['p_id'] ?>)', 1000);" style="color: black">Comment</a>
                                            <i class="fa fa-circle text-warning"></i> <a href="#" style="color: black">Share</a>
                                        </div><br>
                                        <div class="stats">
                                            <a href="?rt=PostController/showpost&id=<?= $post['p_id'] ?>">   <i class="ti-timer"></i>At <?= date(" d M Y h:m A ", strtotime($post['p_datetime'])) ?>
                                            </a> </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>

    </div>

</div>

<script>


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

    window.onload = function () {
        $("#home").attr('class', 'active');
        var x = new Date();
        var x1 = (x.getHours() - 1) + ":" + x.getMinutes() + ":" + x.getSeconds();
        setInterval(function () {
            $.post("?rt=PostController/getNewPosts", {time: x1}, function (count) {
                if (count > 0) {
                    $("#newpost").html(count + " new posts");
                    $("#new").show();
                }
            });
        }, 5000);

    }

</script>



