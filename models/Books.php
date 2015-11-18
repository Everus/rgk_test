<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 *
 * @property Authors $author
 */
class Books extends ActiveRecord
{
    const UPLOAD_DIR = 'uploads/news/';
    const DEFAULT_PREVIEW = '@web/images/notavailable.png';
    const DEFAULT_PREVIEW_THUMB = '@web/images/notavailablethumb.png';
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert) {
                $this->date_create = date('Y-m-d');
            }
            $this->date_update = date('Y-m-d');
            $this->upload();
            return true;
        } else {
            return false;
        }
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date', 'author_id'], 'required'],
            [['name'], 'string'],
            [['date'], 'date', 'format' => 'yyyy-mm-dd'],
            [['author_id'], 'integer'],
            [['imageFile'], 'file','skipOnEmpty' => true, 'extensions' => 'png, jpg']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Дата добавления',
            'date_update' => 'Дата последнего изменения',
            'preview' => 'Превью',
            'date' => 'Дата выхода книги',
            'author_id' => 'Автор',
            'author.fullName' => 'Автор',
            'imageFile' => 'Превью',
        ];
    }

    public function getPreviewURL()
    {
        if(file_exists(self::UPLOAD_DIR.$this->preview)) {
            return '@web/'.self::UPLOAD_DIR.$this->preview;
        } else {
            return self::DEFAULT_PREVIEW;
        }
    }

    public function getPreviewThumbURL()
    {
        if(file_exists(self::UPLOAD_DIR.$this->preview)) {
            return '@web/'.self::UPLOAD_DIR.'thumb/'.$this->preview;
        } else {
            return self::DEFAULT_PREVIEW_THUMB;
        }
    }

    public function upload()
    {
        if($this->imageFile = UploadedFile::getInstance($this, 'imageFile')) {
            $this->preview = md5($this->imageFile->baseName.time()) . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs(Yii::getAlias('@webroot').'/'.self::UPLOAD_DIR.$this->preview);
            $this->imageFile = NULL;
            Image::thumbnail('@webroot/'.self::UPLOAD_DIR.$this->preview, 120, 120)
                ->save(Yii::getAlias('@webroot').'/'.self::UPLOAD_DIR.'thumb/'.$this->preview, ['quality' => 80]);
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }
}
