let butt = document.querySelector('aside a');

butt.addEventListener('click', hide);

function hide(e)
{
    e.preventDefault();
    butt.parentElement.parentElement.classList.toggle('hide');
}

let tabs = document.querySelectorAll('nav a');

for(let i=0; i < tabs.length; i++)
{
    tabs[i].addEventListener('click', highlight)
}

function highlight(e)
{
    e.preventDefault();
    for(let i=0; i < tabs.length; i++)
    {
        tabs[i].style.backgroundColor = 'black';
    }
    e.target.style.backgroundColor = '#333333';
    document.querySelector('#file').innerHTML = e.target.innerHTML;
}