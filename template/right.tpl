<style>
    .card > .content > .footer > .chart-legend > a:hover{ text-decoration-line: underline ;}

    .modalDialog {
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.8);
        z-index: 99999;
        opacity:0;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        pointer-events: none;
    }
    .modalDialog:target {
        opacity:1;
        pointer-events: auto;
    }

    .modalDialog > div {
        width: 400px;
        /*
                        display: inline-block; 
                         overflow: auto;
                           position: relative;
                           margin: 10% 10% 10% 10% ;
                           padding:  5px 20px 13px 20px;
                           border-radius: 10px;
                           margin:10% auto;
                       display: inline-block;
        */
        border-radius: 10px;
        position: relative;
        margin:10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        background: #fdfdfd; //#fff;
        background: -moz-linear-gradient(#fdfdfd, #999);
        background: -webkit-linear-gradient(#fdfdfd, #999);
        background: -o-linear-gradient(#fdfdfd, #999);
    }
    .closee {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        right: -12px;
        text-align: center;
        top: -10px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }

    .closee:hover { background: #00d9ff; }
    -webkit-transition:opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;

</style>  
<div id="edit__post" class="modalDialog">
    <div >
        <a href="#" title="closelogin" class="closee">X</a>
        <div class="container"  style="max-height: 500px; overflow: auto">
            <div class="content">
                <form id="myFormPost_edit" method="post" action="index.php?rt=PostController/updatePost" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 col-lg-10">
                            <div class="form-group">
                                <input type="hidden" name="p_id_edit" id="p_id_edit" >
                                <textarea row="3" id="p_text_edit" name="p_text_edit" class="form-control border-input" placeholder="Here can be your description"></textarea>
                                <p id="p_text1_edit" class="text-center" ></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="file" id="imgPost_edit" name="imgPost_edit" style="display: none;">
                        <button type="submit" onclick="$('#imgPost_edit').trigger('click');
                                return false;" class="btn btn-default btn-fill btn-wd" ><i class="ti-image" ></i> Upload Photo</button>
                        <button type="button" onclick="updatePost()" class="btn btn-info btn-fill btn-wd">Update</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="login" class="modalDialog">
    <div >
        <a href="#" title="closelogin" class="closee">X</a>
        <div class="container"  style="max-height: 500px; overflow: auto">

            <div class="row">
                <div class="col-md-10 col-lg-10 col-xs-12 col-sm-10" >
                    <center style="padding: 10px" ><h5>All Comments </h5></center>
                    <!--<center> <h4 class="box-title"> All Comments </h4></center>-->
                    <div class="box-footer col-md-12 col-lg-12 col-xs-12 col-sm-12" >
                        <form action="?rt=PostController/addComment" method="post" id="formComment" onkeypress="return commentKeyPress(event, this);">
                            <div class="img-push">
                                <input type="text"  name="com_text" id="com_text" class="form-control border-input" placeholder="Write Your Comment ">
                                <p id="com_text1" class="text-center" ></p>
                            </div>
                        </form> 
                        <hr>
                    </div>
                    <div class="box-body" > </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4" id="chatBox"  style="display: none; z-index: 1; bottom: 0;position: fixed ">
        <!-- DIRECT CHAT -->
        <div class="box box-primary direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title" id="userchat"></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool"  data-toggle="collapse" data-target="#demo"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" onclick="$('#chatBox').hide()"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div  id="demo">
                <div class="box-body " >
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" id="msgs">

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <form action="#" id="msgform" method="post">
                        <div class="input-group">
                            <input type="text" name="message"  id="message" onkeypress="return msgKeyPress(event);" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-btn">
                                <button type="button" onclick=" sendmsg();" class="btn btn-warning btn-flat">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-footer-->
        </div>
        <!--/.direct-chat -->
    </div>

    <div class="col-md-3"  style=" z-index: 1; bottom: 0;right: 15px;position: fixed ">
        <!-- DIRECT CHAT -->
        <div class="box box-primary direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Friends</h3>

                <div class="box-tools pull-right">
                    <?php
                    $i = 0;
                    $recentUser = FriendsModel::get_my_friend();
                    foreach ($recentUser as $u) {
                    if ($u['u_id'] == $_SESSION['u_id']) {
                    continue;
                    }
                    $i+=1;
                    }
                    ?>
                    <span data-toggle="tooltip" class="badge bg-yellow"><?= $i ?></span>
                    <button type="button" class="btn btn-box-tool"  data-toggle="collapse" data-target="#fr"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="collapse"  id="fr">
                <div class="box-body " >
                    <?php
                    $recentUser = FriendsModel::get_my_friend();
                    foreach ($recentUser as $u) {
                    if ($u['u_id'] == $_SESSION['u_id']) {
                    continue;
                    }
                    ?>
                    <a href="#" onclick="addchat(<?= $u['u_id'] ?> , '<?= $u['u_f_name'] . " " . $u['u_s_name'] ?>')">
                        <div class="col-md-2">
                            <div class="avatar">
                                <img style="width: 50px" src="<?= HostName . 'assets/img/' . $u['u_img_profile'] ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <?= $u['u_f_name'] . " " . $u['u_s_name'] ?>
                            <br />
                            <span class="text-muted"><small><?= $u['u_username'] ?></small></span>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
            <!-- /.box-footer-->
        </div>
        <!--/.direct-chat -->
    </div>
</div>
<script>
    function sendmsg() {
        var text = $("#message").val();
        if (text == "") {
            alert("Write Something !...");
        } else {
            $.post("?rt=UserController/addmsg", {message: text}, function (res) {
                $('#msgs').append(res);
                $("#msgs").animate({scrollTop: $(document).height() * 2000}, "slow");
            });
            $("#message").val("");
            return false;
        }
    }

    function msgKeyPress(e) {
        // look for window.event in case event isn't passed in
        e = e || window.event;
        if (e.keyCode == 13)
        {
            var text = $("#message").val();
            if (text == "") {
                alert("Write Something !...");
            } else {
                $.post("?rt=UserController/addmsg", {message: text}, function (res) {
                    $('#msgs').append(res);
                    $("#msgs").animate({scrollTop: $(document).height() * 2000}, "slow");
                });
                $("#message").val("");
                return false;
            }
            return false;
        }
        return true;
    }

    function addchat(id, name) {
        $('#userchat').html(name);
        $.post("?rt=UserController/addchat", {u_id: id}, function (res) {
            $.post("?rt=UserController/get_msg_chat", {u_id: id}, function (ress) {
                $('#msgs').html(ress);
                $("#msgs").animate({scrollTop: $(document).height() * 2000}, "slow");
                $("#chatBox").show();
                updateMsg(res);
                setInterval(function () {
                    $.post("?rt=UserController/check_msg_chat", {u_id: id}, function (res) {
                        if (res == 11111) {
                            $.post("?rt=UserController/get_msg_chat", {u_id: id}, function (ress) {
                                $('#msgs').html(ress);
                                $("#chatBox").show();
                                $("#msgs").animate({scrollTop: $(document).height() * 2000}, "slow");
                            });
                        }
                    });
                }, 100);
            });
        });
    }
    function updateMsg(id) {
        $.post("?rt=UserController/updateMsg", {chat_id: id}, function (res) {
            //alert(res);
        });
    }


    setInterval(function () {
        $.post("?rt=UserController/getFrienRequest", function (count) {
            $("#request").html(count);
        });
        $.post("?rt=PostController/getNotify", function (res) {
            $("#request1").html(res);
        });
        $.post("?rt=UserController/get_un_readmsg", function (resd) {
            $("#request2").html(resd);
        });
    }, 100);
    function updatePost() {
        if (!$('#p_text_edit').val() || $('#p_text_edit').val() == " ") {
            $("#p_text1_edit").attr("class", "text-danger");
            $("#p_text1_edit").html(' must have a value');
        } else {
            $("#p_text1_edit").html('');
            $("#myFormPost_edit").submit();
        }
    }
    function editpost(p_id) {
        $.post("?rt=PostController/editpost", {p_id: p_id}, function (res) {
//            alert(res.split("|"));
            $("#p_id_edit").val(res.split("|")[0]);
            $("#p_text_edit").val(res.split("|")[1]);
            window.location.href = "#edit__post";
        });
    }

    function commentKeyPress(e, o) {
        e = e || window.event;
        if (e.keyCode == 13)
        {
            var com_text = $("#com_text").val();
            if (!$('#com_text').val() || $('#com_text').val() == " ") {
                $("#com_text1").attr("class", "text-danger");
                $("#com_text1").html(' must have a value');
            } else {
                $("#com_text1").html('');
                $.post("?rt=PostController/addComment", {com_text: com_text}, function (ress) {
                    o.reset();
                });
            }
            return false;
        }
        return true;
    }
    function showcomment(p_id) {
        $.post("?rt=PostController/getComment", {p_id: p_id}, function (res) {
            //alert(res);
            $(".box-body").html(res);
            window.location.href = "#login";
        });
    }
    function refreshcomment(p_id) {
        $.post("?rt=PostController/getComment", {p_id: p_id}, function (res) {
            //alert(res);
            $(".box-body").html(res);
        });
    }
    function delete_last_post() {
        var id = $("#p_last_id").val();
        deletePost(id);
    }

    function deletePost(id) {
        $.post('?rt=PostController/deletePost', {p_id: id}, function (res) {
            location.reload();
        });
    }
    function uploadimage(o) {
        var u_id = $("#u_id").val();
        $.ajax({
            url: "?rt=PostController/AddPost",
            type: "POST",
            data: new FormData(o),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data == 11111) {
                    o.reset();
                    $.post("?rt=PostController/GetPostData", {u_id: u_id}, function (res) {
                        $("#p_last_id").val(res.split("|")[0]);
                        $("#p_te").html(res.split("|")[1]);
                        if (res.split("|").length <= 4) {
                            $("#p_img").hide();
                        } else {
                            $("#p_img").attr("src", "<?= HostName . DS . 'assets/img/' ?>" + res.split("|")[5]); //html(res.split("|")[5]);
                        }
                        $("#lastPost").show();
                    });
                }
            },
        });
        return false;
    }
    function AddPost() {
        if (!$('#p_text').val() || $('#p_text').val() == " ") {
            $("#p_text1").attr("class", "text-danger");
            $("#p_text1").html(' must have a value');
        } else {
            $("#p_text1").html('');
            $("#myFormPost").submit();
        }
    }

    function addFriend(u_id1, u_id2) {
        $("#recentF").attr('class', 'active');
        $.post("?rt=UserController/addfriend", {user_id1: u_id1, user_id2: u_id2}, function (res) {
            window.location.href = 'index.php';
        });
    }
    function confirmFriend(u_id1) {
        $.post("?rt=UserController/confirmfriend", {user_id1: u_id1}, function (res) {
            window.location.href = 'index.php';
        });
    }
    function unFriend(u_id2) {
        $.post("?rt=UserController/unfriend", {user_id2: u_id2}, function (res) {
            window.location.href = 'index.php';
        });
    }


</script>
