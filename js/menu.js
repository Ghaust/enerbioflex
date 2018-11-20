/*
	Documentation :
	Ce script gère l'apparition et la disparition du menu en fonction du clique
	sur le logo.
*/
$(document).ready(function(){
	$('.logo').on('click', function(){
		$('.nav-bar').toggleClass('hidden');
		if ( $('.nav-bar').hasClass('hidden') ){
			$('.nav-bar').fadeOut(500);
		}
		else {
			$('.nav-bar').fadeIn(500);
		}
	});
});

/*
	Documentation :
	Ce script gère l'apparition et la disparition du menu en fonction du scroll
	dans la page.
*/
$(function () {
	$position = $(document).scrollTop();
	$(window).scroll(function(){
		if ($position < $(document).scrollTop()){
			$position = $(document).scrollTop();
			//alert("BAS");
			$(document).ready(function(){
				$('.nav-bar').fadeOut(500);
			});
		}
		else if ($position > $(document).scrollTop()) {
			$position = $(document).scrollTop();
			//alert("HAUT");
			$(document).ready(function(){
				$('.nav-bar').fadeIn(500);
			});
		}
	});
});




