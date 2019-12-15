<?php

namespace app\models\client;
use yii\base\Model;
use yii\web\UploadedFile;




class UploadFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $files = [];
            foreach ($this->imageFile as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                $files[] = '/uploads/' . $file->baseName . '.' . $file->extension;
            }
            return json_encode($files);
        } else {
            return false;
        }
    }
}