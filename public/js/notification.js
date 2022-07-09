$(function() {
	updateBoxes();
	var $newsletterBtn = $('header nav.notification li[newsletter] i');
	var $generalBtn = $('header nav.notification li[general] i');
	var $newsletterLink = $('header nav.notification li[newsletter] a');
	var $generalLink = $('header nav.notification li[general] a');
	var $generalBox = $('header nav.notification li[general] .notification-box');
	var $newsletterBox = $('header nav.notification li[newsletter] .notification-box');
	var $generalNotifications = $('header nav.notification li[general] .notifications');
	var $newsletterNotifications = $('header nav.notification li[newsletter] .notifications');
	$newsletterLink.on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		$newsletterBox.stop().slideToggle();
		$generalBox.stop().hide();
		readMessageNewsletter();
		updateBoxes();
	});
	$generalLink.on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		$generalBox.stop().slideToggle();
		$newsletterBox.stop().hide();
		readMessageGeneral();
		updateBoxes();
	});

	function updateBoxes() {
		$.ajax({
			url:include_path+'ajax/get-notification-number.php',
			dataType:'json'
		}).done(function(data) {
			if(data['status'] == true) {
				if(data['newsletter'] > 0)
					$newsletterBtn.html('<span class="">'+data['newsletter']+'</span>');
				else
					$newsletterBtn.html('');
				if(data['general'] > 0)
					$generalBtn.html('<span class="green-notification">'+data['general']+'</span>');
				else
					$generalBtn.html('');
			}
		});
		$.ajax({
			url:include_path+'ajax/get-notifications.php',
			dataType:'json'
		}).done(function(data) {
			if(data['status'] == true) {
				$newsletterNotifications.html(data['newsletter']);
				$generalNotifications.html(data['general']);
			}
		})
	}
	function readMessageGeneral() {
		$.ajax({
			url:include_path+'ajax/read-message.php',
			method:'post',
			data:{'type':'general'},
			dataType:'json'
		})
	}
	function readMessageNewsletter() {
		$.ajax({
			url:include_path+'ajax/read-message.php',
			method:'post',
			data:{'type':'newsletter'},
			dataType:'json'
		})
	}

	setInterval(function() {
		updateBoxes();
	}, 3*1000);
}) 