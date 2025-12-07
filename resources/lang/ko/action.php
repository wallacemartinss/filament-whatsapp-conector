<?php

declare(strict_types=1);

return [
    'send_message' => 'WhatsApp 메시지 보내기',
    'modal_heading' => 'WhatsApp 메시지 보내기',
    'modal_description' => 'WhatsApp 번호로 메시지를 보냅니다.',
    'send' => '메시지 보내기',

    // Form fields
    'instance' => '인스턴스',
    'instance_helper' => '메시지를 보낼 WhatsApp 인스턴스를 선택하세요.',
    'number' => '전화번호',
    'number_helper' => '국가 코드가 포함된 전화번호를 입력하세요 (예: 821012345678).',
    'type' => '메시지 유형',
    'message' => '메시지',
    'message_placeholder' => '여기에 메시지를 입력하세요...',
    'caption' => '캡션',
    'caption_placeholder' => '미디어의 선택적 캡션...',
    'media' => '미디어 파일',
    'media_helper' => '보낼 파일을 업로드하세요.',

    // Location fields
    'latitude' => '위도',
    'longitude' => '경도',
    'location_name' => '장소 이름',
    'location_name_placeholder' => '예: 내 사무실',
    'location_address' => '주소',
    'location_address_placeholder' => '예: 서울시 강남구 123',

    // Contact fields
    'contact_name' => '연락처 이름',
    'contact_number' => '연락처 전화번호',

    // Notifications
    'success_title' => '메시지 전송 완료!',
    'success_body' => 'WhatsApp 메시지가 성공적으로 전송되었습니다.',
    'error_title' => '전송 실패',
    'missing_required_fields' => '인스턴스 ID와 전화번호가 필요합니다.',
    'unsupported_type' => '지원되지 않는 메시지 유형입니다.',
];
