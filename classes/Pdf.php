<?php

class Pdf extends TCPDf
{
    private $html_string;
    private $count_total = 0;
    private $cost_total = 0;
    private $requisites;
    public $invoice_number;

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        $fontname = TCPDF_FONTS::addTTFfont(PATH.'/fonts/ARIALUNI.TTF');
        $this->SetFont($fontname, '', 10);
        //dejavusans
    }

    public function createInvoice($ar_post)
    {
        $this->requisites = json_decode($ar_post['client_data'], true);

        $this->createHeader();
        $this->createTable($ar_post['products']);
        $this->createFooter();
        $this->generation();
    }

    private function createHeader()
    {
        //header
        $this->AddPage();
        $this->invoice_number = rand(10000, 99999);
        $this->html_string .= '<img src="img/capitalcom.png" width="105px">';
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<table>';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td style="color: #696969">ТОО “Капиталинвестком”, БИН 43124912071</td>';//['size' => 10, 'color' => '#696969'], ['spaceBefore' => 0, 'spaceAfter' => 0]);
        $this->html_string .= '</tr>';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td style="color: #696969;">+7 (707) 212-51-98, +7 (968) 889-42-19</td>';//,['size' => 10, 'color' => '#696969'], ['spaceAfter' => 0]);
        $this->html_string .= '</tr>';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td style="color: #696969;">Алматы, ул. Ауэзова 211, оф. 267</td>';//,['size' => 10, 'color' => '##696969'], ['spaceAfter' => 0]);
        $this->html_string .= '</tr>';
        $this->html_string .= '<table>';
        $this->html_string .= '<br>';


        $this->html_string .= '<p style="font-size: 16px;">Счет на оплату №' . $this->invoice_number . '</p>';//, ['size' => 18], ['spaceAfter' => 0]
        $this->html_string .= '<br>';

        $this->html_string .= '<table cellpadding="2">';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td width="33%" style="color: #696969;">Выставлен</td>';//, ['size' => 18], ['spaceAfter' => 0]
        $this->html_string .= '<td width="44%" style="color: #696969;">Способ оплаты</td>';//, ['size' => 18], ['spaceAfter' => 0]
        $this->html_string .= '<td width="23%" style="color: #696969;">Договор</td>';//, ['size' => 18], ['spaceAfter' => 0]
        $this->html_string .= '</tr>';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td width="33%" style="font-size: 11px;">' . date('d ') . Helper::monthName(date('m')) . date(', o') . '</td>';
        $this->html_string .= '<td width="44%" style="font-size: 11px;">Банковский перевод</td>';
        $this->html_string .= '<td width="23%" style="font-size: 11px;">' . Helper::randomText(3) . rand(100, 999) . '</td>';
        $this->html_string .= '</tr>';
        $this->html_string .= '</table>';
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<b style="font-size: 11px">Платежное поручение</b>';
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<table border="1" cellpadding="2">';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td width="42%">Бенефициар:<br>ТОО “Капиталинвестком”<br>БИН: 4654941232798</td>';//, ['size' => 18], ['spaceAfter' => 0]
        $this->html_string .= '<td width="25%">ИИК<br>KZ43219421340</td>';//, ['size' => 18], ['spaceAfter' => 0]
        $this->html_string .= '<td width="33%">КБЕ<br>17</td>';//, ['size' => 18], ['spaceAfter' => 0]
        $this->html_string .= '</tr>';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td width="42%">Банк бенефициара:<br>АО “Казкоммерцбанк”</td>';
        $this->html_string .= '<td width="25%">БИК<br>KZKOKX</td>';
        $this->html_string .= '<td width="33%">Код назначения платежа<br>851</td>';
        $this->html_string .= '</tr>';
        $this->html_string .= '</table>';
    }

    private function createTable($ar_products)
    {
        $product_json = explode(';', $ar_products);
        $requisites = $this->requisites;

        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';

        $this->html_string .= '<table cellpadding="4">';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td width="5%" style="color:#696969; border-bottom: 1px solid #ddd;">№</td>';
        $this->html_string .= '<td width="50%" style="color:#696969;  border-bottom: 1px solid #ddd;">Наименование</td>';
        $this->html_string .= '<td width="28%" style="color:#696969;  border-bottom: 1px solid #ddd;">Количество</td>';
        $this->html_string .= '<td width="18%" style="color:#696969;  border-bottom: 1px solid #ddd; text-align:right;">Стоимость</td>';
        $this->html_string .= '</tr>';

        for ($i = 0; $i < count($product_json); $i++) {
            $product = json_decode($product_json[$i], 1);
            $this->cost_total += $product['cost'] * $product['count'];
            $this->count_total += $product['count'];

            $this->html_string .= '<tr>';
            $this->html_string .= '<td width="5%" style="border-bottom: 1px solid #ddd;">' . ($i + 1) . '</td>';
            $this->html_string .= '<td width="50%" style="border-bottom: 1px solid #ddd;">' . $product['product_name'] . '</td>';
            $this->html_string .= '<td width="28%" style="border-bottom: 1px solid #ddd;">' . $product['count'] . '</td>';
            $this->html_string .= '<td width="18%" style="border-bottom: 1px solid #ddd; text-align:right;">' . $product['cost'] . ' ' . $requisites['currency'] . '</td>';
            $this->html_string .= '</tr>';
        }

        $this->html_string .= '<tr>';
        $this->html_string .= '<td width="5%" style="border-bottom: 1px solid #ddd;"></td>';
        $this->html_string .= '<td width="50%" style="border-bottom: 1px solid #ddd;">Без налога (НДС)</td>';
        $this->html_string .= '<td width="28%" style="border-bottom: 1px solid #ddd;"></td>';
        $this->html_string .= '<td width="18%" style="border-bottom: 1px solid #ddd; text-align:right;">0 ' . $requisites['currency'] . '</td>';
        $this->html_string .= '</tr>';
        $this->html_string .= '<tr>';

        $this->html_string .= '<td width="5%"></td>';
        $this->html_string .= '<td width="50%">Итого к оплате</td>';
        $this->html_string .= '<td width="28%">' . $this->count_total . '</td>';
        $this->html_string .= '<td width="18%" style="text-align:right;"><b>' . $this->cost_total . ' ' . $requisites['currency'] . '</b></td>';
        $this->html_string .= '</tr>';


        $this->html_string .= '</table>';

    }

    private function createFooter()
    {
        $requisites = $this->requisites;
        $str_requisites = str_replace(';', '<br>', $requisites['requisites']);
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<br>';
        $this->html_string .= '<table>';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td width="25%" style="border-top: 1px solid #ddd; color:#696969;">Заказчик<br></td>';
        $this->html_string .= '<td width="75%" style="border-top: 1px solid #ddd;">' . $str_requisites . '</td>';
        $this->html_string .= '</tr>';
        $this->html_string .= '<tr>';
        $this->html_string .= '<td width="25%" style="border-top: 1px solid #ddd; color:#696969;">Исполнитель<br></td>';
        $this->html_string .= '<td width="75%" style="border-top: 1px solid #ddd;">ТОО “Капиталинвестком”<br>БИН/ИИН 850216301079 , г. Алматы ул Ибрагимова 7/4</td>';
        $this->html_string .= '</tr>';
        $this->html_string .= '</table>';

        $this->html_string .= '<br><br><br>Выписал<br>Руководитель: Каранкин Исмаил Хусанович<br>М. П.<br>';
        $this->writeHTMLCell(150, 100, 25, 28, $this->html_string, 0, 1, 0, true, '', true);
        $this->lastPage();
    }

    public function generation()
    {
        $this->Output(PATH . '/tmp/'.$this->invoice_number.'.pdf', 'F');

        return true;
    }
}