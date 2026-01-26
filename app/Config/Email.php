<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'helpminipul@gmail.com';
    public string $fromName   = 'PASTI HMJTI';
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';

public $protocol = 'smtp';
public $SMTPHost = 'smtp.gmail.com';
public $SMTPUser = 'helpminipul@gmail.com';
public $SMTPPass = 'vmjnoehu lrip mrfr';  // App Password Gmail
public $SMTPPort = 587;
public $SMTPCrypto = 'tls';

    public bool   $SMTPKeepAlive = false;
    public int    $SMTPTimeout = 5;

    public bool $wordWrap = true;
    public int  $wrapChars = 76;

    public string $mailType = 'text';
    public string $charset  = 'UTF-8';
    public bool   $validate = true;

    public int    $priority = 3;

    public string $CRLF    = "\r\n";
    public string $newline = "\r\n";

    public bool $BCCBatchMode = false;
    public int  $BCCBatchSize = 200;
    public bool $DSN = false;
}
