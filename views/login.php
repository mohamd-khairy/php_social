<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Paper Login</title>

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

        <!--  Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">

    </head>
    <body>

        <div class="wrapper">
            <div class="main-panel" style="width: 100%">
                <div class="content" style="margin-top: 7%">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
                                <div class="card">
                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab"  class="nav nav-tabs bar_tabs" role="tablist">
                                            <li  class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Login</a>
                                            </li>
                                            <li  class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Sign Up</a>
                                            </li>

                                        </ul>
                                        <div id="myTabContent" class="tab-content">

                                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                <div class="header">
                                                    <h4 class="title" style="text-align: center" >Join To Us.</h4>
                                                </div>
                                                <div class="content">
                                                    <form id="myFormLogin" method="post" action="index.php?rt=HomePage/login">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Email address</label>
                                                                    <input type="text" name="user" id="user" class="form-control border-input" placeholder="Email">
                                                                    <p id="user1" class="text-center" ></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="password" name="password" id="password" class="form-control border-input" placeholder="Home Address" value="Melbourne, Australia">
                                                                    <p id="password1" class="text-center" ></p>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Remember Me</label>
                                                                    <input  type="checkbox" name="checkbox" id="checkbox" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Log in By Twitter</label>
                                                                    <a href="#" onclick=" window.location.href = 'index.php?rt=HomePage/socialLogin&social=twitter'" class="border-input form-control ">
                                                                        <div class=" icon-info text-center">
                                                                            <i class="ti-twitter-alt"></i></div>
                                                                    </a> 
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Log in By Facebook</label>
                                                                    <a href="#"  onclick=" window.location.href = 'index.php?rt=HomePage/socialLogin&social=facebook'" class="border-input form-control ">
                                                                        <div class=" icon-info text-center" style="color: #337ab7">
                                                                            <i class="ti-facebook"></i></div>
                                                                    </a> 
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Log in By Google</label>
                                                                    <a href="#"  onclick=" window.location.href = 'index.php?rt=HomePage/socialLogin&social=google'" class="border-input form-control ">
                                                                        <div class=" icon-info text-center" style="color: #e95e37">
                                                                            <i class="ti-google"></i></div>
                                                                    </a>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <input type="hidden" name="login" value="login" >
                                                            <button type="button" onclick="checkLogin()" class="btn btn-info btn-fill btn-wd">Login</button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                                <div class="header">
                                                    <h4 class="title" style="text-align: center" >Join To Us.</h4>
                                                </div>
                                                <div class="content">
                                                    <form id="myForm" action="index.php?rt=HomePage/AddUser" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" autofocus required class="form-control border-input" name="u_username" id="u_username" placeholder="@Username">
                                                                    <p id="u_username1" class="text-center" ></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>First Name</label>
                                                                    <input type="text" required class="form-control border-input" name="u_f_name" id="u_f_name" placeholder="First Name" >
                                                                    <p id="u_f_name1" class="text-center" ></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Last Name</label>
                                                                    <input type="text" required class="form-control border-input" name="u_s_name" id="u_s_name" placeholder="Last Name" >
                                                                    <p id="u_s_name1" class="text-center" ></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Email address</label>
                                                                    <input type="email" required class="form-control border-input" name="u_email" id="u_email" placeholder="Email">
                                                                    <p id="u_email1" class="text-center" ></p>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="password" required class="form-control border-input" name="u_password" id="u_password"  placeholder="Password" >
                                                                    <p id="u_password1" class="text-center" ></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Confirm Password</label>
                                                                    <input type="password" required class="form-control border-input" id="confirm_password"  placeholder="Confirm Password" >
                                                                    <p id="confirm_password1" class="text-center" ></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Gender</label>
                                                                    <select class="form-control border-input" name="u_gender">
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>                                                   
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <input type="text" required class="form-control border-input" name="u_city" id="u_city" placeholder="City" >
                                                                    <p id="u_city1" class="text-center" ></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <input type="text" required class="form-control border-input" name="u_country" id="u_country" placeholder="Country" >
                                                                    <p id="u_country1" class="text-center" ></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <input type="hidden" name="login" value="login" >
                                                            <button type="button" onclick="CheckUser()" class="btn btn-info btn-fill btn-wd">Sign Up</button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright center-block">
                            &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://know-me.ml">Mohamed Khairy</a>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
    </body>

    <script>
        function checkLogin() {
            //  checkLoginResult();
            if (checkLoginResult() != false) {
                  
                $("#myFormLogin").submit();
            }
        }
        function checkLoginResult() {
            var has_empty = false;
            $('#myFormLogin input').each(function (n, element) {
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
        function CheckUser() {
            if (CheckUse() != false) {
             
                $("#myForm").submit();
            }
        }
        function CheckUse() {
            var f = $("#u_f_name").val(), l = $("#u_s_name").val(), un = $("#u_username").val(),
                    em = $("#u_email").val(), p = $("#u_password").val(), cp = $("#confirm_password").val(),
                    c = $("#u_city").val(), cou = $("#u_country").val();

            $('#myForm input').each(function (n, element) {
                if ($(element).val() == '') {
                    $("#" + element.id + "1").attr("class", "text-danger");
                    $("#" + element.id + "1").html(' must have a value');
                    //alert('Field ' + element.id + ' must have a value');
                    return false;
                } else if (cp !== p) {
                    $("#confirm_password1").attr("class", "text-danger");
                    $("#confirm_password1").html('It Is Not Aconfirm Password');
                    return false;
                } else {
                    $("#" + element.id + "1").html('');
                }
            });
            var has_empty = false;
            $('#myForm input').each(function () {
                if (!$(this).val()) {
                    has_empty = true;
                    return false;
                }
            });
            if (has_empty) {
                return false;
            }
        }
    </script>
    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

</html>
