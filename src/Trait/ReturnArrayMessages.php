<?php

namespace Ssgroup\Language\Trait;

/**
 * Trait FlashMessages
 */
trait ReturnArrayMessages
{
    public function saveFilePath($file, $user, $field_name)
    {
        $filesIZE = $file->getSize();
        $img_extenstion = strtolower($file->getClientOriginalExtension());

        $filename = time().rand(11111, 9999).'.';
        $image_path = $filename.$img_extenstion;
        $file_path = public_path().'uploads/document/'.$filename.$img_extenstion;
        $uploaded = $file->move(public_path('uploads/document'), $image_path);
        if ($oldDocument = \App\Models\Document::where([
            'documentable_type' => 'App\Models\User',
            'documentable_id' => $user->id,
            'field_name' => $field_name,
        ])->first()) {
            $oldDocument->update([
                'documentable_type' => 'App\Models\User',
                'documentable_id' => $user->id,
                'title' => $filename.$img_extenstion,
                'index' => 0,
                'is_main' => 0,
                'date' => date('Y-m-d H:i:s'),
                'size' => $filesIZE,
                'type' => 'image/'.$img_extenstion,
                'file' => $file_path,
                'field_name' => $field_name,
            ]);
        } else {
            \App\Models\Document::create([
                'documentable_type' => 'App\Models\User',
                'documentable_id' => $user->id,
                'title' => $filename.$img_extenstion,
                'index' => 0,
                'is_main' => 0,
                'date' => date('Y-m-d H:i:s'),
                'size' => $filesIZE,
                'type' => 'image/'.$img_extenstion,
                'file' => $file_path,
                'field_name' => $field_name,
            ]);
        }
    }

    public function successMessage($message)
    {
        return [
            'status' => 'success',
            'message' => $message,
            'status_code' => 200,
        ];
    }

    public function createMessage($message)
    {
        return [
            'status' => 'success',
            'message' => $message,
            'status_code' => 201,
        ];
    }

    public function updateMessage($message)
    {
        return [
            'status' => 'success',
            'message' => $message,
            'status_code' => 205,
        ];
    }

    public function deleteMessage($message)
    {
        return [
            'status' => 'success',
            'message' => $message,
            'status_code' => 204,
        ];
    }

    public function returnError($message, $status = 500, $errorType = 'error')
    {
        return [
            'status' => $errorType,
            'message' => $message,
            'status_code' => $status,
        ];
    }

    public function returnNotFoundError()
    {
        return [
            'status' => 'error',
            'message' => 'Page Not Found',
            'status_code' => 404,
        ];
    }

    public function returnData($data)
    {
        return [
            'status' => 'success',
            'data' => $data,
            'status_code' => 200,
        ];
    }

    public function returnMultipleData($data)
    {
        $sta = ['status' => 'success', 'status_code' => 200];

        return array_merge($sta, $data);
    }

    public function returnServerError()
    {
        return [
            'status' => 'error',
            'message' => 'Something went wrong',
            'status_code' => 500,
        ];
    }

    public function returnValidationError($data)
    {
        return [
            'status' => 'error',
            'errors' => $data,
            'status_code' => 422,
        ];
    }

    public function returnPages($data)
    {
        return [
            'next_page' => $data->nextPageUrl(),
            'current_page' => $data->currentPage(),
            'total_pages' => (int) ceil($data->total() / $data->perPage()),
        ];
    }
}
