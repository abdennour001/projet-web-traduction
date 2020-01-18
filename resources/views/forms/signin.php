<form id="signInForm" method="post" action="<?php echo url('/login/auth')?>">
    <div class="text-black-50 mb-4 text-center">
        <h1>Connexion</h1>
    </div>

    <?php if (Session::has('error-sign-in')) : ?>
        <div class="alert alert-danger border-danger">
            <?php
                echo Session::get('error-sign-in');
                Session::forget('error-sign-in');
            ?>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="emailSignIn">Email</label>
        <input type="email" class="form-control" id="emailSignIn" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input ignore" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Connexion</button>
</form>
