<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'country_id',
        'code',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public static $names = [
        'Telegram',
        'WhatsApp',
        'Facebook',
        'PayPal',
        'Gmail',
        'Discord',
        'Tinder',
        '* Other Website *',
        'Uber',
        'Mail.RU',
        'Microsoft(Hotmail)',
        'Protonmail',
        'Foodpanda',
        'Blizzard',
        'Amazon',
        'VK',
        'Yandex',
        'eBay',
        'Twitter',
        'Viber',
        'ICQ',
        'Bolt',
        'Qiwi',
        'Steam',
        'Instagram',
        'VK.com',
        'WeChat',
        'DiDi',
        'Snapchat',
        'TikTok',
        'Avito',
        'BitClout',
        'Foodora',
        'Netflix',
        'TaoBao',
        'Twilio',
        'AOL',
        'Tencent QQ',
        'LINE',
        'LinkedIn',
        'Eneba',
        'Naver',
        'WebMoney',
        'League of Legends',
        'Youtube',
        'OlaCabs',
        'Nike',
        'KakaoTalk',
        'LocalBitcoins',
        'Nifty',
        'Airbnb',
        'Drom.RU',
        'Fiverr',
        'JD.com',
        'MeetMe',
        'Ubank.ru',
        'TIER',
        'TradingView',
        '1688.com',
        'Adidas',
        'Auto.RU',
        'Badoo',
        'BetFair',
        'BurgerKing',
        'CDKeys.com',
        'Careem',
        'CityMobil',
        'Craigslist',
        'DENT',
        'Dodopizza',
        'DoorDash',
        'Drug Vokrug',
        'Dukascopy',
        'Enjin Wallet',
        'Skrill',
        'Fastmail',
        'Fotostrana',
        'G2A',
        'Gameflip',
        'GetTaxi',
        'GrabTaxi',
        'Grailed',
        'HQ Trivia',
        'Holvi',
        'ICard',
        'Keybase',
        'Kriptomat.io',
        'Lazada',
        'LiveScore',
        'Lyft',
        'MS Office',
        'Mamba',
        'MiChat',
        'OD',
        'OLX',
        'Plenty Of Fish',
        'Post Bank',
        'Rambler',
        'SEOsprint.net',
        'Saicmobility',
        'Sipnet.ru',
        'Spotify',
        'Steemit',
        'Soumi24',
        'TAN',
        'Taxi Maksim',
        'The Insiders',
        'Tinkoff',
        'Weebly',
        'PapaJohns',
    ];

    /**
     * A website has many verifications
     */
    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }

    /**
     * A website belongs to a country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
