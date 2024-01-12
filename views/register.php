<section class="">
    <div class="px-4 py-5 px-md-5 text-center text-lg-start min-vh-100" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        The best offer <br />
                        <span class="text-primary">for your business</span>
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                        quibusdam tempora at cupiditate quis eum maiores libero
                        veritatis? Dicta facilis sint aliquid ipsum atque?
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <form action="/register" method="post" enctype="multipart/form-data">
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="nama" name="nama" class="form-control" />
                                            <label class="form-label" for="form3Example1">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="username" name="username" class="form-control" />
                                            <label class="form-label" for="form3Example2">Username</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="form-floating mb-4">
                                    <input type="number" id="nisn" name="nisn" class="form-control" />
                                    <label class="form-label" for="form3Example3">NISN</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-floating mb-4">
                                    <input type="password" id="password" name="password" class="form-control" />
                                    <label class="form-label" for="form3Example4">Password</label>
                                </div>

                                <div class="mb-4">
                                    <label for="formFile" class="form-label">Foto</label>
                                    <input class="form-control" type="file" name="foto" id="formFile">
                                </div>
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Sign up
                                </button>

                                <p class="mb-2" style="color: #393f81;">sudah punya akun? <a href="./login" style="color: #393f81;">Masuk</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>