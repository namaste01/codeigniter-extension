<?php
/**
 * Email util class
 *
 * @author     Takuya Motoshima <https://www.facebook.com/takuya.motoshima.7>
 * @license    MIT License
 * @copyright  2017 Takuya Motoshima
 */
namespace X\Util;
abstract class EMail
{

  private static $default = [
    // 'useragent' => 'CodeIgniter',
    // 'protocol' => 'mail',
    // 'mailpath' => '/usr/sbin/sendmail',
    // 'smtp_host' => null,
    // 'smtp_user' => null,
    // 'smtp_pass' => null,
    // 'smtp_port' => 25,
    // 'smtp_timeout' => 5,
    // 'smtp_keepalive' => false,
    // 'smtp_crypto' => null,
    'wordwrap' => false,
    // 'wrapchars' => 76,
    'mailtype' => 'text',
    'charset' => 'utf-8',
    // 'validate' => false,
    'priority' => 1,
    'crlf' => "\r\n",
    'newline' => "\r\n",
    // 'bcc_batch_mode' => false,
    // 'bcc_batch_size' => 200,
    // 'dsn' => false,
  ];

  /**
   * Initialize preferences
   *
   * @param   string
   * @return  string
   */
  public static function initialize(array $config = array()): string
  {
    self::email()->initialize(array_merge(self::$default, $config));
    return __CLASS__;
  }

  /**
   * Send Email
   *
   * @param   bool    $auto_clear = TRUE
   * @return  bool
   */
  public static function send($auto_clear = TRUE):bool
  {
    return call_user_func_array([self::email(), __FUNCTION__], func_get_args());
  }

  /**
   * Set FROM
   *
   * @param   string  $from
   * @param   string  $name
   * @param   string  $return_path = NULL Return-Path
   * @return  string
   */
  public static function from($from, $name = '', $return_path = NULL): string
  {
    call_user_func_array([self::email(), __FUNCTION__], func_get_args());
    return __CLASS__;
  }

  /**
   * Set Recipients
   *
   * @param   string
   * @return  string
   */
  public static function to($to): string
  {
    call_user_func_array([self::email(), __FUNCTION__], func_get_args());
    return __CLASS__;
  }

  /**
   * Set BCC
   *
   * @param   string
   * @param   string
   * @return  string
   */
  public static function bcc($bcc, $limit = ''): string
  {
    call_user_func_array([self::email(), __FUNCTION__], func_get_args());
    return __CLASS__;
  }

  /**
   * Set Email Subject
   *
   * @param   string
   * @return  string
   */
  public static function subject($subject): string
  {
    call_user_func_array([self::email(), __FUNCTION__], func_get_args());
    return __CLASS__;
  }

  /**
   * Set Body
   *
   * @param   string
   * @return  string
   */
  public static function message($body): string
  {
    call_user_func_array([self::email(), __FUNCTION__], func_get_args());
    return __CLASS__;
  }

  /**
   * Set Body
   *
   * @param   string
   * @param   array
   * @return  string
   */
  public static function messageFromTemplate(string $path, array $vars = []): string
  {
    self::message(self::template()->load($path, $vars));
    return __CLASS__;
  }

  /**
   * Set Body
   *
   * @param   string
   * @param   array
   * @return  string
   */
  public static function messageFromXml(string $path, array $vars = []): string
  {
    $xml = new \SimpleXMLElement(self::template()->load($path, $vars, 'xml'));
    self
      ::subject((string) $xml->subject)
      ::message(preg_replace('/^(\r\n|\n|\r)|(\r\n|\n|\r)$/', '', (string) $xml->message));
    return __CLASS__;
  }

  /**
   * Set mail type
   *
   * @param   string
   * @return  string
   */
  public static function mailType($type = 'text'): string
  {
    call_user_func_array([self::email(), __FUNCTION__], func_get_args());
    return __CLASS__;
  }

  /**
   * Assign file attachments
   *
   * @param string  $file Can be local path, URL or buffered content
   * @param string  $disposition = 'attachment'
   * @param string  $newname = NULL
   * @param string  $mime = ''
   * @return  CI_Email
   */
  public static function attach($file, $disposition = '', $newname = NULL, $mime = '')
  {
    call_user_func_array([self::email(), __FUNCTION__], func_get_args());
    return __CLASS__;
  }

  /**
   * Set and return attachment Content-ID
   *
   * Useful for attached inline pictures
   *
   * @param string  $filename
   * @return  string
   */
  public static function attachmentCid($filename)
  {
    return call_user_func_array([self::email(), __FUNCTION__], func_get_args());
  }

  /**
   * Get CI_Email instance
   *
   * @return \CI_Email
   */
  private static function email(): \CI_Email
  {
    static $email;
    if (!isset($email)) {
      $ci =& \get_instance();
      $ci->load->library('email', self::$default);
      $email = $ci->email;
    }
    return $email;
  }

  /**
   * Get Template instance
   *
   * @return \X\Util\Template
   */
  private static function template(): \X\Util\Template
  {
    static $template;
    return $template ?? new \X\Util\Template();
  }
}