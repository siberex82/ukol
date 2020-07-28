<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 14.05.2020
 * Time: 3:13
 */

namespace bin\main;

use \Dotenv\Dotenv;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use \Mpdf\Mpdf;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;
use Sinergi\BrowserDetector\Language;

class container {

    public static function env()
    {
        $dotenv = Dotenv::createImmutable(_ROOT."config");
        $dotenv->load();
    }

    //============================================

    public function twig()
    {
        $loader = new FilesystemLoader(_TEMPLATES);
        return new Environment($loader);
    }

    //============================================

    public static function monolog()
    {

        $log = new Logger('Alert!');
        $log->pushHandler(new StreamHandler(_LOGS."system.error.ini", Logger::WARNING));

        return $log;
        //$log->warning('Foo');
    }

    //============================================
    public function mpdf()
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    }

    //============================================

    public function swift()
    {

        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
            ->setUsername('your username')
            ->setPassword('your password')
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['john@doe.com' => 'John Doe'])
            ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
            ->setBody('Here is the message itself')
        ;

        // Send the message
        $result = $mailer->send($message);

        // Sendmail
        // $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');
    }

    //============================================

    public static function browserDetector()
    {
        $browser = new Browser();

        if ($browser->getName() === Browser::IE && $browser->getVersion() < 11) {
            echo 'Please upgrade your browser.';
        }
    }

    //============================================

    public static function osDetector()
    {
        $os = new Os();

        if ($os->getName() === Os::IOS) {
            echo 'You are using an iOS device.';
        }
    }

    //============================================

    public static function langDetector()
    {
        $language = new Language();

        if ($language->getLanguage() === 'de') {
            echo 'Get this website in german.';
        }
    }
}