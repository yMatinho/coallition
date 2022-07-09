$(function() {
	const $sidebar = $('#sidebar');
	const $content = $('#content');
	const $menuBtn = $('#menu-icon');
	var sideOpened = true;
	var state = false;
	var $userBtn = $('#sidebar section.avatar button');
	$userBtn.on('click', function(e) {
		$(this).find('ul').slideToggle();
	})
	var $multimenu = $('#sidebar li[multimenu]');
	$multimenu.on('click', function(e) {
		$subMenu = $(this).find('ul');
		$subMenu.slideToggle();
		if(state == false) {
			state = true;
			$(this).find('i[seta]').removeClass('fa-plus').addClass('fa-minus');
		} else {
			$(this).find('i[seta]').removeClass('fa-minus').addClass('fa-plus');
			state = false;
		}
	});
	$multimenu.find('ul').on('click', function(e) {
		e.stopPropagation();
	})
	$('#sidebar li[multimenu] > a').on('click', function(e) {
		e.preventDefault();
	});
	$('#sidebar li[multimenu] ul a').on('click', function(e) {
		e.stopPropagation();
	});
	$menuBtn.on('click', function(e) {
		e.preventDefault();
		if(sideOpened == true) {
			sideOpened = false;
			$sidebar.stop().animate({'width':0}, 300);
			$content.stop().animate({'width':'100%', 'left':0}, 300);
		} else {
			sideOpened = true;
			$sidebar.stop().animate({'width':'25%'}, 300);
			$content.stop().animate({'width':'75%', 'left':'25%'}, 300);
		}
	})

})