<?php

class View
{
    private $content;

    public function __set($name, $value) {
        $this->{$name} = $value;
    }

    /**
     * Render view.
     *
     * @param string $templateView Path to template.
     * @param string $mainView Path to main view.
     */
    function generate($templateView, $mainView) {
//        var_dump($templateView);
//        var_dump($mainView);
//        die;
        if (!$mainView) {
            echo 'Установите вид!';die;
        }

        $this->content = $this->getRenderedHTML('views/' . $mainView);

        if (!$templateView) {
            echo 'Установите шаблон!';die;
        }

        include 'views/layouts/' . $templateView;
    }

    public function getRenderedHTML($path)
    {
        ob_start();
        include($path);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }


}