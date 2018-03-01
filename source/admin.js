let linkCollapse = $('.collapseIn');

linkCollapse.click(function (e) {
	e.preventDefault();
	e.stopPropagation();

	let collapse = $($(this).attr('href'));
	collapse.collapse('show');
	collapse.siblings('a').css('font-weight', 'bold');

	if (collapse.children('li').length === 1){
		collapse.children('li').children('a').css('color', 'red');
	}
	else{
			collapse.children('li').children('a').each(function () {
				if ($(this).text() === collapse.siblings('a').text())
					$(this).css('color', 'red');
			});
	}

	collapse.parents('ul.collapse').collapse('show');

	$('html,body').animate({
		scrollTop: collapse.offset().top - ($(window).height() - collapse.outerHeight(true)) / 2
	}, 500);
});