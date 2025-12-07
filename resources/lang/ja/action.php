<?php

declare(strict_types=1);

return [
    'send_message' => 'WhatsAppメッセージを送信',
    'modal_heading' => 'WhatsAppメッセージを送信',
    'modal_description' => 'WhatsApp番号にメッセージを送信します。',
    'send' => 'メッセージを送信',

    // Form fields
    'instance' => 'インスタンス',
    'instance_helper' => 'メッセージを送信するWhatsAppインスタンスを選択してください。',
    'number' => '電話番号',
    'number_helper' => '国番号付きの電話番号を入力してください（例：819012345678）。',
    'type' => 'メッセージタイプ',
    'message' => 'メッセージ',
    'message_placeholder' => 'ここにメッセージを入力...',
    'caption' => 'キャプション',
    'caption_placeholder' => 'メディアのオプションキャプション...',
    'media' => 'メディアファイル',
    'media_helper' => '送信するファイルをアップロードしてください。',

    // Location fields
    'latitude' => '緯度',
    'longitude' => '経度',
    'location_name' => '場所名',
    'location_name_placeholder' => '例：私のオフィス',
    'location_address' => '住所',
    'location_address_placeholder' => '例：東京都渋谷区1-2-3',

    // Contact fields
    'contact_name' => '連絡先名',
    'contact_number' => '連絡先電話番号',

    // Notifications
    'success_title' => 'メッセージ送信完了！',
    'success_body' => 'WhatsAppメッセージが正常に送信されました。',
    'error_title' => '送信失敗',
    'missing_required_fields' => 'インスタンスIDと電話番号は必須です。',
    'unsupported_type' => 'サポートされていないメッセージタイプです。',
];
