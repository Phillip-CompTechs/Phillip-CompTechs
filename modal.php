<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Universal Modal Structure - Hidden by default, controlled by JavaScript -->
<div id="universalModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-content">
        <button type="button" class="close-button" onclick="closeUniversalModal()" aria-label="Close modal">&times;</button>
        <h3 id="modalTitle"></h3>
        <div id="modalBody"></div>
    </div>
</div>


</body>
</html>