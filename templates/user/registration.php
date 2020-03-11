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
            <div class="form-group row text-center">
                <div class="col-sm-10 offset-sm-2">
                    <input type="button" class="btn btn-primary" name="register" id="register" value="Registration">
                </div>
            </div>
        </form>
    </div>