<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Paper Dashboard</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Paper Dashboard core CSS    -->
        <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/AdminLTE.min.css">

        <!--  Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">

    </head>
    <body >
        <?php $userSession = userModel::get_Data_by_id($_SESSION['u_id']); ?>
        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="danger">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="index.php" class="simple-text">

                            <?php
                            if (empty($userSession[0]['u_img_profile'])) {
                            $i = 'face.jpg';
                            } else {
                            $i = $userSession[0]['u_img_profile'];
                            }
                            ?>
                            <img class='img-circle' style="width: 70px" src="<?= HostName . DS . 'assets/img/' . $i ?>" >

                            <h6  class="title"><?= $userSession[0]['u_f_name'] . " " . $userSession[0]['u_s_name'] ?>
                            </h6>
                        </a>
                    </div>


                    <ul class="nav">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-xs-12 col-md-3 col-md-offset-2">
                                    <a href="?rt=PostController/shownotification"> <h5>
                                            <div id="request1" class="closee" style="margin-right: 30px">0</div>                                  
                                            <i class="ti-bell"></i>
                                        </h5></a>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <h5>
                                            <div id="request2" class="closee" style="margin-right: 30px">0</div>                                  
                                            <i class="ti-email"></i>
                                        </h5> 
                                    </a> 
                                    <ul class="dropdown-menu" >
                                        <?php
                                        $case1 = ChatModel::getAllDataby_key_and_value('u_id1', $_SESSION['u_id']);
                                        $case2 = ChatModel::getAllDataby_key_and_value('u_id2', $_SESSION['u_id']);
                                        $chats = array_merge($case1, $case2);
                                        foreach ($chats as $c) {
                                        $msgdata=MsgModel::get_un_readmsg($c['chat_id']);
                                        if (!empty($msgdata)) {
                                        $u=userModel::get_Data_by_id($msgdata[0]['u_id'])[0];
                                        ?>
                                        <li><a href="#" onclick="addchat(<?=$u['u_id']?>,'<?= $u['u_f_name'] . " " . $u['u_s_name'] ?>')">
                                                <?= $u['u_f_name'] . " " . $u['u_s_name'] ?>
                                                <br />
                                                <span class="text-muted"><small><?= $u['u_username'] ?></small></span>
                                            </a> </li>
                                        <?php } } ?>

                                    </ul>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <a href="?rt=UserController/showAllRequest">
                                        <h5 >
                                            <div id="request" class="closee" style="margin-right: 30px">0</div>                                  
                                            <i class="ti-user"></i>
                                        </h5>    </a>                
                                </div>
                            </div>
                        </div>
                        <hr>
                        <li id="home">
                            <a href="index.php" >
                                <i class="ti-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li id="profile">
                            <a href="?rt=HomePage/profile" >
                                <i class="ti-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li id="logout">
                            <a href="?rt=HomePage/logout" >
                                <i class="ti-lock"></i>
                                <p>Logout</p>
                            </a>
                        </li>

                    </ul>
                </div>

            </div>

            <div class="main-panel">
                <nav  class="navbar navbar-default" style=" width: 100%;position: fixed;">
                    <div class="container-fluid">
                        <div class="navbar-header pull-right">
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>

                        </div>
                        <form id="FormSearch" method="post" action="index.php?rt=HomePage/search"  class=" col-lg-12 col-md-12 col-sm-11 col-xs-8 pull-left">
                            <div  class="col-md-9 pull-left" style="padding-top: 15px">
                                <div class="form-group">
                                    <input type="text" name="q" onkeypress="return msgKeyPress(event);" class="form-control border-input" placeholder="Search By UserName">
                                    <a href="#" onclick="$('#FormSearch').submit()"  style="width:auto;border-color: white; background-color: white; margin-top: -30px;margin-right: 15px" class="pull-right">
                                        <i class="ti-search"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <div class="collapse navbar-collapse" >
                        </div>
                    </div>

                </nav>

                <script>
                    function msgKeyPress(e) {
                        e = e || window.event;
                        if (e.keyCode == 13)
                        {
                            $('#FormSearch').submit();
                        }
                        return true;
                    }
                </script>
