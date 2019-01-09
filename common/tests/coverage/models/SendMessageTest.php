<?php

namespace common\tests\unit\models;

use common\models\Messages;
use Yii;
use common\models\LoginForm;
use common\fixtures\MessagesFixture;
use common\fixtures\UserFixture;

/**
 * Login form test
 */
class SendMessageTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'messages' => [
                'class' => MessagesFixture::className(),
                'dataFile' => codecept_data_dir() . 'messages.php'
            ],
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function testSendMessageC0_NormalSend()
    {
        $from_id = 1;
        $to_id = 2;
        $message = "đằng ấy khỏe không?";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result);
    }

    public function testSendMessageC0_UnknownUser()
    {
        $from_id = 0;
        $to_id = 2;
        $message = "đằng ấy khỏe không?";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === -1);
    }

    public function testSendMessageC0_EmptyMessage()
    {
        $from_id = 1;
        $to_id = 2;
        $message = "";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === 0);
    }

    public function testSendMessageC1_KnownUserHasMessage()
    {
        $from_id = 1;
        $to_id = 2;
        $message = "đằng ấy khỏe không?";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result);
    }

    public function testSendMessageC1_KnownUserEmptyMessage()
    {
        $from_id = 1;
        $to_id = 2;
        $message = "";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === 0);
    }

    public function testSendMessageC1_UnknownUserHasMessage()
    {
        $from_id = 0;
        $to_id = 2;
        $message = "chào .-.";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === -1);
    }

    public function testSendMessageC1_UnknownUserEmptyMessage()
    {
        $from_id = 0;
        $to_id = 2;
        $message = "";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === -1);
    }

    public function testSendMessageC2_KnownFromKnownToHasMessage()
    {
        $from_id = 1;
        $to_id = 2;
        $message = "Test coverage C2 ;)";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result);
    }

    public function testSendMessageC2_KnownFromKnownToEmptyMessage()
    {
        $from_id = 1;
        $to_id = 2;
        $message = "";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === 0);
    }

    public function testSendMessageC2_KnownFromUnknownToHasMessage()
    {
        $from_id = 1;
        $to_id = 0;
        $message = "Test coverage C2 ;)";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === -1);
    }

    public function testSendMessageC2_KnownFromUnknownToEmptyMessage()
    {
        $from_id = 1;
        $to_id = 0;
        $message = "";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === -1);
    }

    public function testSendMessageC2_UnknownFromKnownToHasMessage()
    {
        $from_id = 0;
        $to_id = 2;
        $message = "Test coverage C2 ;)";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === -1);
    }

    public function testSendMessageC2_UnknownFromKnownToEmptyMessage()
    {
        $from_id = 0;
        $to_id = 2;
        $message = "";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === -1);
    }

    public function testSendMessageC2_UnknownFromUnknownToHasMessage()
    {
        $from_id = 0;
        $to_id = 3;
        $message = "Test coverage C2 ;)";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === -1);
    }

    public function testSendMessageC2_UnknownFromUnknownToEmptyMessage()
    {
        $from_id = 0;
        $to_id = 3;
        $message = "";

        $result = Messages::sendMessage($from_id, $to_id, $message);

        $this->assertTrue($result === -1);
    }


}
