<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => '연결됨',
        'connecting' => '연결 중',
        'close' => '연결 해제됨',
        'refused' => '거부됨',
    ],

    'message_type' => [
        'text' => '텍스트',
        'image' => '이미지',
        'audio' => '오디오',
        'video' => '비디오',
        'document' => '문서',
        'location' => '위치',
        'contact' => '연락처',
        'sticker' => '스티커',
    ],

    'message_direction' => [
        'incoming' => '수신',
        'outgoing' => '발신',
    ],

    'message_status' => [
        'pending' => '대기 중',
        'sent' => '전송됨',
        'delivered' => '전달됨',
        'read' => '읽음',
        'failed' => '실패',
    ],

    'webhook_event' => [
        'application_startup' => '애플리케이션 시작',
        'qrcode_updated' => 'QR 코드 업데이트',
        'connection_update' => '연결 업데이트',
        'messages_set' => '메시지 설정',
        'messages_upsert' => '메시지 수신',
        'messages_update' => '메시지 업데이트',
        'messages_delete' => '메시지 삭제',
        'send_message' => '메시지 전송',
        'presence_update' => '상태 업데이트',
        'new_token' => '새 토큰',
        'logout_instance' => '인스턴스 로그아웃',
        'remove_instance' => '인스턴스 제거',
    ],
];
