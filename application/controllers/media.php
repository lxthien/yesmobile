<?php
/**
 * @name		CodeIgniter Advanced Images
 * @author		Jens Segers
 * @link		http://www.jenssegers.be
 * @license		MIT License Copyright (c) 2012 Jens Segers
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media extends CI_Controller {
    
    public function resize() {
        // basic info
        $path = $this->uri->uri_string();
        //$pos = strrpos($path,"_");
        //$path = substr_replace($path,".",$pos,1);
        
        
        $path = str_replace("/media/","",$path);
        
        $pathinfo = pathinfo($path);
        $size = end(explode("-", $pathinfo["filename"]));
        $original = $pathinfo["dirname"] . "/" . str_ireplace("-crop-" . $size, "", $pathinfo["basename"]);
        
        // original image not found, show 404
        //var_dump($original);
        
        
        if (!file_exists($original)) {
            show_404($original);
        }
		
        // load the allowed image sizes
        $this->load->config("images");
        $sizes = $this->config->item("image_sizes");
        $allowed = FALSE;
        
        if (stripos($size, "x") !== FALSE) {
            // dimensions are provided as size
            @list($width, $height) = explode("x", $size);
            
            // security check, to avoid users requesting random sizes
            foreach ($sizes as $s) {
                if ($width == $s[0] && $height == $s[1]) {
                    $allowed = TRUE;
                    break;
                }
            }
        } else if (isset($sizes[$size])) {
            // optional, the preset is provided instead of the dimensions
            // NOTE: the controller will be executed EVERY time you request the image this way
            @list($width, $height) = $sizes[$size];
            $allowed = TRUE;
            
            // set the correct output path
            $path = str_ireplace($size, $width . "x" . $height, $path);
        }
        $isModify = false;
       
        if (file_exists($path)) {
            $isModify = false;
            $output = $path;
             
        }
        else
        {
            $isModify = true;
            // only continue with a valid width and height
            if ($allowed && $width >= 0 && $height >= 0) {
                // initialize library
                $config["source_image"] = $original;
                $config['new_image'] = $path;
                $config["width"] = $width;
                $config["height"] = $height;
                $config["dynamic_output"] = FALSE; // always save as cache
                
                $this->load->library('image_lib');
    			$this->image_lib->initialize($config);
    			
                $this->image_lib->fit();
            }
        
        // check if the resulting image exists, else show the original
            if (file_exists($path)) {
                $output = $path;
            }
            else
            {
                $output = $original;    
            }
            
        }
        
        $info = getimagesize($output);
        
        // output the image
        
        header("Content-Disposition: filename={$output};");
        header("Content-Type: {$info["mime"]}");
        header('Content-Transfer-Encoding: binary');
        /*
        header('Cache-Control: public');
        header('Expires: ' . date('D, d M Y H:i:s', time() + (60*60*24*100)) . ' GMT');
        header('Pragma: private');
        
        if($isModify)
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
        else
        {
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', -time()) . ' GMT');
            //header('HTTP/1.1 304 Not Modified');
            //exit;
        }*/
       
        /*
        $date = new DateTime();
        $timestamp =  $date->getTimestamp();
        $tsstring = gmdate('D, d M Y H:i:s ', $timestamp) . 'GMT';
        $etag =  $timestamp;
        //varchar($_SERVER['HTTP_IF_MODIFIED_SINCE']);
        $if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false;
        $if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? $_SERVER['HTTP_IF_NONE_MATCH'] : false;
        if ((($if_none_match && $if_none_match == $etag) || (!$if_none_match)) &&
            ($if_modified_since && $if_modified_since == $tsstring))
        {
            header('HTTP/1.1 304 Not Modified');
            exit();
        }
        else
        {
            header("Last-Modified: $tsstring");
            header("ETag: \"{$etag}\"");
        }
        */
        if($this->sendHTTPCacheHeaders($output,true))
            readfile($output);
        exit;
    }
    
/**
   * @return false if not cached or modified, true otherwise.
   * @param bool check_request set this to true if you want to check the client's request headers and "return" 304 if it makes sense. will only output the cache response headers otherwise.
   **/       
  protected function sendHTTPCacheHeaders($cache_file_name, $check_request = false)
  {
    $mtime = @filemtime($cache_file_name);

    if($mtime > 0)
    {
      $gmt_mtime = gmdate('D, d M Y H:i:s', $mtime) . ' GMT';
      $etag = sprintf('%08x-%08x', crc32($cache_file_name), $mtime);

      header('ETag: "' . $etag . '"');
      header('Last-Modified: ' . $gmt_mtime);
      header('Cache-Control: private');
      // we don't send an "Expires:" header to make clients/browsers use if-modified-since and/or if-none-match

      if($check_request)
      {
        if(isset($_SERVER['HTTP_IF_NONE_MATCH']) && !empty($_SERVER['HTTP_IF_NONE_MATCH']))
        {
          $tmp = explode(';', $_SERVER['HTTP_IF_NONE_MATCH']); // IE fix!
          if(!empty($tmp[0]) && strtotime($tmp[0]) == strtotime($gmt_mtime))
          {
            header('HTTP/1.1 304 Not Modified');
            return false;
          }
        }

        if(isset($_SERVER['HTTP_IF_NONE_MATCH']))
        {
          if(str_replace(array('\"', '"'), '', $_SERVER['HTTP_IF_NONE_MATCH']) == $etag)
          {
            header('HTTP/1.1 304 Not Modified');
            return false;
          }
        }
      }
    }

    return true;
  }
}