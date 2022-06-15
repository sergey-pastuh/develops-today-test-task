import './bootstrap';

$('.upvote-button').click(function(){

	$(this).css("visibility", "hidden");
    let post_id = $(this).attr('id');

    $.ajax
    ({ 
        url: '/posts/'+post_id+'/upvote',
        data: {"post_id": post_id},
        type: 'post',
        success: function(result)
        {
        	let value = $('#upvotes-'+post_id).text();
        	$('#upvotes-'+post_id).text(++value)
        }
    });
});