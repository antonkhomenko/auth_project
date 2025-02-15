<?php
include VIEWS . "/incs/header.tpl.php";

/**
 * @var array $default_values;
 */

$profile_pics_data = array(
	"profile-pic1.svg" => "/assets/profile-pics/profile-pic1.svg",
	"profile-pic2.svg" => "/assets/profile-pics/profile-pic2.svg",
	"profile-pic3.svg" => "/assets/profile-pics/profile-pic3.svg",
	"profile-pic4.svg" => "/assets/profile-pics/profile-pic4.svg",
);

$avatar_mode = array(
	'default_mode' => 'Choose from standard',
	'custom_mode' => 'Choose from file',
);

?>
<div class="flex-grow-1">
	<div class="container-lg">
        <?php get_alert(); ?>
        <form class="col-lg-6 offset-lg-3 py-4" method="post" enctype="multipart/form-data" action="/register">
            <h1 class="py-3 fw-semibold">Registration</h1>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                        type="text" class="form-control <?= isset($error['username']) ? 'is-invalid' : '' ?>" id="username"
                        name="username" aria-describedby="usernameFeedback" placeholder="Enter your username"
                        value="<?= isset($default_values['username']) ? h($default_values['username']) : ''; ?>"
                >
                <div class="invalid-feedback" id="usernameFeedback">
                    <?= $error['username']; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input
                        type="email" class="form-control <?= isset($error['email']) ? 'is-invalid' : '' ?>"
                        id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your email"
                        value="<?= isset($default_values['email']) ? h($default_values['email']) : ''; ?>"
                >
                <div id="emailHelp" class="<?= isset($error['email']) ? "invalid-feedback" : "form-text" ?>">
                    <?= $error['email'] ?? "We'll never share your email with anyone else." ?>
                </div>
            </div>
            <div class="mb-3 d-flex flex-column gap-2">
                <div class="input-group <?= isset($error['avatar']) ? 'is-invalid' : '' ?>" aria-describedby="avatarFeedback">
                    <span class="input-group-text">Choose your profile picture</span>
                    <select id="avatar_mode_selector" class="form-select form-select-sm" name="avatar_mode_selector">
                        <?php foreach($avatar_mode as $mode => $title): ?>
                            <option
                                    value="<?= $mode ?>"
                                    <?= (isset($default_values['avatar_mode_selector']) and $default_values['avatar_mode_selector'] == $mode) ? 'selected' : '' ?>
                            ><?= $title ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-flex justify-content-between px-2 mt-2" id="default_avatar_selector">
                    <?php $i = 1; foreach($profile_pics_data as $key => $value): ?>
                        <div class="default_avatar_container">
                            <?php if (isset($default_values['avatar']) and $default_values['avatar'] == $value ): ?>
                                <input type="radio" class="btn-check" name="avatar" value="<?= $key; ?>" autocomplete="off" id="<?= "default-avatar" . $i ?>" checked>
                            <?php else: ?>
                                <input type="radio" class="btn-check" name="avatar" value="<?= $key; ?>" autocomplete="off" id="<?= "default-avatar" . $i ?>">
                            <?php endif; ?>
                            <label for="<?= "default-avatar" . $i++ ?>" class="default_avatar_label bg-secondary-subtle">
                                <img src="<?= $value; ?>" alt="profile-pic" class="default_avatar_img">
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <input type="file" class="form-control" id="custom_avatar" name="avatar" style="display: none">

<!--                Prev_avatar-->
	            <?php if (isset($default_values['avatar']) and $default_values['avatar_mode_selector'] === 'custom_mode'): ?>
                    <div class="custom-profile-pic">
                        <img src="<?= "/assets/profile-pics/custom_mode/" . basename($default_values['avatar']); ?>" alt="profile-pic">
                    </div>
                    <input type="hidden" value="<?= "/assets/profile-pics/custom_mode/" . basename($default_values['avatar']) ?>" name="prev_avatar">
	            <?php endif; ?>
