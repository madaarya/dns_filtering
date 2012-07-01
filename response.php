<?php
$url = base64_decode($_REQUEST['url']);
?>

<html>
    <head>
        <title>Oops you can't access this website !</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="javascript/jquery-1.7.min.js"></script>
        <script type="text/javascript">
		$(document).ready(function() {
		
		$(".kontak").click(function(){
				$("#sembunyi").fadeIn("slow");
			});
	});
	</script>
	
	
    </head>
    <body>
        <div id="contact">
        <p>Sory <?php echo $url; ?> can't be access</p>
        
        <p><a href="#" class="kontak">Contact your administrator</a></p>
	
	<div id="sembunyi" style="display:none">        
            <h1>Contact us</h1>
            <form id="ContactForm" action="">
                <p>
                    <label>Name</label>
                    <input id="name" name="name" class="inplaceError" maxlength="120" type="text" autocomplete="off"/>
					<span class="error" style="display:none;"></span>
                </p>
                <p>
                    <label>Email</label>
                    <input id="email" name="email" class="inplaceError" maxlength="120" type="text" autocomplete="off"/>
					<span class="error" style="display:none;"></span>
                </p>
                <p>
                    <label>Your message<br /> <span>300 characters allowed</span></label>
                    <textarea id="message" name="message" class="inplaceError" cols="6" rows="5" autocomplete="off"></textarea>
					<span class="error" style="display:none;"></span>
                </p>
                <p class="submit">
                    <input id="send" type="button" value="Submit"/>
                    <span id="loader" class="loader" style="display:none;"></span>
					<span id="success_message" class="success"></span>
                </p>
				<input id="newcontact" name="newcontact" type="hidden" value="1" />
				<input type="hidden" name="url" value="<?php echo $url; ?>" />
            </form>
        </div>
        <div class="envelope">
            <img id="envelope" src="images/envelope.png" alt="envelope" width="246" height="175" style="display:none;"/>
        </div>
       
    </div>    
		<script src="javascript/jquery.contact.js" type="text/javascript"></script>
    </body>
</html>
