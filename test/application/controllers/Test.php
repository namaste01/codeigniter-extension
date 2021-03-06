<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \X\Util\Logger;
use \X\Util\Image;

/**
 * Test
 *
 * @author     Takuya Motoshima <https://www.facebook.com/takuya.motoshima.7>
 * @license    MIT License
 * @copyright  2017 Takuya Motoshima
 */
class Test extends AppController
{

  protected $model = 'TestModel';

  /**
   * @Security
   */
  public function index()
  {
  }


  public function image_resize()
  {
    foreach (glob($image_path = FCPATH . 'img/*') as $image_path) {
      Logger::s('$image_path=', $image_path);
      Image::resize($image_path, 80);
    }
  }

  public function amazon_ses()
  {
    $notification = Loader::config('application', 'notification');
    Logger::d('$notification=', $notification);
    $email_amazon_ses = new EMailAmazonSes([
      'credentials' => [
        'key'    => 'Your key(Required)',
        'secret' => 'Your secret(Required)'
      ],
      'configuration' => 'Your configuration',
      'region' => 'Your region(Required)',
      'version' => 'latest',
    ]);
    $email_amazon_ses
      ->from('from@example.org', 'Name of from')
      ->to('to@example.org')
      ->message_from_xml('email/ja/example')
      ->send();
  }

  public function transaction()
  {
    $this->TestModel->transaction();
  }
}