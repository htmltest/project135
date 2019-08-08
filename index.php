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
        'format' => 'A3',
        'setAutoTopMargin' => 'pad',
        'setAutoBottomMargin' => 'pad'
    ]);

    $stylesheet = file_get_contents('style.css');
    $html = file_get_contents('index.html');

    $mpdf->SetTitle('НЦМУ | Московский центр математических исследований');

    $mpdf->SetHTMLHeader('<div class="header">
            <table>
                <tbody>
                    <tr>
                        <td class="logo"><img src="logo.png" alt="" width="218" /></td>
                        <td class="header-contacts">
                            <div class="phone">+7 (495) 916-81-08</div>
                            <div class="email">ncmu@riep.ru</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>');

    $mpdf->SetHTMLFooter('<div class="footer">
            <table>
                <tbody>
                    <tr>
                        <td class="logo"><img src="logo.png" alt="" width="218" /></td>
                        <td class="footer-contacts">
                            <div class="phone">+7 (495) 916-81-08</div>
                            <div class="email">ncmu@riep.ru</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>');

    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

    $mpdf->Output();
?>