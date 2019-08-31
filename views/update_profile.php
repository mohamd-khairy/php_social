<?php
// $UserId the id of the user profile use it 
$ProfileBox = userModel::get_Data_by_id($_GET['id']);
//                    print_r($ProfileBox);
if (empty($ProfileBox) || ( $_GET['id'] != $_SESSION['u_id'])) {
    die();
}
?>
<div class="content" style="margin-top: 6%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 pull-right">
                <div class="card card-user">

                    <div class="image">
                        <?php
                        if (empty($ProfileBox[0]['u_img_cover'])) {
                            $i = 'background.jpg';
                        } else {
                            $i = $ProfileBox[0]['u_img_cover'];
                        }
                        ?>
                        <img src="<?= HostName . DS . "assets/img/" . $i ?>" />
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
                                                <btn class="btn btn-sm btn-success btn-icon" title="Add Friend"><i class="fa fa-user"></i></btn>
                                            </div></a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 pull-left">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <form id="myFormProfile" method="post" action="index.php?rt=HomePage/UpdateProfileUser" enctype="multipart/form-data">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" name="u_email" id="u_email" class="form-control border-input" placeholder="Email" value="<?= $ProfileBox[0]['u_email'] ?>">
                                        <p id="u_email1" class="text-center" ></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="u_password" id="u_password" class="form-control border-input"  placeholder="Password" value="<?= $ProfileBox[0]['u_password'] ?>">
                                        <p id="u_password1" class="text-center" ></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="u_username" id="u_username" class="form-control border-input" placeholder="Username" value="<?= $ProfileBox[0]['u_username'] ?>">
                                        <p id="u_username1" class="text-center" ></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="u_f_name" id="u_f_name" class="form-control border-input" placeholder="First Name" value="<?= $ProfileBox[0]['u_f_name'] ?>">
                                        <p id="u_f_name1" class="text-center" ></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="u_s_name" id="u_s_name" class="form-control border-input" placeholder="Last Name" value="<?= $ProfileBox[0]['u_s_name'] ?>">
                                        <p id="u_s_name1" class="text-center" ></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="u_city" id="u_city" class="form-control border-input" placeholder="City" value="<?= $ProfileBox[0]['u_city'] ?>">
                                        <p id="u_city1" class="text-center" ></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="u_country" id="u_country" class="form-control border-input" placeholder="Country" value="<?= $ProfileBox[0]['u_country'] ?>">
                                        <p id="u_country1" class="text-center" ></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me</label>
                                        <textarea rows="5" name="u_bio" id="u_bio"  class="form-control border-input"><?= $ProfileBox[0]['u_bio'] ?></textarea>
                                        <p id="u_bio1" class="text-center" ></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label >Background Image</label>
                                        <input type="file"  id="img" name="img" style="display: none;">
                                        <a href="#" onclick="$('#img').trigger('click');
                                                return false;">
                                            <img src="<?= HostName . '/assets/img/img.png' ?>" width="65px" height="65px"></a>                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <?php
                                    if (empty($ProfileBox[0]['u_img_cover'])) {
                                        $i = 'background.jpg';
                                    } else {
                                        $i = $ProfileBox[0]['u_img_cover'];
                                    }
                                    ?>
                                    <img id="u_profile" src="<?= HostName . '/assets/img/' . $i ?>" style="width:100%;height:150px"/>

                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User Image</label>
                                        <input type="file" id="p_image" name="p_image" style="display: none;">
                                        <a href="#" onclick="$('#p_image').trigger('click');
                                                return false;" >
                                            <img  src="<?= HostName . '/assets/img/img.png' ?>" width="55px" height="65px"></a>
                                    </div>
                                </div>
                                <div class=" col-md-6">
                                    <?php
                                    if (empty($ProfileBox[0]['u_img_profile'])) {
                                        $i = 'face.jpg';
                                    } else {
                                        $i = $ProfileBox[0]['u_img_profile'];
                                    }
                                    ?>
                                    <img id="u_img" src="<?= HostName . '/assets/img/' . $i ?>"  class="avatar border-white" style="width:100px;height:90px" alt="..." />
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="id_edit" value="<?= $ProfileBox[0]['u_id'] ?>">
                                <button type="button" onclick="CheckUserProfile()" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function CheckUserProfile() {
        if (CheckU() != false) {
            $("#myFormProfile").submit();
        }
    }
    function CheckU() {
        var has_empty = false;
        $('#myFormProfile input[type=text]').each(function (n, element) {
            if (!$(element).val()) {
                $("#" + element.id + "1").attr("class", "text-danger");
                $("#" + element.id + "1").html(' must have a value');
                has_empty = true;
                return false;
            } else {
                $("#" + element.id + "1").html('');
            }
        });
        if (has_empty) {
            return false;
        }
    }
    window.onload = function () {
        $("#profile").attr('class', 'active');
        function readURL(input, inp) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(inp).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#p_image").change(function () {
            readURL(this, '#u_img');
        });
        $("#img").change(function () {
            readURL(this, '#u_profile');
        });
    }

</script>