sBotClass
=========


WordPress Bot Yazma Sınıfı ( Wordpress Bot Class ) 

- Düz kullanım için example.php dosyasına bakınız eklenti biçiminde kullanmak için ise sBotPlugins klasörüne bakınız
- Eski 13.08.2014 güncellemesinden önceki sürümlerde wp-content/uploads/images dizini olmak zorundadır.

Dikkat ( Watch out! ) 
=========
Tr : 
Sınıf içerisindeki adresten resim download edip onu öne çıkarılmış olarak belirtirken resmin seo'ya uygun şekilde dosyanın adlanması için   "thumbnail" method'unu  "title" method'undan sonra kullanınız 

En : Whether to download pictures from addresses in the classroom as it highlighted the picture when specifying the file in accordance with seo be termed the "thumbnail" the method "title" method after use

Örnek ( example ) 
``` php
	$sBot->title="Örnek Yazı - ";
	$sBot->thumbnail =  $sBot->download_image("http://savascanaltun.com/sca.jpeg"); 
		
```

Not  : 
Eğer

I Love You Translate -_-

TR:Sınıfı yükleyip çalıştıralım
En:Let's run our class
===========================
``` php
require_once "sBotClass.php";

$sBot = new sBotClass();
```


Tr:İçerik için başlık belirleme
En:Set title to content
===========================
TR:Başlık eklemek için alttaki yöntem ile basitce içerik için title yani başlık belirliye bilirsiniz.
En:With the following that method you can add your content title.
``` php
$sBot->title="Deneme Başlık - Title ";
```

İçerik ( Content ) 
===========================
İçerik eklemek için ise basitce alttaki fonksiyonu kullanmanız yeterli.
``` php
$sBot->content="Deneme İçerik - Demo Content";
```

Güncellenmiş İçerik ( updated content )
===========================
Bildiğiniz gibi içeriklerinizde karşı siteden gelen resim dosyaları mevcut olabilir ama sBotClass ile gelen default özeliklerden biri olan new_content() fonksiyonu ile bu resimleri
kendi sunucunuza kaydedip linklerini güncellete bilirsiniz.
örnek kullanım alttadır.

``` php

$icerik='
<a href="http://savascanaltun.com.tr/wp-content/themes/sca2/images/logo.png"><img src="http://savascanaltun.com.tr/wp-content/themes/sca2/images/logo.png"  /></a>
';
echo $sBot->new_content($icerik);
```
Yukarıdaki kullanım biçiminde otomatik olarak içerik kısmındaki linkler kendi sitemize indirilmiş resim adresi ile güncellenecektir örnek bir görünüm alttaki tarz olacaktır.
``` html
<a href="http://siteadi.com/wp-content/uploads/images/baslik-12.jpg"><img src="http://siteadi.com/wp-content/uploads/images/baslik-12.jpg"  /></a>
<a href="http://siteadi.com/wp-content/uploads/images/baslik-123.jpg"><img src="http://siteadi.com/wp-content/uploads/images/baslik-123.jpg"></a>
```
 böylece içerikteki resimler kendi resimlerimiz ile güncellenmiş olacaktır.
Etiketler ( Tags ) 
===========================
İçeriğiniz için etiketleri tags parametresi ile göndere bilirsiniz. ( , ile ayırınız ) 
``` php
$sBot->tags="tags,etiket,savascanaltun,php";
```

Şifre  ( Password ) 
===========================
Oluşturulacak içerik için şifre yani koruma özelliği vermek istiyor iseniz password özelliğini kullana bilirsiniz.
``` php
$sBot->password="123456"; // 123456 şifresi konuya atandı
```


Açıklama ( Description) 
===========================
Açıklamayı ayarlamak normal değişken tanımlamak gibidir buradaki en önemli nokta 160 karakteri geçmemesidir bir çok arama motoru sadece 160 karakter görmektedir. 
all in one seo default olarak 160 karaktere'e içeriği bütünlemeye ayarlıdır bu özelliği kullanmaz iseniz içeriğiniz ilk 160 karakterini otomatik belirleyecektir.

``` php
$sBot->description="Yazımın açıklaması";
```
Uzun içerikleri 160 karaktere ayarlamak için ise shorten fonksiyonunu kullanmanız gerekmektedir

``` php
$sBot->description=$sBot->shorten("Yazımın açıklaması",160);
```
buradaki 160 sayısı kaç karaktere sınırlanacağını belirtir. bunu yükselte bilir veya azalta bilirsiniz. 

Kategori ( Category ) 
===========================
Kategori belirmek içni kullanmanız gereken parametre " cat " bunu sorunsuz kullanmak için wordpress  wp_dropdown_categories fonksiyonunu incelemenizi öneririz.


Kullanmanız gereken parametre 
``` php 
$sBot->cat
```


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

Ek olarak ayrıca eklenen yazının id değerini size geri çevirmektedir.   Örnek vermek gerekir ise ; 
``` php
echo $sBot->addPost(true,true); // return : 1 
```

Not : Geri dönen değer 0 ise içerik eklenmemiş 0 değil ise eklenmiş içeriğin numarasıdır. 




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

Kategori Oluşturma
===========================
Siteye yeni bir kategori eklemek isterseniz add_category fonksiyonunu kullanmanız yeterlidir kullanımı ve parametleri altta yer almaktadır.

- 1.Kategori Adı 
- 2.Kategori Açıklaması
- 3.Kategori kısa adresi ( slug adresi ) = Zorunlu değildir boş olur ise kategori adını slug yapıp ekler
Dönen değer 0 veya kategori id si olarak döner 0 döner ise işlem başarısızdır eklenirken hata olmuş demektir.
Not : yeni içerik eklenirken kullanıla bilir örnek $sBot->cat=$sBot->add_category.........
	
``` php
$sBot->add_category('Test Kategorisi','sBotClass ile oluşturuldu','test-kategorisi');
```


+ Özellikler
===========================
-> Kısaltma ( shorten ) 
``` php
$sBot->shorten("Yazı",Sayi);
örnek
$sBot->shorten("Savaş Can ALTUN",3);
-> Sav...
```

Tüm Kullanımlar üstteki şekildedir eğer sorun yaşar iseniz  example.php dosyasına bakınız. örnek kullanımı bula bilirsiniz.

Örnekler
===========================
example.php dosyası wordpress'e harici bir şekilde sınıfı kullanmanızı sağlar sBotPlugins klasörü ise wordpress'e eklenti biçiminde calışmanız için örnek bir uygulama sunar.

Author : [Savaş Can Altun](http://savascanaltun.com.tr)
Mail : savascanaltun@gmail.com
Web : [http://savascanaltun.com.tr](http://savascanaltun.com.tr)
