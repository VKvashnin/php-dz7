<?php

class Request
{
    private $errors = [];
    
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function clear($str)
    {
        return strip_tags( trim($str) );
    }

    public function getField($inputName)
    {
        $value = $_POST[$inputName] ?? '';

        return $this->clear($value);
    }

    public function required($inputName)
    {
        $value = $this->getField($inputName);
        if(empty($value))
        {
            $this->errors[$inputName][] = 'поле обязательно к заполнению';
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * проверяет длину строки из поля на минимальное значения
     * @param $inputName
     * @param $min
     */
    public function minLength($inputName, $min)
    {
        $value = $this->getField($inputName);
        if (strlen($value)<$min)
        {
        	$this->errors[$inputName][] = "Минимальная длина сроки $min";
        }
    }

    /**
     * проверяет длину строки из поля на максимальное значения
     * @param $inputName
     * @param $max
     */
    public function maxLength($inputName, $max)
    {
        $value = $this->getField($inputName);
        if (strlen($value)>$max)
        {
            $this->errors[$inputName][] = "Слишком длинный текст, максимальная длина $max";
        }
    }

    /**
     * проверка значения на максимальность
     * метод проверяет является ли введенное значение email
     * @param $inputName - имя поля
     */
    public function isEmail($inputName)
    {
        $value = strpos($this->getField($inputName), '@');
        if (!$value)
        {
            $this->errors[$inputName][] = 'Пожалуйста, введите корректный Email';
        }

    }

    public function passConfirm($inputName1, $inputName2)
    {
        $value1 = $this->getField($inputName1);
        $value2 = $this->getField($inputName2);
        if ($value1 !== $value2)
        {
            $this->errors[$inputName2][] = 'Пароли не совпадают';
        }
    }

    public function notRegistered($inputName)
    {
        $this->errors[$inputName][] = "Такой пользователь не зарегистрирован в системе";
    }

    public function wrongPassword($inputName)
    {
        $this->errors[$inputName][] = "Введен неверный пароль";
    }

    public function alredyRegistered($inputName)
    {
        $this->errors[$inputName][] = "Такой логин уже зарегистрирован";
    }
}
?>