<html>
 <head>
    <title> Lily Pai's Guestbook </title>
    <!-- 'start extjs related includes -->
    <link rel="stylesheet" type="text/css" href="extjs/ext-3.2.2/resources/css/ext-all.css" />
    <!-- Stylesheets for Lily Pai Pages-->
	<link rel="stylesheet" href="includes/common.css" type="text/css"/>
    <!-- End Stylesheets for Lily Pai Pages-->
    <!-- EXT JS LIBS -->
    <script type="text/javascript" src="extjs/ext-3.2.2/adapter/ext/ext-base.js">
    </script>
    <script type="text/javascript" src="extjs/ext-3.2.2/ext-all.js">
    </script>
    <!-- EXT JS  ENDLIBS -->        
    <script type="text/javascript" src="new.js"></script>
    
</head>
 <body>
    <!--<% name=heading action=include file=heading.html>-->
    <div id="mainToolBar"></div>
    <div id="contentPanelData" class="contentPanelData">

<style type="text/css">

textArea.box {
border-right:2px solid Gray;
border-top:2px solid Gray;
border-left:2px solid Gray;
border-bottom:2px solid Gray;
font-family: Arial;
font-size: 12pt;
height:20%;
width:95%;
}
input.inputBorders {
border-right:2px solid Gray;
border-top:2px solid Gray;
border-left:2px solid Gray;
border-bottom:2px solid Gray;
font-family: Tahoma;
font-size: 12pt; 
}

</style>

<div id="content">
<div id="rightframe">
<h3>About Me</h3>
<p style="font-size:10pt;margin-left:0px;padding:5px;">My name is Lily Pai, and this is my webpage. Please feel free to leave a message for me. Any offensive messages will be removed. </p>
<br/>

</div>
<div id="mainframe" class='main'>
<h3>Add Comment</h3>
<hr/>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<p style="font-size:10pt;font-variant:small-caps;color:DarkSlateGray;"><textarea class="box" cols="60" rows="5" name="text" id="text"></textarea>
<br/><br/>
Name: <input type="text" class="inputBorders" name="commenter" id="commenter" size="50"/>
<br/><br/>
<input type="submit" class="inputBorders" name="submit" id="submit" value="Submit" width="10"></p>
<br/>

</form>

<?php
	include 'includes/includes.php';
	
	if (isset($_POST['submit'])) {		
			if(!empty($_POST['text']) && !empty($_POST['commenter'])) {
				$result = InsertComment($_POST['text'],$_POST['commenter']);				
				if ($result != false) {
					print "Your entry has successfully been entered into the database.";
				}
			}
			else {
				print "Comment or Name is empty. Please try again.";
			}
	}
	
	$comments = GetComments();
	foreach ($comments as $post)
	{
			echo "<div class='post'>";
			echo "<p>" . $post->text . "</p>";
			echo "<br/>";
			echo "<span class='footer'>Posted On: " . $post->datePosted . "</span><br/><span class='footer'> Posted By: " . $post->commenter . "</span><br/><span class='footer'> Posted In: " . $post->locationInfo . "</span>";
			echo "</div>";
			echo "<br/><br/>";
	}
?>
	</div>
	<div class="clearer"></div>

</div>
 </body>
</html>    
