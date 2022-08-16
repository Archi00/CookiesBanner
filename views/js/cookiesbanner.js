const block = document.querySelector("#cookiesbanner_block_home")
const btn = document.querySelector("#cookiesbanner_accept_btn")

if (btn && block) {
  btn.addEventListener("click", () => {
    setCookie("cookies_banner_accepted", true)
    console.log("Cookies Accepted")
    block.style.display = "none"
  })
}

function setCookie(name,value) {
    const date = new Date();
    date.setTime(date.getTime() + (15*24*60*60*1000));
    const expires = "; expires=" + date.toUTCString();
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
