<?php

namespace Estoque\Helpers;

trait HtmlRenderTrait
{
    public function htmlRender($templatePath, $data): string
    {
        extract($data);
        ob_start();
        require __DIR__ . '/../../public/view/' . $templatePath;
        $html = ob_get_clean();
        return $html;
    }
}