$(function(){
	$("#addComment").on("click", function(event){
		event.preventDefault();
		$("#CommentViewlistingForm").stop(true,true).slideToggle(500);
	});

	$("#gallery").mCustomScrollbar({
    	scrollButtons:{
			enable:true
		},
		theme: "dark"
    });
	$('#lightboxImage').magnificPopup({
		type: 'image'
	});
    $("#gallery div.imageContainer:first-child").click();
});

$("#gallery").on("click", ".imageContainer", function(){
	$("#lightboxImage").attr('href', $(this).data('image'));
	$("#displayPicture img").attr('src', $(this).data('image'));
	$("#gallery .imageContainer").removeClass("selected");
	$(this).addClass("selected");
});