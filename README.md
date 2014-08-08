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
``` php
	$sBot->title="Örnek Yazı - ";
	$sBot->thumbnail =  $sBot->download_image("http://savascanaltun.com/sca.jpeg"); 
		
```

I Love You Translate -_-

Sınıfı yükleyip Calıştıralım
===========================
``` php
require_once "sbotClass.php";

$sBot = new sBotClass();
```


İçerik için başlık belirleme ( title )
===========================
Başlık eklemek için alttaki yöntem ile basitce içerik için title yani başlık belirliye bilirsiniz.
``` php
$sBot->title="Deneme Başlık - Title ";
```

İçerik ( Content ) 
===========================
İçerik eklemek için ise basitce alttaki fonksiyonu kullanmanız yeterli.
``` php
$sBot->content="Deneme İçerik - Demo Content";
```

Etiketler ( Tags ) 
===========================
İçeriğiniz için etiketleri tags parametresi ile göndere bilirsiniz. ( , ile ayırınız ) 
``` php
$sBot->tags="tags,etiket,savascanaltun,php";
```


Kategori ( Category ) 
===========================
Kategori belirmek içni kullanmanız gereken parametre " cat " bunu sorunsuz kullanmak için wordpress  wp_dropdown_categories fonksiyonunu incelemenizi öneririz.


Kullanmanız gereken parametre 
``` php$sBot->cat```


Yazar ( Author ) 
===========================
içeriği ekliyen yazarın id'sini belirmek isterseniz author parametresini kullanmanız yeterli. default olarak 1'e ayarlıdır.

``` php
$sBot->author=1;
```

Özel Alanlar ( custom fields ) 
===========================
Temalarınıza özel alanları doldurmanız için güncellendi ( 26.07.2014 )  kullanımı basitce
``` php
$sBot->metas=array(
			'keywords'=>'values',
			'keywords'=>'values'
			);
```


burada dilediğiniz kadar özel alan kullana bilirsiniz yapmanız gereken sadece kelime ( özel alan adını ) yazıp ona değer olarak belirtilen değerleri göndermek sınıf sizin için otomatik olarak özel alanı oluşturup verdiğiniz value ( değeri ) üzerine işleyecektir.

Öne Çıkarılan Görsel ( thumbnail )
===========================

Uzak Sunucudan  Resmi kendi sunucumuza kayıt etmek için alttaki download_image fonksiyonunu kullana bilirsiniz.

``` php
$sBot->thumbnail = $sBot->download_image("http://www.savascanaltun.com/bannerler/125x125.png");
```

Manuel olarak resmin adresini almak için ise ( dikkat etmemiz gereken kısım /path/to kısmıdır.
``` php
$sBot->thumbnail = "/path/to/wp-content/uploads/125x125.png";
```


Verileri Kayıt Etmek
===========================
Verileri son olarak kayıt etmek için addPost fonksiyonunu kullanmalısınız.

``` php
$sBot->addPost();
```


Kullanım için 2 adet parametre göndere bilirsiniz bunlardan birincisi all in one seo alanlarının otomatik dolması için diğeri ise yazının eşsiz olup olmaması için kullana bilirsiniz örnek vericek olur isek 

All in one seo alanlarının doldurulmasını istediğim için birinci parametre'ye true değeri gönderdim böylece all in one seo alanları dolduruldu 
``` php
$sBot->addPost(true);
```

İkinci örnek ise All in one seo ayarlarının doldurulmasını istedim ama eklenen yazıdan zaten sitemde var ise bir daha eklenmemesini istedim bundan dolayı ise ikinci parametre'ye de true değerini gönderdim 
``` php
$sBot->addPost(true,true);
```

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

``` php
$sBot->status="draft";
```

Yayını Zamanlama
===========================
Eklenen içeriği otomatik bir süre sonra yayınlanmasını istiyor iseniz time değişkenine tarihi göndermeniz gerekmektir göndereceğiniz tarih formatı  ( Y-m-d G:i:s / Y-m-d H:i:s  ) yani -> 2014-07-27 18:00:00 tarzı bir format biçiminde göndermeniz gerekir
örnek kullanımı
``` php
$sBot->time="2014-07-27 18:00:00";
```

Tüm Kullanımlar üstteki şekildedir eğer sorun yaşar iseniz  example.php dosyasına bakınız. örnek kullanımı bula bilirsiniz.

Author : Savaş Can Altun
Mail : savascanaltun@gmail.com
Web : http://savascanaltun.com.tr
