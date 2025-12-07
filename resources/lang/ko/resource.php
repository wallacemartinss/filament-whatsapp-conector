<?php

declare(strict_types=1);

return [
    'navigation_label' => '인스턴스',
    'navigation_group' => 'WhatsApp',
    'model_label' => '인스턴스',
    'plural_model_label' => '인스턴스',

    'sections' => [
        'instance_info' => '인스턴스 정보',
        'settings' => '설정',
        'connection' => '연결',
    ],

    'fields' => [
        'name' => '인스턴스 이름',
        'name_helper' => '이 인스턴스를 식별하기 위한 고유한 이름',
        'number' => '전화번호',
        'number_helper' => '국가 코드가 포함된 WhatsApp 전화번호',
        'status' => '상태',
        'profile_picture' => '프로필 사진',
        'reject_call' => '통화 거부',
        'reject_call_helper' => '수신 전화 자동 거부',
        'msg_call' => '거부 메시지',
        'msg_call_helper' => '통화 거부 시 전송되는 메시지',
        'groups_ignore' => '그룹 무시',
        'groups_ignore_helper' => '그룹의 메시지를 처리하지 않음',
        'always_online' => '항상 온라인',
        'always_online_helper' => '상태를 온라인으로 유지',
        'read_messages' => '메시지 읽기',
        'read_messages_helper' => '메시지를 자동으로 읽음으로 표시',
        'read_status' => '상태 읽기',
        'read_status_helper' => '상태 업데이트를 자동으로 표시',
        'sync_full_history' => '전체 기록 동기화',
        'sync_full_history_helper' => '연결 시 모든 메시지 기록 동기화',
        'created_at' => '생성일',
        'updated_at' => '수정일',
    ],

    'actions' => [
        'connect' => '연결',
        'disconnect' => '연결 해제',
        'delete' => '삭제',
        'refresh' => '새로고침',
        'view_qrcode' => 'QR 코드 보기',
        'close' => '닫기',
        'back' => '목록으로 돌아가기',
    ],

    'messages' => [
        'created' => '인스턴스가 성공적으로 생성되었습니다',
        'updated' => '인스턴스가 성공적으로 업데이트되었습니다',
        'deleted' => '인스턴스가 성공적으로 삭제되었습니다',
        'connected' => '인스턴스가 성공적으로 연결되었습니다',
        'disconnected' => '인스턴스 연결이 성공적으로 해제되었습니다',
        'connection_failed' => '인스턴스 연결에 실패했습니다',
    ],
];
