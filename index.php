<?php
	include("includes/header.php");
	include("includes/classes/User.php");
	include("includes/classes/Post.php");
	
	if(isset($_POST['post'])){
		$post = new Post($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], 'none');
	}

?>
	
	<div class="row">

      <div class="col s12 m4 l2"> <!-- Note that "m4 l3" was added -->
        
			<div class="card">
				<div class="card-image">
				    <a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user['profile_pic'];?>"></a>
				</div>
				<div class="card-content">
					<?php echo "Posts: ". $user['num_posts']. "<br>";
					echo "Likes: " . $user['num_likes'];
					?>
				</div>
				<div class="card-action">
				    <a href ="<?php echo $userLoggedIn; ?>"><p><?php echo $user['first_name'] . " " . $user['last_name'];?></p></a>
				</div>
            </div>
         

      </div>

      <div class="col s12 m8 l10"> 
		<div class="input-field col s12">
			<form class="post_form" action="index.php" method="POST">
				<textarea name="post_text" class="materialize-textarea" id="post_text" placeholder="Got something to say?"></textarea>
				<button class="btn waves-effect waves-light" type="submit" name="post"><input type="submit" name="post" id="post_button" value="Post"></button>
			</form>
			<div class="posts_area"></div>
			<div class="progress" id ="loading">
				<div class="indeterminate"></div>
			</div>
		</div>
      </div>

    </div>
    
    <script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {
			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>
		
  </body>
</html>
