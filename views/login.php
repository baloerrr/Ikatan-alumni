<section class="vh-100 bg-light">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 ">
                        <form method="post" action="/login">
                            <h3 class="mb-5 text-center">Sign in</h3>

                            <div class="form-floating mb-4">
                                <input type="text" id="username" name="username" class="form-control form-control-lg" />
                                <label class="form-label" for="username">Username</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="form-floating mb-4 text-center">
                                <button class="btn btn-primary btn-lg btn-block text-center" type="submit">Login</button>
                            </div>

                            <p class="mb-2" style="color: #393f81;">Belum punya akun? <a href="./register" style="color: #393f81;">Daftar</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>