import './javascript/bootstrap/collapse';
import './javascript/bootstrap/transition';

let toggle = $('.sidebar-toggle');
let dropdown = $('.sidebar-dropdown');

toggle.click(function (e) {
	e.preventDefault();
	e.stopPropagation();

	$('html').css('overflow', 'hidden');
	dropdown.toggleClass('open');

	$(document).one('click', function closeMenu(e) {
		if (dropdown.has(e.target).length === 0){
			dropdown.removeClass('open');
			$('html').css('overflow', 'auto');
		}else{
			$(document).one('click', closeMenu);
		}
	})
});
