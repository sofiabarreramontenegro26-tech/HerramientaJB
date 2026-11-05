<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class CloudinaryService
{
    public function subir(UploadedFile $archivo): string
    {
        $cloud = config('services.cloudinary.cloud_name');

        $respuesta = Http::attach('file', $archivo->get(), $archivo->getClientOriginalName())
            ->post("https://api.cloudinary.com/v1_1/{$cloud}/image/upload", [
                'upload_preset' => config('services.cloudinary.upload_preset'),
            ]);

        if ($respuesta->failed()) {
            throw new RuntimeException('No se pudo subir la imagen a Cloudinary.');
        }

        return $respuesta->json('secure_url');
    }
}