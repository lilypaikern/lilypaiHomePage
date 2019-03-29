<?php
	
	class Comment
	{
		public $text;
		public $commenter;
		public $datePosted;
		public $locationInfo;
		
		function __construct($inText, $inCommenter=null, $inDatePosted=null, $inLocationInfo=null) 
		{
			if (!empty($inText))
			{
				$this->text = stripslashes($inText);
			}
			if (!empty($inCommenter))
			{
				$this->commenter = stripslashes($inCommenter);
			}
			if (!empty($inDatePosted))
			{
				//$splitDate = explode("-", $inDatePosted);
				//$this->datePosted = $splitDate[1] . "/" . $splitDate[2] . "/" . $splitDate[0];
				$this->datePosted = date("l F d Y", strtotime($inDatePosted));
			}
			if (!empty($inLocationInfo))
			{
				$this->locationInfo = stripslashes($inLocationInfo);
			}
		}
	}
					
	?>


