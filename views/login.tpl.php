<?php include VIEWS . "/header.tpl.php"; ?>

<div class="flex-grow-1">
	<div class="container-lg">
        <form class="col-lg-6 offset-lg-3 py-4">
            <h1 class="py-3 fw-semibold">Login into account</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check d-flex justify-content-between">
                <div>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <a href="/register">Do not have an account ?</a>
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
        </form>
	</div>
</div>

<?php include VIEWS . "/footer.tpl.php"; ?>
