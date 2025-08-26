<?php

namespace ereminmdev\yii2\pdfjs;

use yii\web\AssetBundle;

class PdfJsAsset extends AssetBundle
{
    public $sourcePath = '@npm/pdfjs-dist/build';

    public $js = [
        YII_DEBUG ? 'pdf.mjs' : 'pdf.min.mjs',
    ];
}
