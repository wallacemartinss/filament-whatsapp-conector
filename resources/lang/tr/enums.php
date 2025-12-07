<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Bağlı',
        'connecting' => 'Bağlanıyor',
        'close' => 'Bağlantı Kesildi',
        'refused' => 'Reddedildi',
    ],

    'message_type' => [
        'text' => 'Metin',
        'image' => 'Resim',
        'audio' => 'Ses',
        'video' => 'Video',
        'document' => 'Belge',
        'location' => 'Konum',
        'contact' => 'Kişi',
        'sticker' => 'Çıkartma',
    ],

    'message_direction' => [
        'incoming' => 'Gelen',
        'outgoing' => 'Giden',
    ],

    'message_status' => [
        'pending' => 'Beklemede',
        'sent' => 'Gönderildi',
        'delivered' => 'Teslim Edildi',
        'read' => 'Okundu',
        'failed' => 'Başarısız',
    ],

    'webhook_event' => [
        'application_startup' => 'Uygulama Başlatma',
        'qrcode_updated' => 'QR Kodu Güncellendi',
        'connection_update' => 'Bağlantı Güncellemesi',
        'messages_set' => 'Mesajlar Ayarlandı',
        'messages_upsert' => 'Mesaj Alındı',
        'messages_update' => 'Mesaj Güncellendi',
        'messages_delete' => 'Mesaj Silindi',
        'send_message' => 'Mesaj Gönderildi',
        'presence_update' => 'Durum Güncellemesi',
        'new_token' => 'Yeni Token',
        'logout_instance' => 'Örnek Çıkışı',
        'remove_instance' => 'Örnek Kaldırıldı',
    ],
];
