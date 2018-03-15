import "./javascript/bootstrap/modal";
import "./javascript/bootstrap/tab";
import search from "./javascript/app/search";

search('#search-query');

let sidebarToggle = $('#sidebar-toggle');
let sidebarDropdown = $('.sidebar-dropdown');

sidebarToggle.click(function (e) {
	e.preventDefault();
	e.stopPropagation();

	$('html').css('overflow', 'hidden');
	sidebarDropdown.toggleClass('open');

	$(document).one('click', function closeMenu(e) {
		if (sidebarDropdown.has(e.target).length === 0){
			sidebarDropdown.removeClass('open');
			$('html').css('overflow', 'auto');
		}else{
			$(document).one('click', closeMenu);
		}
	})
});

let mainMenuToggle = $('#main-menu-toggle');
let mainMehuDropdown = $('.main-menu-dropdown');

mainMenuToggle.click(function (e) {
	e.preventDefault();
	e.stopPropagation();

	$('html').css('overflow', 'hidden');
	mainMehuDropdown.toggleClass('open');

	$(document).one('click', function closeMenu(e) {
		if (mainMehuDropdown.has(e.target).length === 0){
			mainMehuDropdown.removeClass('open');
			$('html').css('overflow', 'auto');
		}else{
			$(document).one('click', closeMenu);
		}
	})
});

let mailElement = $('.mail');
const login  = 'info';
const server = 'alpha-hydro.com';
const email  = login+'@'+server;
const url = 'mailto:'+email;
mailElement.html('<a href="'+url+'"><i class="fa fa-envelope"></i> '+email+'</a>');