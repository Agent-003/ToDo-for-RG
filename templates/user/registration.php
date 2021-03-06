<div class="container">
    <div class="py-5 text-center">
        <h2>Create new user</h2>
    </div>
</div>

<div class="container">
    <form action="../user/actionRegister" method="post">
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Your e-mail">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control"
                       id="inputPassword" placeholder="Password">
            </div>
        </div>
        <div class="form-group row">
            <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm password</label>
            <div class="col-sm-10">
                <input type="password" name="confirm-password" class="form-control"
                       id="confirmPassword" placeholder="Confirm Password">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-5 text-right">
                <input type="button" class="btn btn-primary" name="register" id="register" value="Registration">
            </div>
            <p class="col-2 text-center">OR</p>
            <div class="col-5 text-left">
                <a class="btn btn-secondary" href="/user/login" role="button"> Sing In <i class="fa fa-sign-in"
                                                                                          aria-hidden="true"></i></a>
            </div>
        </div>

    </form>
</div>