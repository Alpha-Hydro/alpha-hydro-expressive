import "./javascript/bootstrap/modal";
import "./javascript/bootstrap/tab";

let sidebarToggle = $('.sidebar-toggle');
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

let mainMenuToggle = $('.main-menu-toggle');
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

(function($) {
	return $('.popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1]
		},
		image: {
			tError: 'The image could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
})(jQuery);