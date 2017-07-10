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
    });

    $('#follow').click(function() {
        var userId = $(this).attr('data-user_id');
        
        $.ajax({
            url: "http://localhost/tweet/public/follow/"+userId, 
            method: "GET",
            //data: "user_id="+userId,
            success: function(result){
               $('.follow').hide();
               $('.unfollow').show();
            },
            error(xhr,status,error) {
                alert('Not Saved');
            }
        });
    });

    $('#unfollow').click(function() {
        var userId = $(this).attr('data-user_id');
        
         $.ajax({
            url: "http://localhost/tweet/public/unfollow/"+userId, 
            method: "GET",
            success: function(result){
               $('.follow').show();
               $('.unfollow').hide();
            },
            error(xhr,status,error) {
                alert('Not Saved');
            }
        });
    });
});