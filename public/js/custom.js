$(document).ready(function(){
    $('.postComment').click(function() {
    	var postId = $(this).attr('data-post');
    	var comment = $('#comment-'+postId).val();
    	
    	$.ajax({
    		url: "http://localhost/tweet/public/saveComment", 
    		method: "GET",
    		data: "post_id="+postId+"&comment="+comment,
	    	success: function(result){
		    	location.reload();   
		    },
		    error(xhr,status,error) {
		    	alert('Not Saved');
		    }
		});
    })
});