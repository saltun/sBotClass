sBotClass
=========
require_once "sbotClass.php";

WordPress Bot Yazma Sınıfı ( Wordpress Bot Class ) 

- eklenti biçiminde kullanım için uygundur demo kullanım için example.php dosyasına bakınız.. 


Sınıfı Dahil Edelim
===========================
<pre>
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
Not : All in one seo kısımlarını otomatik doldurmasını ister iseniz true parametresini gönderiniz örnek 
<pre>
$sBot->addPost(true);
</pre>


Tüm Kullanımlar üstteki şekildedir eğer sorun yaşar iseniz  example.php dosyasına bakınız. örnek kullanımı bula bilirsiniz.

Author : Savaş Can Altun
Mail : savascanaltun@gmail.com
Web : savascanaltun.com.tr
