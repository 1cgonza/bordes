<?php

/**
 * Plugin Name: oEmbed Featured Image
 * Plugin URI: http://wordpress.stackexchange.com/q/70752/1685
 * Description: Automatically set the featured image if an oEmbed-compatible embed is found in the post content.
 * Version: 1.0
 * Author: TheDeadMedic
 * Author URI: http://wordpress.stackexchange.com/users/1685/thedeadmedic
 *
 * @package oEmbed_Featured_Image
 */

add_action('wp_insert_post', array('ofi', 'init'));

/**
 * @package oEmbed_Featured_Image
 */
class ofi {
  /**
   * The post thumbnail ID
   *
   * @var int
   */
  private $_thumb_id;

  /**
   * The post ID
   *
   * @var int
   */
  private $_post_id;

  /**
   * Sets up an instance if called statically, and attempts to set the featured
   * image from an embed in the post content (if one has not already been set).
   *
   * @param  int $post_id
   * @return object|null
   */
  public function init($post_id) {
    if (!isset($this)) {
      return new ofi($post_id);
    }

    global $wp_embed;

    $this->_post_id = absint($post_id);
    $prefix = 'bordes_';

    if (!$this->_thumb_id = get_post_meta($this->_post_id, '_thumbnail_id', true)) {
      if ($videoURL = get_post_meta($this->_post_id, $prefix . 'embed', true)) {
        parse_str(parse_url($videoURL, PHP_URL_QUERY), $urlVars);
        $videoID = $urlVars['v'];
        $imgUrl = 'https://i3.ytimg.com/vi/' . $videoID . '/maxresdefault.jpg';
        $title = get_post_field('post_name', $this->_post_id, 'raw');
        $this->set_thumb_by_url($imgUrl, $title);
      }
    }
  }

  /**
   * @see init()
   */
  public function __construct($post_id) {
    $this->init($post_id);
  }

  /**
   * Callback for the "oembed_dataparse" hook, which will fire on a successful
   * response from the oEmbed provider.
   *
   * @see WP_oEmbed::data2html()
   *
   * @param string $return The embed HTML
   * @param object $data   The oEmbed response
   * @param string $url    The oEmbed content URL
   */
  public function oembed_dataparse($return, $data, $url) {
    if (!empty($data->thumbnail_url) && !$this->_thumb_id) {
      $this->set_thumb_by_url($data->thumbnail_url, @$data->title);
    }
  }

  /**
   * Attempt to download the image from the URL, add it to the media library,
   * and set as the featured image.
   *
   * @see media_sideload_image()
   *
   * @param string $url
   * @param string $title Optionally set attachment title
   */
  public function set_thumb_by_url($url, $title = null) {
    /* Following assets will already be loaded if in admin */
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $temp = download_url($url);

    if (!is_wp_error($temp) && $info = @getimagesize($temp)) {
      if (!strlen($title)) {
        $title = null;
      }

      if (!$ext = image_type_to_extension($info[2])) {
        $ext = '.jpg';
      }


      $data = array(
        'name' => md5($url) . $ext,
        'tmp_name' => $temp,
      );

      $id = media_handle_sideload($data, $this->_post_id, $title);
      if (!is_wp_error($id))
        return update_post_meta($this->_post_id, '_thumbnail_id', $this->_thumb_id = $id);
    }

    if (!is_wp_error($temp))
      @unlink($temp);
  }
}
