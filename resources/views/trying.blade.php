<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

    <style>
        canvas {
            border: 1px solid gray;
            display: none;
            box-shadow: 0 0 3px rgba(0,0,0,0.5);
            border-radius: 10px;
        }
    </style>

</head>
<body>
    <div>
        <strong id="file"></strong>
    </div>
    <canvas id="the-canvas"></canvas>
    <div id="img"></div>


    <script>
        const filePDF = "{{ url('/storage/books/VWLwfGZwD7EmMI5HqFdUYzyCVo0VM2WHowgTOnSD.pdf') }}"
        document.getElementById('file').innerHTML = filePDF
        const canvas = document.getElementById('the-canvas');

        function loadPDFjsLib(file) {
            var pdfjsLib = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';
            return pdfjsLib;
        }

        async function loadFilePDF(file) {
            return await pdfjsLib.getDocument(filePDF).promise
        }

        function makeImgFromCanvas(canvas) {
            // format the image with webp
            var img = document.createElement('img');
            img.src = canvas.toDataURL('image/webp', 1.0);            
            const container = document.getElementById('img')
            container.innerHTML = ''
            container.appendChild(img)
            return img;
        }

        (async function () {
            const pdfjsLib = loadPDFjsLib()

            console.log('Loading a file');
            try {
                var pdf = await loadFilePDF(filePDF)
            } catch (error) {
                // Failed to fetch
                // Invalid PDF
                console.error('Error Loading PDF', error);
                alert(error.message);
            }
            console.log('Loaded File');
            
            const page = await pdf.getPage(1)
            console.log('Page 1 loaded');
            const viewport = page.getViewport({scale: 1});

            // Prepare canvas using PDF page dimensions
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            await page.render({
                canvasContext: context,
                viewport: viewport
            }).promise
            console.log('Page rendered');

            makeImgFromCanvas(canvas)
        })()

    </script>
</body>
</html>