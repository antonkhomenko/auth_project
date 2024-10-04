<?php include VIEWS . "/header.tpl.php"; ?>

<div class="flex-grow-1">
	<div class="container-lg">
        <form class="col-lg-6 offset-lg-3 py-4">
            <h1 class="py-3 fw-semibold">Registration</h1>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col-md-6">
                    <label for="passwordConfirmation" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="passwordConfirmation">
                </div>
            </div>
            <div class="mb-3">
                <div>
                    <label for="avatar" class="form-label">Choose your profile picture</label>

                </div>
                <div class="d-flex justify-content-between px-2">
                    <div class="default_avatar_container">
                        <input type="radio" class="btn-check" name="avatar" autocomplete="off" id="default_avatar1">
                        <label for="default_avatar1" class="default_avatar_label bg-secondary-subtle">
                            <img src="/assets/profile-pics/profile-pic1.svg" alt="profile-pic" class="default_avatar_img">
                        </label>
                    </div>
                    <div class="default_avatar_container">
                        <input type="radio" class="btn-check" name="avatar" autocomplete="off" id="default_avatar2">
                        <label for="default_avatar2" class="default_avatar_label bg-secondary-subtle">
                            <img src="/assets/profile-pics/profile-pic2.svg" alt="profile-pic" class="default_avatar_img">
                        </label>
                    </div>
                    <div class="default_avatar_container">
                        <input type="radio" class="btn-check" name="avatar" autocomplete="off" id="default_avatar3">
                        <label for="default_avatar3" class="default_avatar_label bg-secondary-subtle">
                            <img src="/assets/profile-pics/profile-pic3.svg" alt="profile-pic" class="default_avatar_img">
                        </label>
                    </div>
                </div>

<!--                <input type="file" class="form-control" id="avatar">-->
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
	</div>
</div>

<?php include VIEWS . "/footer.tpl.php"; ?>