<!--                End of prev_avatar-->

                <div class="invalid-feedback" id="avatarFeedback">
                    <?= $error['avatar'] ?>
                </div>
            </div>
            <div class="mb-4 row gap-2 gap-md-0">
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-container is-invalid">
                        <input type="password" class="password-input" id="password" name="password" placeholder="Enter your password">
                        <button type="button" class="password-mode-btn">
                            <svg class="hide_pass_svg" fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M2.21967 2.21967C1.9534 2.48594 1.9292 2.9026 2.14705 3.19621L2.21967 3.28033L6.25424 7.3149C4.33225 8.66437 2.89577 10.6799 2.29888 13.0644C2.1983 13.4662 2.4425 13.8735 2.84431 13.9741C3.24613 14.0746 3.6534 13.8305 3.75399 13.4286C4.28346 11.3135 5.59112 9.53947 7.33416 8.39452L9.14379 10.2043C8.43628 10.9258 8 11.9143 8 13.0046C8 15.2138 9.79086 17.0046 12 17.0046C13.0904 17.0046 14.0788 16.5683 14.8004 15.8608L20.7197 21.7803C21.0126 22.0732 21.4874 22.0732 21.7803 21.7803C22.0466 21.5141 22.0708 21.0974 21.8529 20.8038L21.7803 20.7197L15.6668 14.6055L15.668 14.604L8.71877 7.65782L8.72 7.656L7.58672 6.52549L3.28033 2.21967C2.98744 1.92678 2.51256 1.92678 2.21967 2.21967ZM12 5.5C10.9997 5.5 10.0291 5.64807 9.11109 5.925L10.3481 7.16119C10.8839 7.05532 11.4364 7 12 7C15.9231 7 19.3099 9.68026 20.2471 13.4332C20.3475 13.835 20.7546 14.0794 21.1565 13.9791C21.5584 13.8787 21.8028 13.4716 21.7024 13.0697C20.5994 8.65272 16.6155 5.5 12 5.5ZM12.1947 9.00928L15.996 12.81C15.8942 10.7531 14.2472 9.10764 12.1947 9.00928Z" fill="currentColor"/></svg>
                            <svg class="show_pass_svg" fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M12 9.00462C14.2091 9.00462 16 10.7955 16 13.0046C16 15.2138 14.2091 17.0046 12 17.0046C9.79086 17.0046 8 15.2138 8 13.0046C8 10.7955 9.79086 9.00462 12 9.00462ZM12 5.5C16.6135 5.5 20.5961 8.65001 21.7011 13.0644C21.8017 13.4662 21.5575 13.8735 21.1557 13.9741C20.7539 14.0746 20.3466 13.8305 20.246 13.4286C19.3071 9.67796 15.9214 7 12 7C8.07693 7 4.69009 9.68026 3.75285 13.4332C3.65249 13.835 3.24535 14.0794 2.84348 13.9791C2.44161 13.8787 2.19719 13.4716 2.29755 13.0697C3.40064 8.65272 7.38448 5.5 12 5.5Z" fill="currentColor"/></svg>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="passwordConfirmation" class="form-label">Confirm password</label>
                    <div class="password-container">
                        <input type="password" class="password-input" id="passwordConfirmation" name="password" placeholder="Confirm your password">
                        <button type="button" class="password-mode-btn">
                            <svg class="hide_pass_svg" fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M2.21967 2.21967C1.9534 2.48594 1.9292 2.9026 2.14705 3.19621L2.21967 3.28033L6.25424 7.3149C4.33225 8.66437 2.89577 10.6799 2.29888 13.0644C2.1983 13.4662 2.4425 13.8735 2.84431 13.9741C3.24613 14.0746 3.6534 13.8305 3.75399 13.4286C4.28346 11.3135 5.59112 9.53947 7.33416 8.39452L9.14379 10.2043C8.43628 10.9258 8 11.9143 8 13.0046C8 15.2138 9.79086 17.0046 12 17.0046C13.0904 17.0046 14.0788 16.5683 14.8004 15.8608L20.7197 21.7803C21.0126 22.0732 21.4874 22.0732 21.7803 21.7803C22.0466 21.5141 22.0708 21.0974 21.8529 20.8038L21.7803 20.7197L15.6668 14.6055L15.668 14.604L8.71877 7.65782L8.72 7.656L7.58672 6.52549L3.28033 2.21967C2.98744 1.92678 2.51256 1.92678 2.21967 2.21967ZM12 5.5C10.9997 5.5 10.0291 5.64807 9.11109 5.925L10.3481 7.16119C10.8839 7.05532 11.4364 7 12 7C15.9231 7 19.3099 9.68026 20.2471 13.4332C20.3475 13.835 20.7546 14.0794 21.1565 13.9791C21.5584 13.8787 21.8028 13.4716 21.7024 13.0697C20.5994 8.65272 16.6155 5.5 12 5.5ZM12.1947 9.00928L15.996 12.81C15.8942 10.7531 14.2472 9.10764 12.1947 9.00928Z" fill="currentColor"/></svg>
                            <svg class="show_pass_svg" fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M12 9.00462C14.2091 9.00462 16 10.7955 16 13.0046C16 15.2138 14.2091 17.0046 12 17.0046C9.79086 17.0046 8 15.2138 8 13.0046C8 10.7955 9.79086 9.00462 12 9.00462ZM12 5.5C16.6135 5.5 20.5961 8.65001 21.7011 13.0644C21.8017 13.4662 21.5575 13.8735 21.1557 13.9741C20.7539 14.0746 20.3466 13.8305 20.246 13.4286C19.3071 9.67796 15.9214 7 12 7C8.07693 7 4.69009 9.68026 3.75285 13.4332C3.65249 13.835 3.24535 14.0794 2.84348 13.9791C2.44161 13.8787 2.19719 13.4716 2.29755 13.0697C3.40064 8.65272 7.38448 5.5 12 5.5Z" fill="currentColor"/></svg>
                        </button>
                    </div>
                </div>
                <div class="<?= isset($error['password']) ? "password-invalid-feedback" : "d-none" ?>" id="passwordFeedback">
                   <?= $error['password'] ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary col-12 mb-3" id="register-btn">Register</button>
            <div class="or">or</div>
            <p class="text-end"><a href="/login" >Already have an account</a></p>
        </form>
	</div>
</div>

<?php include VIEWS . "/incs/footer.tpl.php"; ?>
