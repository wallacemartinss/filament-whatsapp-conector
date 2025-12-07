<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Tests\Unit;

use WallaceMartinss\FilamentEvolution\Data\InstanceData;
use WallaceMartinss\FilamentEvolution\Tests\TestCase;

class InstanceDataTest extends TestCase
{
    public function test_can_create_instance_data(): void
    {
        $data = new InstanceData(
            instanceName: 'test-instance',
            number: '5511999999999',
            qrcode: true,
        );

        $this->assertSame('test-instance', $data->instanceName);
        $this->assertSame('5511999999999', $data->number);
        $this->assertTrue($data->qrcode);
    }

    public function test_can_convert_to_api_payload(): void
    {
        $data = new InstanceData(
            instanceName: 'test-instance',
            number: '5511999999999',
            rejectCall: true,
            msgCall: 'Busy, call later',
        );

        $payload = $data->toApiPayload();

        $this->assertSame('test-instance', $payload['instanceName']);
        $this->assertSame('5511999999999', $payload['number']);
        $this->assertTrue($payload['reject_call']);
        $this->assertSame('Busy, call later', $payload['msg_call']);
        $this->assertSame('WHATSAPP-BAILEYS', $payload['integration']);
    }

    public function test_can_create_from_api_response(): void
    {
        $response = [
            'instance' => [
                'instanceName' => 'test-instance',
                'number' => '5511999999999',
            ],
            'qrcode' => true,
        ];

        $data = InstanceData::fromApiResponse($response);

        $this->assertSame('test-instance', $data->instanceName);
        $this->assertSame('5511999999999', $data->number);
    }
}
