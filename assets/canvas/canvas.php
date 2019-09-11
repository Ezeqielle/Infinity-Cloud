<!DOCTYPE html>
<html>
	<head>
		<title>canvas</title>
		<style type="text/css">
                	div.round
                	{
                		margin: 50px;
                		width: 200px; height: 200px;
                		position: relative;
                                float:left;
                	}
                	div.round input
                	{
                		position: absolute;
                		top:60px; left:50px;
                		font-size: 60px; text-align: center;
                		width: 100px;
                		border:none;
                                background:none;
                		outline:none;
                	}
                	div.round canvas
                	{
                		position: absolute;
                		top:0; left:0; right:0; bottom:0;
                	}
                </style>
	</head>
	<body>
		<input type="text" name="round" class="round" data-min="0" data-max="50" value="30"/>
		<input type="text" name="round" class="round" data-min="50" data-max="100" value="70" data-color="#FF0000"/>
		<input type="text" name="round" class="round" data-min="0" data-max="100" value="100" data-color="#35b577"/>
		<input type="text" name="round" class="round" data-min="0" data-max="100" value="20" data-color="#83b535"/>
	</body>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="canvas.js"></script>
</html>
