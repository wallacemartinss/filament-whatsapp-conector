<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Örnekler',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Örnek',
    'plural_model_label' => 'Örnekler',

    'sections' => [
        'instance_info' => 'Örnek Bilgisi',
        'settings' => 'Ayarlar',
        'connection' => 'Bağlantı',
    ],

    'fields' => [
        'name' => 'Örnek Adı',
        'name_helper' => 'Bu örneği tanımlamak için benzersiz bir ad',
        'number' => 'Telefon Numarası',
        'number_helper' => 'Ülke kodu ile WhatsApp telefon numarası',
        'status' => 'Durum',
        'profile_picture' => 'Profil Resmi',
        'reject_call' => 'Aramaları Reddet',
        'reject_call_helper' => 'Gelen aramaları otomatik olarak reddet',
        'msg_call' => 'Reddetme Mesajı',
        'msg_call_helper' => 'Arama reddedildiğinde gönderilen mesaj',
        'groups_ignore' => 'Grupları Yoksay',
        'groups_ignore_helper' => 'Gruplardan gelen mesajları işleme',
        'always_online' => 'Her Zaman Çevrimiçi',
        'always_online_helper' => 'Durumu çevrimiçi olarak tut',
        'read_messages' => 'Mesajları Oku',
        'read_messages_helper' => 'Mesajları otomatik olarak okundu işaretle',
        'read_status' => 'Durumu Oku',
        'read_status_helper' => 'Durum güncellemelerini otomatik olarak görüntüle',
        'sync_full_history' => 'Tam Geçmişi Senkronize Et',
        'sync_full_history_helper' => 'Bağlantıda tüm mesaj geçmişini senkronize et',
        'created_at' => 'Oluşturulma',
        'updated_at' => 'Güncellenme',
    ],

    'actions' => [
        'connect' => 'Bağlan',
        'disconnect' => 'Bağlantıyı Kes',
        'delete' => 'Sil',
        'refresh' => 'Yenile',
        'view_qrcode' => 'QR Kodunu Görüntüle',
        'close' => 'Kapat',
        'back' => 'Listeye Dön',
    ],

    'messages' => [
        'created' => 'Örnek başarıyla oluşturuldu',
        'updated' => 'Örnek başarıyla güncellendi',
        'deleted' => 'Örnek başarıyla silindi',
        'connected' => 'Örnek başarıyla bağlandı',
        'disconnected' => 'Örnek başarıyla bağlantısı kesildi',
        'connection_failed' => 'Örnek bağlantısı başarısız',
    ],
];
