<?php

class Word extends \PhpOffice\PhpWord\PhpWord
{
    private $section;
    private $count_total = 0;
    private $cost_total = 0;
    private $requisites;
    public $invoice_number;

    public function __construct()
    {
        parent::__construct();
        $this->setDefaultFontName('arial');
        $this->setDefaultFontSize(10);
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
        $this->invoice_number = rand(10000, 99999);
        $section = $this->addSection();
        $section->addImage('img/capitalcom.png', ['align' => '', 'width' => 105]);
        $section->addText('ТОО “Капиталинвестком”, БИН 43124912071',['size' => 10, 'color' => '#696969'], ['spaceBefore' => 0, 'spaceAfter' => 0]);
        $section->addText('+7 (707) 212-51-98, +7 (968) 889-42-19',['size' => 10, 'color' => '#696969'], ['spaceAfter' => 0]);
        $section->addText('Алматы, ул. Ауэзова 211, оф. 267',['size' => 10, 'color' => '##696969'], ['spaceAfter' => 0]);
        $section->addTextBreak();

        $table = $section->addTable('myTable');
        $table->addRow();
        $cell = $table->addCell(10000);
        $cell->addText('Счет на оплату №' . $this->invoice_number, ['size' => 18], ['spaceAfter' => 0]);
        $cell = $table->addCell(2000);

        $section->addTextBreak();
        $table = $section->addTable();
        $table->addRow();
        $cell = $table->addCell(4000);
        $cell->addText('Выставлен', ['size' => 10, 'color' => '#A9A9A9'], ['spaceAfter' => 70]);
        $cell->addText(date('d ') . Helper::monthName(date('m')) . date(', o'), ['size' => 11]);
        $cell = $table->addCell(5000);
        $cell->addText('Способ оплаты', ['size' => 10, 'color' => '#A9A9A9'], ['spaceAfter' => 70]);
        $cell->addText('Банковский перевод', ['size' => 11]);
        $cell = $table->addCell(3000);
        $cell->addText('Договор', ['size' => 10, 'color' => '#A9A9A9'], ['spaceAfter' => 70]);
        $cell->addText(Helper::randomText(3) . rand(100, 999), ['size' => 11]);
        $section->addTextBreak();


        $section->addText('Платежное поручение', ['size' => 11,'bold' => true]);
        $table = $section->addTable(['borderSize' => 6]);

        $table->addRow();
        $cell = $table->addCell(5000);
        $cell->addText(' Бенефициар:', ['size' => 10], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $cell->addText(' ТОО “Капиталинвестком”', ['size' => 10], ['spaceAfter' => 0]);
        $cell->addText(' БИН: 4654941232798', ['size' => 10], ['spaceAfter' => 0]);
        $cell = $table->addCell(3000);
        $cell->addText(' ИИК', [], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $cell->addText(' KZ43219421340', [], ['spaceAfter' => 0]);
        $cell = $table->addCell(4000);
        $cell->addText(' КБЕ', [], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $cell->addText(' 17', [], ['spaceAfter' => 0]);

        $table->addRow();
        $cell = $table->addCell(5000);
        $cell->addText(' Банк бенефициара:', [], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $cell->addText(' АО “Казкоммерцбанк”', [], ['spaceAfter' => 0]);
        $cell = $table->addCell(3000);
        $cell->addText(' БИК', [], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $cell->addText(' KZKOKX', [], ['spaceAfter' => 0]);
        $cell = $table->addCell(4000);
        $cell->addText(' Код назначения платежа', [], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $cell->addText(' 851', [], ['spaceAfter' => 0]);
        $section->addTextBreak();
        $section->addTextBreak();
        $this->section = $section;
    }

    private function createTable($ar_products)
    {
        $product_json = explode(';', $ar_products);
        $requisites = $this->requisites;

        $table = $this->section->addTable();
        $table->addRow();
        $cell = $table->addCell(700, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
        $cell->addText('№', ['color' => '#A9A9A9'], ['spaceAfter' => 70, 'spaceBefore' => 70]);
        $cell = $table->addCell(7000, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
        $cell->addText('Наименование', ['size' => 10, 'color' => '#A9A9A9'], ['spaceAfter' => 70, 'spaceBefore' => 70]);
        $cell = $table->addCell(2100, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
        $cell->addText('Количество', ['size' => 10, 'color' => '#A9A9A9'], ['spaceAfter' => 70, 'spaceBefore' => 70]);
        $cell = $table->addCell(2200, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
        $cell->addText('Стоимость', ['size' => 10, 'color' => '#A9A9A9'], ['align' => 'right', 'spaceAfter' => 70, 'spaceBefore' => 70]);

        for ($i = 0; $i < count($product_json); $i++) {
            $product = json_decode($product_json[$i], 1);
            $this->cost_total += $product['cost'] * $product['count'];
            $this->count_total += $product['count'];

            $table->addRow();
            $cell = $table->addCell(700, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
            $cell->addText($i+1, [], ['spaceAfter' => 70, 'spaceBefore' => 70]);
            $cell = $table->addCell(7000, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
            $cell->addText($product['product_name'], [], ['spaceAfter' => 70, 'spaceBefore' => 70]);
            $cell = $table->addCell(2100, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
            $cell->addText($product['count'], [], ['spaceAfter' => 70, 'spaceBefore' => 70]);
            $cell = $table->addCell(2200, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
            $cell->addText($product['cost'] . ' ' . $requisites['currency'], [], ['align' => 'right', 'spaceAfter' => 70, 'spaceBefore' => 70]);
        }

        //низ таблицы //строка НДС
        $table->addRow();
        $cell = $table->addCell(700, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
        $cell->addText('', [], ['spaceAfter' => 70, 'spaceBefore' => 70]);
        $cell = $table->addCell(7000, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
        $cell->addText('Без налога (НДС)', [], ['spaceAfter' => 120, 'spaceBefore' => 120]);
        $cell = $table->addCell(2100, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
        $cell->addText('', [], ['spaceAfter' => 70, 'spaceBefore' => 70]);
        $cell = $table->addCell(2200, ['borderBottomSize' => 1, 'borderBottomColor' => '#DCDCDC']);
        $cell->addText('0 ' . $requisites['currency'], [], ['align' => 'right', 'spaceAfter' => 70, 'spaceBefore' => 70]);

        //строка итого
        $table->addRow();
        $cell = $table->addCell(700);
        $cell->addText('', [], ['spaceAfter' => 70, 'spaceBefore' => 70]);
        $cell = $table->addCell(7000);
        $cell->addText('Итого к оплате', ['bold' => true], ['spaceAfter' => 120, 'spaceBefore' => 120]);
        $cell = $table->addCell(2100);
        $cell->addText($this->count_total, ['bold' => true], ['spaceAfter' => 120, 'spaceBefore' => 120]);
        $cell = $table->addCell(2200);
        $cell->addText($this->cost_total . ' ' . $requisites['currency'], ['bold' => true], ['align' => 'right', 'spaceAfter' => 120, 'spaceBefore' => 120]);

        $this->section->addTextBreak();
        $this->section->addTextBreak();
    }

    private function createFooter()
    {
        //requisites //dinamic
        $requisites = $this->requisites;
        $table = $this->section->addTable();
        $table->addRow();
        $cell = $table->addCell(3000, ['borderTopSize' => 1, 'borderTopColor' => '#DCDCDC']);
        $cell->addText('Заказчик ', ['size' => 10, 'color' => '#A9A9A9'], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $cell->addText('', [], ['spaceAfter' => 70, 'spaceBefore' => 0]);
        $cell = $table->addCell(9000, ['borderTopSize' => 1, 'borderTopColor' => '#DCDCDC']);
        $cell->addText($requisites['name'], [], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $ar_requisites = explode( ';', $requisites['requisites']);
        foreach ($ar_requisites as $re){
            $cell->addText(trim($re), [], ['spaceAfter' => 0, 'spaceBefore' => 0]);
        }

        $table->addRow();
        $cell = $table->addCell(3000, ['borderTopSize' => 1, 'borderTopColor' => '#DCDCDC']);
        $cell->addText('Исполнитель ', ['size' => 10, 'color' => '#A9A9A9'], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $cell->addText('', [], ['spaceAfter' => 70, 'spaceBefore' => 0]);
        $cell = $table->addCell(9000, ['borderTopSize' => 1, 'borderTopColor' => '#DCDCDC']);
        $cell->addText('ТОО “Капиталинвестком”', [], ['spaceAfter' => 0, 'spaceBefore' => 70]);
        $cell->addText('БИН/ИИН 850216301079 , г. Алматы ул Ибрагимова 7/4', [], ['spaceAfter' => 0, 'spaceBefore' => 0]);
        $this->section->addTextBreak();

        $this->section->addText('Выписал',[],['spaceAfter' => 0, 'spaceBefore' => 100]);
        $this->section->addText('Руководитель: Каранкин Исмаил Хусанович',[],['spaceAfter' => 0, 'spaceBefore' => 0]);
        $this->section->addText('М. П.',[],['spaceBefore' => 0]);
    }

    public function generation()
    {
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this, 'Word2007');
        $objWriter->save('tmp/'.$this->invoice_number.'.docx');
    }
}