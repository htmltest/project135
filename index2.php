<?php
    require_once 'vendor/autoload.php';

    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [
            'fonts',
        ]),
        'fontdata' => $fontData + [
            'roboto' => [
                'R' => 'Roboto-Regular.ttf',
                'B' => 'Roboto-Bold.ttf',
                'I' => 'Roboto-Medium.ttf',
            ]
        ],
        'default_font' => 'roboto',
        'format' => 'A2-L'
    ]);

    $stylesheet = file_get_contents('style.css');
    $html = file_get_contents('index2.html');

    $mpdf->SetTitle('НЦМУ | Московский центр математических исследований');

    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

    $mpdf->Output();
?>