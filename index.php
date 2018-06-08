<?php
	$user = $_GET['u'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Chat</title>
<link rel="stylesheet" type="text/css" href="reset.css" media="screen">
<style type="text/css">
	body {
		font-family: 'Open Sans';
	}

	* {
		box-sizing: border-box;
	}

	.chatContainer {
		width: 100%;
		height: 550px;
		border: 3px solid #eee;
	}

	.chatContainer > .chatHeader {
		width: 100%;
		background: #fff;
		padding: 5px;
		border-bottom: 1px solid #ddd;
	}

	.chatContainer > .chatHeader h3 {
		font-weight: 400;
		color: #666;
	}

	.chatContainer > .chatMessages {
		height: 470px;
		border-bottom: 1px solid #ddd;
		overflow-y: scroll;
	}

	.chatContainer > .chatBottom form input[type="submit"] {
		padding: 6px;
		background: #fff;
		border: 1px solid #ddd;
		cursor: pointer;
	}

	.chatContainer > .chatBottom form input[type="text"] {
		width: 85%;
		padding: 8px;
		padding-left: 12px;
		border: 1px solid #ddd;
		border-radius: 5px;
		margin: 5px;
		height: 30px;
	}

	.chatMessages li:nth-child(2n) {
		background: #eeeeee;
	}

	.msg {
		list-style: none;
		border-bottom: 1px solid #ddd;
		padding: 5px;
		color: #222222;
	}
</style>
<body>

<div class="chatContainer">
	<div class="chatHeader">
			<h3>Witaj <?php echo ucwords($user); ?></h3>
	</div>
	<div class="chatMessages"></div>
	<div class="chatBottom">
			<form action="#" onSubmit='return false;' id="chatForm">
					<input type="hidden" id="name" value="<?php echo $user; ?>"/>
					<input type="text" name="text" id="text" value="" placeholder="Wpisz wiadomość" />
					<input type="submit" name="submit" value="Wyślij" />
			</form>
	</div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$(document).on('submit', '#chatForm', function(){
			var text = $.trim($("#text").val());
			var name = $.trim($("#name").val());

			if(text != "" && name != "") {
				$.post('ChatPoster.php', {text: text, name: name}, function(data){
					$(".chatMessages").append(data);
					
					$(".chatMessages").scrollTop($(".chatMessages")[0].scrollHeight);
					$("#text").val('');
				});
			} else {
				alert("Musisz wpisac wiadomość!");
			}
		});



		function getMessages() {
			$.get('GetMessages.php', function(data){
				var amount = $(".chatMessages li:last-child").attr('id');
				$(".chatMessages").html(data);
				var countMsg = data.split('<li').length - 1;
				array = [countMsg, amount];
			});
			return array;
		}


		setInterval(function(){
		var num =	getMessages();
		if(num[0] > num[1]) {
				$(".chatMessages").scrollTop($(".chatMessages")[0].scrollHeight);
		}
	},1000);


	});
</script>
</body>
</html>
