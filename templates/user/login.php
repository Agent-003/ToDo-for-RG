<div class="container">
    <div class="py-5 text-center">
        <h2>SIMPLE TODO LISTS</h2>
        <p class="lead">FROM RUBY GARAGE</p>
    </div>
</div>
<div class="container">
    <!--    <div class="row">-->
    <form action="../user/actionLogin" method="post">
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-5 text-right">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
            <p class="col-2 text-center">OR</p>
            <div class="col-5 text-left">
                <a class="btn btn-secondary" href="/user/registration" role="button">Registration</a>
            </div>
        </div>
    </form>
</div>