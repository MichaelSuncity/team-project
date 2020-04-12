<?php


namespace common\models;


use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ExpensesAttachmentsAddForm extends Model
{
    public $expenses_id;
    /** @var  UploadedFile */
    public $attachment;

    //папки хранения картинок и их миникопий
    protected $originalDir = '@img/expenses/';
    protected $copiesDir = '@img/expenses/small/';

    protected $filepath;
    protected $filename;

    public function rules()
    {
        return [
            [['expenses_id', 'attachment'], 'required'],
            [['expenses_id'], 'integer'],
            [['attachment'], 'file', 'extensions' => 'jpg, png'] //тип приложений файл с расширениями
        ];
    }
    //при сохранении идет проверка на валидацию правилам, далее загрузка файла с созданием миникопии и записью в БД
    public function save()
    {
        if($this->validate()){
            $this->saveUploadedFile();
            $this->createMinCopy();
            return $this->saveData();
        }
        return false;
    }

    //формирование имени файла из рандомной текстовой строки и расширения файла. Загрузка файла по указанному пути
    private function saveUploadedFile(){
        $randomString = \Yii::$app->security->generateRandomString();
        $this->filename = $randomString . "." . $this->attachment->getExtension();
        $this->filepath = \Yii::getAlias("{$this->originalDir}{$this->filename}");
        $this->attachment->saveAs($this->filepath);
    }
    //создание миникопии картинки и сохранение ее в папке img/expenses/small
    private function createMinCopy(){
        Image::thumbnail($this->filepath, 100, 100)
            ->save(\Yii::getAlias("{$this->copiesDir}{$this->filename}"));
    }
    //добавление в таблицу БД
    private function saveData(){
        $model = new \common\models\ExpensesAttachments([
            'expenses_id' => $this->expenses_id,
            'path' => $this->filename
        ]);
        return $model->save();
    }
}