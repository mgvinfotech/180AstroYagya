<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class SmtpSetting extends Model
{
    protected $fillable = [
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
        'mail_from_name',
        'admin_notification_email',
        'is_active',
    ];

    /**
     * Apply this SMTP setting dynamically to Laravel's Mail config at runtime.
     */
    public function applyToConfig(): void
    {
        if (!$this->is_active || empty($this->mail_host)) {
            return;
        }

        Config::set('mail.default', $this->mail_mailer ?: 'smtp');
        Config::set('mail.mailers.smtp.transport', 'smtp');
        Config::set('mail.mailers.smtp.host', $this->mail_host);
        Config::set('mail.mailers.smtp.port', (int) ($this->mail_port ?: 587));
        Config::set('mail.mailers.smtp.encryption', $this->mail_encryption ?: null);
        Config::set('mail.mailers.smtp.username', $this->mail_username);
        Config::set('mail.mailers.smtp.password', $this->mail_password);
        Config::set('mail.from.address', $this->mail_from_address ?: 'contact@108astroyagya.com');
        Config::set('mail.from.name', $this->mail_from_name ?: '108 Astro Yagya');
    }
}
