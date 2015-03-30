<!doctype html>
<html lang="en">

<head>
	<meta charset="windows-1251"/>
	<title>Дискус-Плюс CRM</title>
	<link rel="stylesheet" href="<?=$path?>css/layout.css" type="text/css" media="screen" />

	<!--[if lt IE 9]>
	<link rel="stylesheet" href="/css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?=$path?>js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="<?=$path?>js/hideshow.js" type="text/javascript"></script>
	<script src="<?=$path?>js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="<?=$path?>js/jquery.validate.js" type="text/javascript"></script>
	<script type="text/javascript" src=<?=$path?>js/jquery.equalHeight.js></script>

	<script type="text/javascript">

            jQuery.validator.addMethod("chars", function(value, element) {
     return this.optional(element) || value == "aa";
    }, jQuery.format("Please enter the correct value"));


	$(document).ready(function() {
	     $("#commentForm").validate();
	     $("#addEntrance").validate();
	     $("#addUser").validate();
    });
	$(document).ready(function()
    	{
      	  $(".tablesorter").tablesorter();
   	 }
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>










</head>


<body align=center>

	<header id="header">
		<hgroup>
			<h1 class="site_title"  align=center><a href="index.html"> Дискус-Плюс </a></h1>
		</hgroup>
	</header> <!-- end of header bar -->



