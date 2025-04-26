<?php

namespace feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class AdminRoomControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use DatabaseTestTrait;

    // For Migrations
    protected $migrate     = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = 'Tests\Support';

    // For Seeds
    protected $seedOnce = false;
    protected $seed     = 'TestSeeder';
    protected $basePath = 'tests/_support/Database/Seeds/';

    protected function setUp(): void
    {
        parent::setUp();

        // Create test directories if they don't exist
        $testUploadPath = WRITEPATH . 'images/tests/';
        if (!is_dir($testUploadPath)) {
            mkdir($testUploadPath, 0777, true);
        }
    }

    public function testCreateRoomSuccess(): void
    {
        // Create fake image
        $imgPath = WRITEPATH . 'images/tests/sample_room.jpg';
        file_put_contents($imgPath, str_repeat('a', 500 * 1024)); // 500KB file

        // Create UploadedFile instance
        $_FILES = [
            'img_url' => [
                'name' => 'room.jpg',
                'type' => 'image/jpeg',
                'size' => filesize($imgPath),
                'tmp_name' => $imgPath,
                'error' => 0
            ]
        ];

        $response = $this->withSession([
            'user_id' => 1,
            'is_admin' => true,
            'logged_in' => true
            ])
            ->post('/admin/rooms/create', [
                'room_number' => 'B123',
                'type'        => 'Double',
                'description' => 'Chambre spacieuse avec balcon.',
                'price'       => 120.00,
                'available'   => 1,
                'capacity'    => 2,
                'submit'      => true,
                'csrf_test_name' => csrf_hash()
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Verify data was saved correctly in database
        $roomModel = model('RoomModel'); // or new \App\Models\RoomModel();
        $newRoom = $roomModel->where('room_number', 'B123')->first();
        $this->assertNotNull($newRoom);
        $this->assertEquals('Double', $newRoom['type']);

        // Clean up test file
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }

        // Reset $_FILES after the test
        $_FILES = [];
    }

    public function testCreateRoomValidationError(): void
    {
        $response = $this->withSession(['user_id' => 1, 'is_admin' => true])
            ->post('/admin/rooms/create', [
                'room_number' => '', // Empty required field
                'type'        => 'Double',
                'price'       => 120.00,
                'csrf_test_name' => csrf_hash()
            ]);

        $response->assertOK(); // Form should return with validation errors
        $response->assertSee('The Room Number field is required');
    }
}