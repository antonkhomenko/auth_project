
const themeModeBtn = document.getElementById("themeModeBtn");
const themeModeImg = themeModeBtn.firstElementChild;
const rootElement = document.getElementsByTagName("html")[0];

const themes = ['dark', 'light'];
const modeBtnImgs = ['/assets/imgs/dark_mode.svg', '/assets/imgs/light_mode.svg'];

const avatarModeSelector = document.getElementById("avatar_mode_selector");

const passwordModeBtn = Array.from(document.getElementsByClassName("password-mode-btn"));
const passwordInput = Array.from(document.getElementsByClassName("password-input"));

if (passwordModeBtn.length > 0) {
    //
    passwordModeBtn.forEach((e) => {
        if (e.previousElementSibling.type === 'password') {
            e.children[0].style.display = "block";
            e.children[1].style.display = "none";
        } else {
            e.children[0].style.display = "none";
            e.children[1].style.display = "block";
        }
        e.addEventListener("click", (event) => {
            const input = e.previousElementSibling;
            const type = input.type;
            if (type === 'password') {
                input.type = 'text';
                e.children[0].style.display = "none";
                e.children[1].style.display = "block";
            } else {
                input.type = 'password';
                e.children[0].style.display = "block";
                e.children[1].style.display = "none";
            }
        });
    });
}

if (avatarModeSelector !== null) {
    const defaultAvatarSelector = document.getElementById("default_avatar_selector");
    const customAvatarSelector = document.getElementById("custom_avatar");

    let selectedMode = avatarModeSelector.value;
    changeAvatarMode(selectedMode, defaultAvatarSelector, customAvatarSelector);

    avatarModeSelector.addEventListener("change", (e) => {
        const selected = e.target.value;
        changeAvatarMode(selected, defaultAvatarSelector, customAvatarSelector);
    });
}

function changeAvatarMode(selected, defaultMode, customMode) {
    const target = [];
    if (selected === "custom_mode") {
        target[0] = defaultMode;
        target[1] = customMode;
    } else {
        target[0] = customMode;
        target[1] = defaultMode;
    }
    target[0].classList.remove("d-flex");
    target[0].style.display = "none";
    target[1].classList.add("d-flex");
}

themeModeBtn.addEventListener("click", (event) => {
    const currentTheme = rootElement.getAttribute("data-bs-theme");
    const targetId = currentTheme === 'dark' ? 1 : 0;
    rootElement.setAttribute("data-bs-theme", themes[targetId]);
    themeModeImg.setAttribute("src", modeBtnImgs[targetId]);
    document.cookie = "mode=" + themes[targetId] + "; path=/";
});