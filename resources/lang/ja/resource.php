<?php

declare(strict_types=1);

return [
    'navigation_label' => 'インスタンス',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'インスタンス',
    'plural_model_label' => 'インスタンス',

    'sections' => [
        'instance_info' => 'インスタンス情報',
        'settings' => '設定',
        'connection' => '接続',
    ],

    'fields' => [
        'name' => 'インスタンス名',
        'name_helper' => 'このインスタンスを識別するための一意の名前',
        'number' => '電話番号',
        'number_helper' => '国番号付きのWhatsApp電話番号',
        'status' => 'ステータス',
        'profile_picture' => 'プロフィール画像',
        'reject_call' => '通話を拒否',
        'reject_call_helper' => '着信を自動的に拒否する',
        'msg_call' => '拒否メッセージ',
        'msg_call_helper' => '通話を拒否する際に送信されるメッセージ',
        'groups_ignore' => 'グループを無視',
        'groups_ignore_helper' => 'グループからのメッセージを処理しない',
        'always_online' => '常にオンライン',
        'always_online_helper' => 'ステータスをオンラインに保つ',
        'read_messages' => 'メッセージを既読',
        'read_messages_helper' => 'メッセージを自動的に既読にする',
        'read_status' => 'ステータスを表示',
        'read_status_helper' => 'ステータス更新を自動的に表示する',
        'sync_full_history' => '完全な履歴を同期',
        'sync_full_history_helper' => '接続時にすべてのメッセージ履歴を同期する',
        'created_at' => '作成日時',
        'updated_at' => '更新日時',
    ],

    'actions' => [
        'connect' => '接続',
        'disconnect' => '切断',
        'delete' => '削除',
        'refresh' => '更新',
        'view_qrcode' => 'QRコードを表示',
        'close' => '閉じる',
        'back' => 'リストに戻る',
    ],

    'messages' => [
        'created' => 'インスタンスが正常に作成されました',
        'updated' => 'インスタンスが正常に更新されました',
        'deleted' => 'インスタンスが正常に削除されました',
        'connected' => 'インスタンスが正常に接続されました',
        'disconnected' => 'インスタンスが正常に切断されました',
        'connection_failed' => 'インスタンスの接続に失敗しました',
    ],
];
