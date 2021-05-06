let tray = document.querySelector(`#tray`);
let section = document.querySelector(`section`)

tray.addEventListener(`click`, ToggleShrink)

function ToggleShrink(e)
{
    e.preventDefault();
    section.classList.toggle(`hide`);

}

let tabs = document.querySelectorAll(`nav a`);

for(let i = 0; i < tabs.length; i++)
{
    tabs[i].addEventListener(`click`, BreadCrumb);
}

function BreadCrumb(e)
{
    e.preventDefault();
    for (let i = 0; i < tabs.length; i++)
    {
        tabs[i].style.backgroundColor = `#373737`;
    }
    e.target.style.backgroundColor = `#161616`;
    document.querySelector(`#file`).innerHTML = e.target.innerHTML;
}