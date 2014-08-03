sBotClass
=========


WordPress Bot Yazma Sınıfı ( Wordpress Bot Class ) 

- eklenti biçiminde kullanım için uygundur demo kullanım için example.php dosyasına bakınız.. 

Dikkat ( Watch out! ) 
=========
Tr : 
Sınıfı kullanmak için wp-content klasörünün içine uploads klasörünü  ve bunun içinde'de images klasörünü oluşturmuş olmanız gerekir.

En : 
To use the class wp-content uploads folder into the folder and the images folder inside of it must be created.

Note 2 : 

Tr : 
Sınıf içerisindeki adresten resim download edip onu öne çıkarılmış olarak belirtirken resmin seo'ya uygun şekilde dosyanın adlanması için   "thumbnail" method'unu  "title" method'undan sonra kullanınız 

En : Whether to download pictures from addresses in the classroom as it highlighted the picture when specifying the file in accordance with seo be termed the "thumbnail" the method "title" method after use

Örnek ( example ) 
<pre>
	$sBot->title="Örnek Yazı - ";
	$sBot->thumbnail =  $sBot->download_image("http://savascanaltun.com/sca.jpeg"); 
		
</pre>

I Love You Translate -_-

Sınıfı yükleyip Calıştıralım
===========================
<pre>
require_once "sbotClass.php";

$sBot = new sBotClass();
</pre>


İçerik için başlık belirleme ( title )
===========================
Başlık eklemek için alttaki yöntem ile basitce içerik için title yani başlık belirliye bilirsiniz.
<pre>
$sBot->title="Deneme Başlık - Title ";
</pre>

İçerik ( Content ) 
===========================
İçerik eklemek için ise basitce alttaki fonksiyonu kullanmanız yeterli.
<pre>
$sBot->content="Deneme İçerik - Demo Content";
</pre>

Etiketler ( Tags ) 
===========================
İçeriğiniz için etiketleri tags parametresi ile göndere bilirsiniz. ( , ile ayırınız ) 
<pre>
$sBot->tags="tags,etiket,savascanaltun,php";
</pre>


Kategori ( Category ) 
===========================
Kategori belirmek içni kullanmanız gereken parametre " cat " bunu sorunsuz kullanmak için wordpress  wp_dropdown_categories fonksiyonunu incelemenizi öneririz.


Kullanmanız gereken parametre 
<pre>$sBot->cat</pre>


Yazar ( Author ) 
===========================
içeriği ekliyen yazarın id'sini belirmek isterseniz author parametresini kullanmanız yeterli. default olarak 1'e ayarlıdır.

<pre>
$sBot->author=1;
</pre>

Özel Alanlar ( custom fields ) 
===========================
Temalarınıza özel alanları doldurmanız için güncellendi ( 26.07.2014 )  kullanımı basitce
<pre>
$sBot->metas=array(
			'keywords'=>'values',
			'keywords'=>'values'
			);
</pre>


burada dilediğiniz kadar özel alan kullana bilirsiniz yapmanız gereken sadece kelime ( özel alan adını ) yazıp ona değer olarak belirtilen değerleri göndermek sınıf sizin için otomatik olarak özel alanı oluşturup verdiğiniz value ( değeri ) üzerine işleyecektir.

Öne Çıkarılan Görsel ( thumbnail )
===========================

Uzak Sunucudan  Resmi kendi sunucumuza kayıt etmek için alttaki download_image fonksiyonunu kullana bilirsiniz.

<pre>
$sBot->thumbnail = $sBot->download_image("http://www.savascanaltun.com/bannerler/125x125.png");
</pre>

Manuel olarak resmin adresini almak için ise ( dikkat etmemiz gereken kısım /path/to kısmıdır.
<pre>
$sBot->thumbnail = "/path/to/wp-content/uploads/125x125.png";
</pre>


Verileri Kayıt Etmek
===========================
Verileri son olarak kayıt etmek için addPost fonksiyonunu kullanmalısınız.

<pre>
$sBot->addPost();
</pre>


Kullanım için 2 adet parametre göndere bilirsiniz bunlardan birincisi all in one seo alanlarının otomatik dolması için diğeri ise yazının eşsiz olup olmaması için kullana bilirsiniz örnek vericek olur isek 

All in one seo alanlarının doldurulmasını istediğim için birinci parametre'ye true değeri gönderdim böylece all in one seo alanları dolduruldu 
<pre>
$sBot->addPost(true);
</pre>

İkinci örnek ise All in one seo ayarlarının doldurulmasını istedim ama eklenen yazıdan zaten sitemde var ise bir daha eklenmemesini istedim bundan dolayı ise ikinci parametre'ye de true değerini gönderdim 
<pre>
$sBot->addPost(true,true);
</pre>

eğer sadece benzersiz olup all in one seo kullanılmasın demek ister iseniz false,true şeklinde belirlemeniz yeterlidir. 




Yayınların Durumunu belirleme 
===========================
yayınların durumunu belirlemek için "status" değişkenine durumu göndermeniz gerekmektedir kullana bileceğiniz durumlar ve anlamları altta listelenmiştir

- Taslak : draft 
- Açık / Yayında :  publish 
- Beklemede :  pending
- Zamanlanmış : future ( eğer zamanlamış iseniz "time" değişkenine taslağın yayınlanacağı tarihi giriniz örnek 2014-07-27 18:00:00 )
- Özel : private


defult olarak publish değerini almaktadır örnek kullanım

<pre>
$sBot->status="draft";
</pre>

Yayını Zamanlama
===========================
Eklenen içeriği otomatik bir süre sonra yayınlanmasını istiyor iseniz time değişkenine tarihi göndermeniz gerekmektir göndereceğiniz tarih formatı  ( Y-m-d G:i:s / Y-m-d H:i:s  ) yani -> 2014-07-27 18:00:00 tarzı bir format biçiminde göndermeniz gerekir
örnek kullanımı
<pre>
$sBot->time="2014-07-27 18:00:00";
</pre>

Tüm Kullanımlar üstteki şekildedir eğer sorun yaşar iseniz  example.php dosyasına bakınız. örnek kullanımı bula bilirsiniz.

Author : Savaş Can Altun
Mail : savascanaltun@gmail.com
Web : http://savascanaltun.com.tr
