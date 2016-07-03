<?php

		/* WordPress'e harici bir sayfadan işlem yaptıracağımız için wp-load.php'i dahil ettiriyoruz */
		include ABSPATH."wp-load.php";


		include "sBotClass.php";


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


		/* Kategori Oluşturma 
			
			1 ) Kategori Adı 
			2 ) Kategori Açıklaması
			3 ) Kategori kısa adresi ( slug adresi ) = Zorunlu değildir boş olur ise kategori adını slug yapıp ekler

			Dönen değer 0 veya kategori id si olarak döner 0 döner ise işlem başarısızdır eklenirken hata olmuş demektir.

			Not : yeni içerik eklenirken kullanıla bilir örnek $sBot->cat=$sBot->add_category.........
		*/

		$add=$sBot->add_category('Test Kategorisi','sBotClass ile oluşturuldu','test-kategorisi');
		if ($add) {
			echo "Eklenen Kategori ID'si => ".$add;
		}else{
			echo "Eklenirken sorun oluştu";
		}

?>
