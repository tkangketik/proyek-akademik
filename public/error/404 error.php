	<style>
		body{
			font-family: sans-serif;
		}
		a{
			text-decoration: none;
			color: #515151;
			cursor: text;
		}
		.content{
			margin: 20px auto;
			text-align: center;
			width: 50%;
		}
		.title{
			font-size: 125px;
			font-weight: 700;
		}
		.body{
			padding: 10px;
			font-size: 19px;
			text-align: left;
		}
		.body div{
			font-size: 16px;
		}
		ul{
			margin: 0;
		}
	</style>
<div class="content">
	<div class="title">404</div>
		<div class="body">
			<a><?= $_SERVER['PHP_SELF']; ?>?<?php $text=''; foreach ($_GET as $key => $value) { if($text=='') {$text =  $key.'='.$value;} else { $text .=  '&'.$key.'='.$value; } } echo $text ?></a> Is not found
			<div>
				try:
				<ul>
					<li>Check your url</li>
				</ul>
				<div align="right">
					<a style="cursor: pointer;" onclick="goBack()">Back dashboard page</a>
				</div>
			</div>
		</div>
</div>