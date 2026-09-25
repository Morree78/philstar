'use strict';
const headerToggle=document.getElementById('search_toggle');
const headerSearch=document.getElementById('header-search');
const headerInput=document.getElementById('header-search-input');
if(headerToggle && headerSearch && headerInput){
 headerToggle.addEventListener('click',()=>{const open=headerSearch.hidden;headerSearch.hidden=!open;headerToggle.setAttribute('aria-expanded',String(open));if(open)headerInput.focus();});
 headerSearch.addEventListener('keydown',event=>{if(event.key==='Escape'){headerSearch.hidden=true;headerToggle.setAttribute('aria-expanded','false');headerToggle.focus();}});
}

const menuToggle=document.getElementById('menu-toggle');
const sectionDrawer=document.getElementById('section-drawer');
function closeSections(){sectionDrawer.hidden=true;menuToggle.setAttribute('aria-expanded','false');}
if(menuToggle&&sectionDrawer){
 menuToggle.addEventListener('click',()=>{const open=sectionDrawer.hidden;sectionDrawer.hidden=!open;menuToggle.setAttribute('aria-expanded',String(open));});
 document.addEventListener('keydown',event=>{if(event.key==='Escape'&&!sectionDrawer.hidden){closeSections();menuToggle.focus();}});
 document.addEventListener('click',event=>{if(!sectionDrawer.hidden&&!sectionDrawer.contains(event.target)&&!menuToggle.contains(event.target))closeSections();});
}
const publisherLogo=document.querySelector('.publisher-logo img');
function showLogoFallback(){publisherLogo.hidden=true;publisherLogo.style.display='none';document.querySelector('.logo-fallback').hidden=false;}
if(publisherLogo){publisherLogo.addEventListener('error',showLogoFallback);if(publisherLogo.complete&&!publisherLogo.naturalWidth)showLogoFallback();}
