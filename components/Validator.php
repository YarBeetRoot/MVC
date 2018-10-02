<?

class Validator{
    public $input = [];

    protected $errors = [];

    protected $hasErrors = false;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function hasErrors(){
        return $this->hasErrors;
    }
    public function text($fieldName, $minVal = 5, $maxVal = 500){

        $errors = [];

        if (empty($this->input[$fieldName])){
            $errors[] = "Заполните поле ".$fieldName;

            //return $errors;
        }

        $value = $this->input[$fieldName];
        //проверим, что длинна имени от 2-х символов
        if (mb_strlen(trim($value)) < $minVal){
            $errors[] = $fieldName.' должно быть минимум '.$minVal. ' Вы ввели '. $value;
        }
        if (mb_strlen(trim($value)) > $maxVal){
            $errors[] = $fieldName.' может быть максимум '.$maxVal. ' Вы ввели '. $value;;
        }
        //

        if (!empty($errors)){
            $this->hasErrors = true;
        }

        $this->errors[$fieldName] = $errors;

    }

}