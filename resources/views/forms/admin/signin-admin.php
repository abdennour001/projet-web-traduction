<div class="container h-100">
    <div class="row align-items-center h-100">
        <div class="col-md-4 offset-md-4 col-sm-8 offset-sm-2">
            <form id="signInFormAdmin" method="post" action="<?php echo url('/admin/login/auth')?>">
                <div class="text-black-50 mb-5 text-center">
                    <h1>Admin login</h1>
                </div>

                <?php if (Session::has('error-sign-in-admin')) : ?>
                    <div class="alert alert-danger border-danger alert-dismissible fade show" role="alert">
                        <?php
                        echo Session::get('error-sign-in-admin');
                        Session::forget('error-sign-in-admin');
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="usernameSignIn">Username</label>
                    <input type="text" class="form-control" id="usernameSignIn" name="username" aria-describedby="usernameHelp" value="<?php echo old("username"); ?>" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input ignore" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <button id="signin" type="submit" class="btn btn-primary mt-3">Connexion</button>
            </form>
        </div>
    </div>

</div>
