<?php
/*
* Author : Savaş Can Altun
* Web : http://savascanaltun.com.tr
* Mail : savascanaltun@gmail.com
* GİT : http://github.com/saltun
* Date : 22.06.2014
*/

cLass sBotClass{

public $thumbnail;
public $title;
public $content;
public $author;
public $tags;
public $cat;


  public function __construct(){

        if(!function_exists('wp_get_current_user')) {
              include(ABSPATH . "wp-includes/pluggable.php"); 
        }
          if (empty($this->author)) {
                 $this->author=1;
             }       
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
    

    
          $savepath = "../wp-content/uploads/images/";
          $file = explode('/',$url);
          $count = count($file);
          $fullfilename = $this->sef($this->title)."-".rand(0,100000).".jpg";
          
          if(function_exists('curl_init'))
          {
          $fp = fopen($savepath.$fullfilename,'w+');
          $ch = curl_init();
          curl_setopt($ch , CURLOPT_URL, $url);
          curl_setopt($ch , CURLOPT_USERAGENT, 'firefox/2.0.11');
          curl_setopt($ch , CURLOPT_FILE, $fp);
          curl_setopt( $ch , CURLOPT_FOLLOWLOCATION , 1 );

          curl_exec($ch);
          curl_close($ch);
          fclose($fp);
          }
          else
          {
          copy($url,$savepath.$fullfilename); 
          }  

          return  "/path/to/wp-content/uploads/images/".$fullfilename;
  }


  public function addPost($allinoneseo=false){


            $my_post = array();
            $my_post['post_title'] =  $this->title;
            $my_post['post_content'] = $this->content;
            $my_post['post_status'] = 'publish';
            $my_post['post_author'] = $this->content;
            $my_post['post_category'] = array($this->cat);
            $my_post['tags_input'] = $this->tags;

            $post_id= wp_insert_post( $my_post );
         
         	if ($allinoneseo) {
	         	// all in one seo
		            add_post_meta($post_id,"_aioseop_title",$this->title);
		            add_post_meta($post_id,"_aioseop_description",$this->content);
		            add_post_meta($post_id,"_aioseop_keywords",$this->tags);
	            // all in one seo 
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


}


?>
