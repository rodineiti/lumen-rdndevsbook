<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    protected function sendFile($model)
    {
        $field = $this->field;

        // se for uma instancia de uploadfile e for válido
        if (is_a($model->$field, UploadedFile::class) && $model->$field->isValid()) {
            $this->upload($model);
        }
    }

    protected function upload($model)
    {
        $field = $this->field;

        // pega a extensão e gera um nome random
        $extension = $model->$field->extension();
        $name = bin2hex(openssl_random_pseudo_bytes(8));
        $name = $name . '.' . $extension;

        $model->$field->storeAs($this->path, $name, $this->disk);

        $model->$field = $name;
    }

    protected function updateFile($model)
    {
        $field = $this->field;

        // se for uma instancia de uploadfile e for válido
        if (is_a($model->$field, UploadedFile::class) and $model->$field->isValid()) {
            // pega a imagem anterior
            $previous_image = $model->getOriginal($field);
            // faz o upload da imagem enviada
            $this->upload($model);
            // deleta a imagem anterior
            Storage::disk($this->disk)->delete($this->path . $previous_image);
        }
    }

    protected function removeFile($model)
    {
        $field = $this->field;

        Storage::disk($this->disk)->delete($this->path . $model->$field);
    }
}
