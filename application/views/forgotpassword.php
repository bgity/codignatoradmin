<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Login</title>
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>resources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="<?= base_url() ?>resources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?= base_url() ?>resources/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Plugin CSS -->
    <link href="<?= base_url() ?>resources/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?= base_url() ?>resources/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?= base_url() ?>resources/css/custom.css" rel="stylesheet">
    <style>
    h2 {
        color: white;
    }

    p {
        color: red;
    }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Paaword?</h1>
                                        <p></p>
                                    </div>
                                    <form action="" name="forgetPsd" class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" placeholder="username"
                                                class="form-control form-control-user" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" placeholder="password"
                                                class="form-control form-control-user" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirmpassword" id="confirmpassword"
                                                placeholder="confirm password" class="form-control form-control-user" />
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Reset
                                            Password</button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url() ?>login">Already have an account?
                                            Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='loading' style='display:none'></div>
    <script src="<?= base_url() ?>resources/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>resources/vendor/tether/tether.min.js"></script>
    <script src="<?= base_url() ?>resources/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>resources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>resources/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>resources/js/sb-admin-2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
    // Wait for the DOM to be ready
    $(function() {
        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $("form[name='forgetPsd']").validate({
            rules: {
                password: "required",
                username: "required",
                confirmpassword: {
                    equalTo: "#password"
                }
            },
            messages: {
                password: " Enter Password",
                confirmpassword: " Enter Confirm Password Same as Password",
                username: "Enter Username"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: "<?php echo base_url() ?>forgotpassword/resetpassword",
                    type: "POST",
                    data: $(form).serialize(),
                    beforeSend: function() {
                        $('.loading').show();
                    },
                    success: function(response) {
                        if (response == 1) {
                            setTimeout(function() {
                                $('.loading').hide();
                                window.location.href =
                                    '<?= base_url() ?>';
                            }, 2000)

                        } else if (response == 2) {
                            alert("Wrong Username Please try again!")
                        }
                    }
                });
            }
        });
    });
    </script>

</body>

</html>