document.addEventListener('error',function(e){if(e.target.matches('img.photo'))e.target.parentElement.classList.add('missing');},true);
