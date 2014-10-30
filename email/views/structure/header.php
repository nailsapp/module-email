<!DOCTYPE html>
<html>
	<head>
		<title><?=$email_subject?></title>
		<meta charset="utf-8">
		<style type="text/css">

			body,
			#BodyImposter
			{
				margin:0;
				padding:0;
				font-size:13px;
				font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				line-height:1.75em;
				max-width:600px;
				margin:auto;
				color:#333;
			}

			.padder
			{
				padding: 20px;
			}

			h1
			{
				line-height:1.5em;
				font-style:italic;
				font-weight:bold;
				margin-bottom:1em;
				padding-bottom:1em;
				border-bottom:1px solid #ECECEC;
			}

			h2
			{
				font-size:1.2em;
				font-weight:bold;
				margin-top:3em;
				border-bottom:1px solid #ECECEC;
				padding-bottom:0.5em;
			}

			h3,h4,h5,h6
			{
				font-size:1em;
				font-weight:bold;
				margin-bottom:1em;
			}

			p
			{
				margin-bottom:1em;
			}

			.text-center
			{
				text-align: center;
			}

			.text-left
			{
				text-align: left;
			}

			.text-right
			{
				text-align: right;
			}

			small
			{
				font-size:0.8em;
			}

			blockquote
			{
				border-left: 4px solid #EFEFEF;
				padding-left: 10px;
				margin-left: 0px;
				font-style: italic;
				font-size: 1.3em;
				font-weight: lighter;
				color: #777777;
			}

			ul
			{
				margin:0;
				margin-bottom:1em;
				padding:0;
			}

			ul li
			{
				margin:0;
				padding:0;
				list-style-type: none;
			}

			hr
			{
				border:none;
				border-top:1px dotted #CCCCCC;
				margin: 30px 0;
			}

			.footer
			{
				border-top:1px solid #ECECEC;
				margin-top:2em;
			}

			table.default-style
			{
				border:1px solid #CCCCCC;
				width:100%;
				border-collapse: collapse;
			}

			table.default-style th
			{
				background:#EFEFEF;
				border-bottom:1px dotted #CCCCCC;
				padding: 5px 10px;
			}

			table.default-style td
			{
				padding:10px;
				vertical-align: top;
			}

			table.default-style td.left-header-cell
			{
				width:125px;
				font-weight:bold;
				background:#ECECEC;
				border-right:1px solid #CCCCCC;
			}

			table.default-style th.center,
			table.default-style td.center
			{
				text-align: center;
			}

			table.default-style th.right,
			table.default-style td.right
			{
				text-align: right;
			}

			table.default-style tr.line-bottom td
			{
				border-bottom:1px dotted #CCCCCC;
			}

			table.default-style td small
			{
				display:block;
			}

			img.thumbnail
			{
				padding:6px;
				border:1px solid #CCCCCC;
				background:#F9F9F9;
				-moz-border-radius: 2px;
				-webkit-border-radius: 2px;
				border-radius: 2px;

				-moz-box-shadow: 0px 1px 1px #888888;
				-webkit-box-shadow: 0px 1px 1px #888888;
				box-shadow: 0px 1px 1px #888888;
			}

			.heads-up
			{
				padding:10px;
				border:1px solid #CCCCCC;
				background:#EFEFEF;
				-webkit-border-radius:3px;
				-moz-border-radius:3px;
				-o-border-radius:3px;
				border-radius:3px;

				-moz-box-shadow: 0px 1px 1px #CCCCCC;
				-webkit-box-shadow: 0px 1px 1px #CCCCCC;
				box-shadow: 0px 1px 1px #CCCCCC;
			}

			a.button
			{
				background: #eee; /* Old browsers */
				background: #eee -moz-linear-gradient(top, rgba(255,255,255,.2) 0%, rgba(0,0,0,.2) 100%); /* FF3.6+ */
				background: #eee -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,.2)), color-stop(100%,rgba(0,0,0,.2))); /* Chrome,Safari4+ */
				background: #eee -webkit-linear-gradient(top, rgba(255,255,255,.2) 0%,rgba(0,0,0,.2) 100%); /* Chrome10+,Safari5.1+ */
				background: #eee -o-linear-gradient(top, rgba(255,255,255,.2) 0%,rgba(0,0,0,.2) 100%); /* Opera11.10+ */
				background: #eee -ms-linear-gradient(top, rgba(255,255,255,.2) 0%,rgba(0,0,0,.2) 100%); /* IE10+ */
				background: #eee linear-gradient(top, rgba(255,255,255,.2) 0%,rgba(0,0,0,.2) 100%); /* W3C */
				border: 1px solid #AAAAAA;
				border-top: 1px solid #CCCCCC;
				border-left: 1px solid #CCCCCC;
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
				border-radius: 3px;
				color: #444444;
				display: inline-block;
				/*font-size: 11px;*/
				font-weight: bold;
				text-decoration: none;
				text-shadow: 0 1px rgba(255, 255, 255, .75);
				cursor: pointer;
				margin-bottom: 20px;
				/*line-height: normal;*/
				padding: 8px 10px;
				font-family: "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
			}

			a.button.small
			{
				font-size:0.8em;
				padding: 0 5px;
			}

			a.button:hover
			{
				color: #222222;
				background: #DDDDDD; /* Old browsers */
				background: #DDDDDD -moz-linear-gradient(top, rgba(255,255,255,.3) 0%, rgba(0,0,0,.3) 100%); /* FF3.6+ */
				background: #DDDDDD -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,.3)), color-stop(100%,rgba(0,0,0,.3))); /* Chrome,Safari4+ */
				background: #DDDDDD -webkit-linear-gradient(top, rgba(255,255,255,.3) 0%,rgba(0,0,0,.3) 100%); /* Chrome10+,Safari5.1+ */
				background: #DDDDDD -o-linear-gradient(top, rgba(255,255,255,.3) 0%,rgba(0,0,0,.3) 100%); /* Opera11.10+ */
				background: #DDDDDD -ms-linear-gradient(top, rgba(255,255,255,.3) 0%,rgba(0,0,0,.3) 100%); /* IE10+ */
				background: #DDDDDD linear-gradient(top, rgba(255,255,255,.3) 0%,rgba(0,0,0,.3) 100%); /* W3C */
				border: 1px solid #888888;
				border-top: 1px solid #AAAAAA;
				border-left: 1px solid #AAAAAA; }

				.button:active,
				button:active,
				input[type="submit"]:active,
				input[type="reset"]:active,
				input[type="button"]:active {
				border: 1px solid #666666;
				background: #CCCCCC; /* Old browsers */
				background: #CCCCCC -moz-linear-gradient(top, rgba(255,255,255,.35) 0%, rgba(10,10,10,.4) 100%); /* FF3.6+ */
				background: #CCCCCC -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,.35)), color-stop(100%,rgba(10,10,10,.4))); /* Chrome,Safari4+ */
				background: #CCCCCC -webkit-linear-gradient(top, rgba(255,255,255,.35) 0%,rgba(10,10,10,.4) 100%); /* Chrome10+,Safari5.1+ */
				background: #CCCCCC -o-linear-gradient(top, rgba(255,255,255,.35) 0%,rgba(10,10,10,.4) 100%); /* Opera11.10+ */
				background: #CCCCCC -ms-linear-gradient(top, rgba(255,255,255,.35) 0%,rgba(10,10,10,.4) 100%); /* IE10+ */
				background: #CCCCCC linear-gradient(top, rgba(255,255,255,.35) 0%,rgba(10,10,10,.4) 100%); /* W3C */
			}

			a.button:active
			{
				border: 1px solid #666666;
				background: #CCCCCC; /* Old browsers */
				background: #CCCCCC -moz-linear-gradient(top, rgba(255,255,255,.35) 0%, rgba(10,10,10,.4) 100%); /* FF3.6+ */
				background: #CCCCCC -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,.35)), color-stop(100%,rgba(10,10,10,.4))); /* Chrome,Safari4+ */
				background: #CCCCCC -webkit-linear-gradient(top, rgba(255,255,255,.35) 0%,rgba(10,10,10,.4) 100%); /* Chrome10+,Safari5.1+ */
				background: #CCCCCC -o-linear-gradient(top, rgba(255,255,255,.35) 0%,rgba(10,10,10,.4) 100%); /* Opera11.10+ */
				background: #CCCCCC -ms-linear-gradient(top, rgba(255,255,255,.35) 0%,rgba(10,10,10,.4) 100%); /* IE10+ */
				background: #CCCCCC linear-gradient(top, rgba(255,255,255,.35) 0%,rgba(10,10,10,.4) 100%); /* W3C */ }

				.button.full-width,
				button.full-width,
				input[type="submit"].full-width,
				input[type="reset"].full-width,
				input[type="button"].full-width {
				width: 100%;
				padding-left: 0 !important;
				padding-right: 0 !important;
				text-align: center;
			}

		</style>
	</head>
	<body>
	<div id="BodyImposter">
	<div class="padder">
	<?php

		echo '<h1>' . $email_subject . '</h1>';

		if ( isset( $sent_to->first ) && $sent_to->first ) :

			echo '<p>Hi ' . $sent_to->first . ',</p>';

		endif;

	?>