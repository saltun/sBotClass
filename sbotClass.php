<?php
/*
* Author : Savaş Can Altun
* Web : http://savascanaltun.com.tr
* Mail : savascanaltun@gmail.com
* GİT : http://github.com/saltun
* Date : 22.06.2014
* Update : 19.03.2015
*/

cLass sBotClass{

public $thumbnail;
public $title;
public $content;
public $author=1;
public $tags;
public $cat;
public $metas;
public $status="publish";
public $time=NULL;
public $description=NULL;

  public function __construct(){

        if(!function_exists('wp_get_current_user')) {
              include(ABSPATH . "wp-includes/pluggable.php"); 
        }

        if (!function_exists('wp_insert_category')) {
           include(ABSPATH . "wp-admin/includes/taxonomy.php"); 
        }
                
    }

  function shorten($keyword, $str = 10)
    {
          if (strlen($keyword) > $str)
          {
            if (function_exists("mb_substr")) $keyword = mb_substr($keyword, 0, $str, "UTF-8").'..';
            else $keyword = substr($keyword, 0, $str).'..';
          }
          return $keyword;
    }


  public function sef($s) {
        $tr = array('ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç');
        $eng = array('s','s','i','i','g','g','u','u','o','o','c','c');
        $s = str_replace($tr,$eng,$s);
        $s = strtolower($s);
        $s = preg_replace('/[^%a-z0-9 _-]/', '', $s);
        $s = preg_replace('/\s+/', '-', $s);
        $s = preg_replace('|-+|', '-', $s);
        $s = trim($s, '-');
       return $s;
    }

  public function download_image($url){
      
        /* konu var ise resimleri indirme ! */
         $xs = get_page_by_title( $this->title, OBJECT, 'post' );
          if (!$xs) {
            
          }else{
                return false;
          }


          $savepath = ABSPATH."wp-content/uploads/images/";

          if (!file_exists($savepath)) {
            mkdir($savepath, 0777);
          }
          $file = explode('/',$url);
          $count = count($file);
          $fullfilename = $this->sef($this->title)."-".rand(0,100000).".jpg";

         if (!extension_loaded(curl)) { 
                die("Extension yuklu  degil socket deneyebilirsin"); 
            } 

          $ch = curl_init("$url"); 
          if (!$ch) { 
              die("Curl oturumu baslatamadim.."); 
          } 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch); 
        curl_close($ch); 


        $islem = fopen($savepath.$fullfilename,'w+'); 
        fwrite($islem, $data); 
        fclose($islem); 

       return  "/path/to/wp-content/uploads/images/".$fullfilename;
          
  }

  public function save_image($par){

    /* save content image */

    $newlink=$this->download_image($par);
    $newlink=str_replace("/path/to/","",$newlink);
    return get_site_url()."/".$newlink; 


  }

  /* new content ( image download new link ) */
  public function new_content($kaynak){
        $desen='#\bhttps?:\/\/\S+(?:png|jpg|gif|Jpeg)#si';
        preg_match_all($desen,$kaynak,$linkler);
        $linkler=array_unique($linkler[0]);
        foreach ($linkler as  $link) {
              $newlink=$this->save_image($link);
              $kaynak=str_replace($link,$newlink,$kaynak);
        }
        return  $kaynak;

  }



  public function addPost($allinoneseo=false,$varyok=false){

      if ($varyok==true) {
         $xs = get_page_by_title( sanitize_title($this->title), OBJECT, 'post' );
          if (!$xs) {
            
          }else{
            return false;
          }
      }
       

            $my_post = array();
            $my_post['post_title'] = sanitize_title($this->title);
            $my_post['post_content'] = $this->content;
            $my_post['post_date'] = $this->time;
            $my_post['post_date_gmt'] = $this->time;
            $my_post['post_status'] =  $this->status;
            $my_post['post_author'] = $this->author;
            $my_post['post_category'] = array($this->cat);
            $my_post['tags_input'] = $this->tags;


            remove_filter('content_save_pre', 'wp_filter_post_kses');
            remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');
          
           $post_id= wp_insert_post( $my_post );
      
                  
            add_filter('content_save_pre', 'wp_filter_post_kses');
            add_filter('content_filtered_save_pre', 'wp_filter_post_kses');
               
          if ($allinoneseo) {

            if (empty($this->description)) {
             $defaultdesc=strip_tags($this->content);
              $this->description=$this->shorten($defaultdesc,160);
            }
            
            // all in one seo
                add_post_meta($post_id,"_aioseop_title",$this->title);
                add_post_meta($post_id,"_aioseop_description",$this->description);
                add_post_meta($post_id,"_aioseop_keywords",$this->tags);
              // all in one seo 
          }


          // add meta tags ( çzel alanları ekle )
          if (isset($this->metas)) {
              $count=count($this->metas);


  
                $keys=array_keys($this->metas);
                $values=array_values($this->metas);
                  for ($i=0; $i < $count; $i++) { 
                          add_post_meta($post_id,$keys[$i],$values[$i]);
                  }
          }
              

   
          $filename = $this->thumbnail;

   
          $filetype = wp_check_filetype( basename( $filename ), null );

          
          $wp_upload_dir = wp_upload_dir();

          $attachment = array(
            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
            'post_mime_type' => $filetype['type'],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content'   => '',
            'post_status'    => 'inherit'
          );


          $attachment_id=wp_insert_attachment($attachment, $filename, $post_id);



          require_once( ABSPATH . 'wp-admin/includes/image.php' );
          $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
          wp_update_attachment_metadata( $attach_id, $attach_data );
          set_post_thumbnail($post_id,$attachment_id);

  }

  public function add_category($name,$description,$slug=NULL){

       $cat = array('cat_name' => $name,'category_description' => $description,'category_nicename' => $slug,'category_parent' => '' );
        return $cat_id = wp_insert_category($cat);

  }


}


?>
