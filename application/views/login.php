<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div id="login-page" class="row">
        <h1 style="text-align: center; color: white">Login Page</h1>
        <div class="col s12 z-depth-6 card-panel">
            <?php if ($this->session->flashdata('message')) : ?>
                <div class="msg msg-error" role="alert">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>
            <form class="login-form" method="POST" action="<?php echo base_url('Auth/login') ?>">
                <div class="row">
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input name="username" id="username" type="text" tabindex="1" required>
                        <label for="username" data-error="wrong" data-success="right">Username</label>
                        <!-- <div class="invalid-feedback">
                            Masukkan Username kamu
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="password" type="password" name="password" tabindex="2" required>
                        <label for="password">Password</label>
                        <!-- <div class="invalid-feedback">
                            Masukkan Password kamu
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12 login-text">
                        <label for="remember-me">
                            <input type="checkbox" id="remember-me" />
                            <span> Remember me </span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button href="#" class="btn waves-effect waves-light col s12">Login</button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p class="margin medium-small"><a href="#">Register Now!</a></p>
                    </div>
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small"><a href="#">Forgot password?</a></p>
                    </div>
                </div>

            </form>
        </div>
    </div>



    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>