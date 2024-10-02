
const themeModeBtn = document.getElementById("themeModeBtn");
const themeModeImg = themeModeBtn.firstElementChild;
const rootElement = document.getElementsByTagName("html")[0];

const themes = ['dark', 'light'];
const modeBtnImgs = ['/assets/imgs/dark_mode.svg', '/assets/imgs/light_mode.svg']

themeModeBtn.addEventListener("click", (event) => {
    const currentTheme = rootElement.getAttribute("data-bs-theme");
    const targetId = currentTheme === 'dark' ? 1 : 0;
    rootElement.setAttribute("data-bs-theme", themes[targetId]);
    themeModeImg.setAttribute("src", modeBtnImgs[targetId]);
    document.cookie = "mode=" + themes[targetId] + "; path=/";
});