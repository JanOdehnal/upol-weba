<?php

class PageController extends BaseController {
    public function openPage($nazevStranky) {
        $this->checkSession();
        $this->renderView($nazevStranky, ['page' => $nazevStranky]);
    }
}




?>