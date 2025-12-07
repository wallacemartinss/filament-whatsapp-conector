<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => '接続済み',
        'connecting' => '接続中',
        'close' => '切断済み',
        'refused' => '拒否済み',
    ],

    'message_type' => [
        'text' => 'テキスト',
        'image' => '画像',
        'audio' => '音声',
        'video' => '動画',
        'document' => 'ドキュメント',
        'location' => '位置情報',
        'contact' => '連絡先',
        'sticker' => 'ステッカー',
    ],

    'message_direction' => [
        'incoming' => '受信',
        'outgoing' => '送信',
    ],

    'message_status' => [
        'pending' => '保留中',
        'sent' => '送信済み',
        'delivered' => '配信済み',
        'read' => '既読',
        'failed' => '失敗',
    ],

    'webhook_event' => [
        'application_startup' => 'アプリケーション起動',
        'qrcode_updated' => 'QRコード更新',
        'connection_update' => '接続更新',
        'messages_set' => 'メッセージ設定',
        'messages_upsert' => 'メッセージ受信',
        'messages_update' => 'メッセージ更新',
        'messages_delete' => 'メッセージ削除',
        'send_message' => 'メッセージ送信',
        'presence_update' => 'プレゼンス更新',
        'new_token' => '新しいトークン',
        'logout_instance' => 'インスタンスログアウト',
        'remove_instance' => 'インスタンス削除',
    ],
];
