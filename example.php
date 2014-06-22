<?php
require_once "sbotClass.php";
/*

Plugin Name: Sbot

Plugin URI: http://savascanaltun.com.tr

Description: Sbot örnek Uygulaması

Author: Savaş Can Altun

Version: 1.0

Author URI: http://savascanaltun.com.tr

*/



define('siteAdresi',get_option('siteurl'));



add_action("admin_menu","transMenu");

function transMenu()

{

	add_menu_page( "Ana Sayfa", "TransBot", 10, "TransBot", "TransBot", NULL, "154" );





}
function TransBot(){

	if ($_POST) {


		$sBot = new sBotClass();
		$sBot->thumbnail = $sBot->download_image("http://www.savascanaltun.com/bannerler/125x125.png"); //"/path/to/wp-content/uploads/logo.png";
		$sBot->title="Deneme Başlık";
		$sBot->content="Deneme İçerik";
		$sBot->tags="sada,asdas";
		$sBot->cat=$_POST['kat'];
		$sBot->author=1;
		$sBot->addPost(true);


	}

echo '


<style type="text/css">
table.savas_tablo {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
	width:95%;
}
table.savas_tablo th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #eee;
}
table.savas_tablo td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
';



echo '






<table class="savas_tablo">

<form action="" method="POST">
<tr>
	<th >Konu Resmi</th><th>Başlık</th><th>Kategori</th>
</tr>
<tr>
	<td rowspan="5"><center><img src="'; echo "http://www.savascanaltun.com/bannerler/125x125.png"; echo '" width="150px" height="150px" /></center></td>
	
	<input type="hidden" name="resim" value="'; echo "http://www.savascanaltun.com/bannerler/125x125.png"; echo '" />


	<td><input style="width:400px" value="'; echo "Deneme İçerik"; echo '" name="baslik" /></td>
	<td>
		';
		echo wp_dropdown_categories("id=kategori&name=kat&echo=0&hierarchical=1&hide_empty=0");

echo '
	</td>
</tr>
<tr>
	<td colspan="2"><button style="width:100%;height:100px;" >İçeriği ekle</button></td>
</tr>
<tr>		
</tr>
</form>
</table>

';




echo '<p id="footer-left" class="alignleft"><span id="footer-thankyou">TransBot un tüm hakları <a href="http://savascanaltun.com.tr/" title="webmaster">Savaş Can Altun</a> a aittir. </span></p>';


}

?>
