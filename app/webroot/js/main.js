$(function(){
	$(document).foundationCustomForms();
	$("#categories ul li").hover(function(){
		$(this).find("ul.submenu").stop(true,true).delay(100).slideDown();
	}, function(){
		$(this).find('ul.submenu').delay(200).slideUp();
	});
	
	function postLike(listingId) {
		$.ajax({
			url: '/apis/checkfacebookuser',
			data: {listingid: listingId},
			success: function(response){
				if(response == false)
					return null;
				else{
					FB.api('me/theboxngo:favorite','post',
					{
						object: window.location.href,
						access_token: response					
					},
					function(response) {
						return response.id;
					}
				);
				}
			}
		});
	}

	//Add favorites
	$("body").on("click", "a.addfavorite", function(event){
		event.preventDefault();
		var favoriteClicked = $(this);
		$(this).find('.typicn.heart').hide();
		$(this).find('i.loading').show();
		var facebookId = postLike($(this).data('listingid'));
		var _this = this;
    	$.ajax({
			url: getDomain()+'users/addfavorite',
			data: {listingid: $(this).data('listingid'), facebook_story: facebookId, url: window.location.href},
			success: function(response){
				$(_this).find('.loading').hide();
				$(_this).find('.typicn.heart').show();
				favoriteClicked.removeClass('addfavorite');
				favoriteClicked.addClass('addfavoriteused');
				$("body .favoritemessage").remove();
				$("body").prepend(response);
				$("body .favoritemessage").slideDown().delay(4000).slideUp();
			}
		});
	});
	$("body").on("click", "a.addfavoriteused", function(event){
		event.preventDefault();
		var favoriteClicked = $(this);
		$(this).find('.typicn.heart').hide();
		$(this).find('i.loading').show();
		var _this = this;
		$.ajax({
			url: getDomain()+'users/removefavorite',
			data: {listingid: $(this).data('listingid')},
			success: function(response){
				$(_this).find('.loading').hide();
				$(_this).find('.typicn.heart').show();
				favoriteClicked.removeClass('addfavoriteused');
				favoriteClicked.addClass('addfavorite');
				$("body .favoritemessage").remove();
				$("body").prepend(response);
				$("body .favoritemessage").slideDown().delay(4000).slideUp();
			}
		});
	});
	
	$("#searchTrigger, #listButton").on("click", function(){
		$("#SearchIndexForm").submit();
	});
});

function getDomain(){
	return "/";
}