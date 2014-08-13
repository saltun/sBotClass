<?php

/*

Plugin Name: sBotClass

Plugin URI: http://savascanaltun.com.tr

Description: sBotClass örnek kullanım eklentisi

Author: Savaş Can ALTUN 

Version: 1.0

Author URI: http://savascanaltun.com.tr

*/


add_action("admin_menu","botMenu");

function botMenu()

{

	add_menu_page( "Ana Sayfa", "sBotClass", 10, "sBotClass", "sBotClass", NULL, "145" );


}


function sBotClass(){




		include "sbotClass.php";


		$sBot = new sBotClass();
		$sBot->title="test";
		$sBot->thumbnail = "http://savascanaltun.com/sca.jpeg"; 
		$etiketler="test,test";
		$sBot->content="bla bla";
		$sBot->tags=$etiketler;

		/*
		status kısmının ala bileceği değerler
		 ---------------
		 * Taslak : draft 
		 * Açık / Yayında :  publish 
		 * Beklemede :  pending
		 * Zamanlanmış : future ( eğer zamanlamış iseniz "time" değişkenine taslağın yayınlanacağı tarihi giriniz örnek 2014-07-27 18:00:00 )
		 * Özel : private
		 */
		$sBot->status="publish";
		$sBot->time="2014-07-27 18:00:00";

		$sBot->cat=1;
		$sBot->author=1;
		$sBot->metas=array(
			'link'=>'http://x.com/1.rar',
			'adres'=>'http://x.com/1.rar',
			'gorsel'=>'http://savascanaltun.com/sca.jpeg'
			);
			/*
		* Birinci parametre true gider ise all in one seo alanları otomatik dolar
		* ikinci alan true gider ise aynı içerikten var ise eklemez eğer false veya boş giderse aynı içerikten olsa dahi ekler
		*/
		$sBot->addPost(true,true);

}

?>
