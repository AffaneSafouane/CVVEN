<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Room;
use App\Models\RoomModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\HTTP\RedirectResponse;
use PHPUnit\Exception;

class RoomController extends BaseController
{
    public function index(): string
    {
        $model = model(RoomModel::class);

        $data = [
            'rooms' => $model->paginate(10),
            'pager' => $model->pager,
            'title' => 'Liste des chambres'
        ];

        return view('admin/rooms/index', $data);
    }

    public function show(int $roomId): string
    {
        $roomModel = new RoomModel();
        $data = [
            'room' => $roomModel->find($roomId),
            'title' => 'Informations chambre',
        ];

        return view('admin/rooms/show', $data);
    }

    public function roomForm(?int $roomId): string
    {
        helper('form');

        if ($roomId) {
            $roomModel = new RoomModel();
            $data = [
                'room' => $roomModel->find($roomId),
                'title' => 'Modifier la chambre',
            ];

            return view('admin/rooms/create', $data);
        }

        return view('admin/rooms/create', ['title' => 'Ajout d\'une chambre']);
    }

    public function create(): string|RedirectResponse
    {
        helper('form');
        $validation = service('validation');

        $img = $this->request->getFile('img_url');
        $roomRules = $validation->getRuleGroup('roomValidation');
        $roomFields = array_keys($roomRules);
        $roomData = $this->request->getPost($roomFields);
        $roomData['img_url'] = $img;

        if (!$validation->run($roomData, 'roomValidation')) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $imageName = $this->handleImageUpload($img);
        if ($imageName) {
            $roomData['img_url'] = $imageName;
        } else {
            $roomData['img_url'] = null;
        }

        $room = new Room($roomData);

        $roomModel = new RoomModel();
        if (!$roomModel->save($room)) {
            return redirect()->back()->withInput()->with('errors', $roomModel->errors());
        }

        return redirect()->to('/admin/rooms/show/' . $roomModel->getInsertID())->with('success', 'Chambre créée avec succès');
    }

    public function edit(int $roomId): string|RedirectResponse
    {
        helper('form');
        $validation = service('validation');

        $roomModel = new RoomModel();
        $room = $roomModel->find($roomId);
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found');
        }

        $oldImage = $room->imgUrl ?? null;

        $roomRules = $validation->getRuleGroup('roomValidation');
        $roomFields = array_keys($roomRules);
        $updateData = $this->request->getPost($roomFields);

        if (!$validation->run($updateData, 'roomValidation')) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $img = $this->request->getFile('img_url');
        $imageName = $this->handleImageUpload($img);
        if ($imageName) {
            $updateData['img_url'] = 'images/' . $imageName;

//            if ($oldImage && file_exists(FCPATH . 'images' . $oldImage)) {
//                unlink(FCPATH . 'images' . $oldImage);
//            }
        } else {
            $updateData['img_url'] = $oldImage;
        }

        $room = new Room($updateData);
        $room->id = $roomId;

        if (!$roomModel->save($room)) {
            return redirect()->back()->withInput()->with('errors', $roomModel->errors());
        }

        return redirect()->to('/admin/rooms/' . $roomId)->with('success', 'Chambre mise à jour avec succés');
    }

    public function delete(int $roomId): RedirectResponse
    {
        $roomModel = new RoomModel();
        $room = $roomModel->find($roomId);
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found');
        }

//        if (!empty($room->imgUrl) && file_exists(FCPATH . $room->imgUrl)) {
//            // Delete the image
//            unlink(FCPATH . $room->imgUrl);
//        }

        if (!$roomModel->delete($roomId)) {
            return redirect()->back()->with('errors', $roomModel->errors());
        }

        return redirect()->to('/admin/rooms/')->with('success', 'Chambre supprimée avec succès');
    }

    private function handleImageUpload(?UploadedFile $img): ?string
    {
        if ($img && $img->getError() !== UPLOAD_ERR_NO_FILE && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'images', $newName);
            return $newName;
        }
        return null;
    }
}
