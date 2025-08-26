# yii2-pdfjs

Yii2 widget for PDF.js library: https://mozilla.github.io/pdf.js/

## Install

``composer require --prefer-dist ereminmdev/yii2-pdfjs``

## Documentation

https://mozilla.github.io/pdf.js/examples/

## Using

````
$pdfUrl = '/path_to/file.pdf';
$pdfJsAsset = PdfJsAsset::register($this);
$workerSrc = $pdfJsAsset->baseUrl . '/pdf.worker.min.mjs';

$this->registerJs(<<<JS
    const containerDiv = document.getElementById('pdfDoc');

    const {pdfjsLib} = globalThis;
    pdfjsLib.GlobalWorkerOptions.workerSrc = '$workerSrc';
    const loadingTask = pdfjsLib.getDocument('$pdfUrl');

    loadingTask.promise.then(function (pdf) {
        const numPages = pdf.numPages;

        for (let pageNumber = 1; pageNumber <= numPages; pageNumber++) {
            pdf.getPage(pageNumber).then(function (page) {
                const scale = 1.5;
                const viewport = page.getViewport({scale: scale});

                const canvas = document.createElement('canvas');
                canvas.id = 'pdfCanvas' + pageNumber;
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);

                containerDiv.appendChild(canvas);
            });
        }
    });
JS
);

...

<div id="pdfDoc"></div>
````