<?php

namespace App\Lib;

use Illuminate\Support\Facades\Auth;
use TCPDF;

trait PdfExportTrait {
    /**
     * Містить назву згенерованого фалу звіту pdf
     */
    private string $pdfFileName;
    private TCPDF $pdf;

    private function getPdfDirPath():string
    {
        if (!is_dir(storage_path('app/public/pdfFilesExports'))) {
            mkdir(storage_path('app/public/pdfFilesExports'));
        }
        if (!is_dir(storage_path('app/public/pdfFilesExports/user_'.Auth::id()))) {
            mkdir(storage_path('app/public/pdfFilesExports/user_'.Auth::id()));
        }
        return storage_path('app/public/pdfFilesExports/user_'.Auth::id().'/');
    }

    private function getPdfFilePath():string
    {
        $fn = date('d-m-Y_H-i-s_').'exports.pdf';
        $this->pdfFileName = $fn;
        return $this->getPdfDirPath() . $fn;
    }

    private function initPdf(): void
    {
        $this->pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->pdf->SetPageOrientation('L', '', true);
        $this->pdf->SetTitle('Звіт по цукру крові');
        $this->pdf->SetAuthor('tsukor-norm.pp.ua');
        $this->pdf->SetSubject('Звіт рівнів глюкози крові');
        $this->pdf->SetKeywords('глюкоза крові, звіт, мій стан');
        $this->pdf->SetHeaderData('', 0, "Generator: http://tsukor-norm.pp.ua", "");
        $this->pdf->setHeaderFont(Array('dejavusans', '', PDF_FONT_SIZE_MAIN));
        $this->pdf->setFooterFont(Array('dejavusans', '', PDF_FONT_SIZE_DATA));
        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    }

    public function SaveTestFile(string $headTitlePdf="test")
    {
        $this->initPdf();
        $this->pdf->SetFont('dejavusans', '', 14);
        $this->pdf->AddPage();
        $this->pdf->writeHTML('
            <h2>'.$headTitlePdf.'</h2>
            <p>На графіку серелній рівент цукру на кожну двту</p>
        ');
        $this->pdf->Output($this->getPdfFilePath(), 'F');
        dd($this->pdfFileName);
    }

    private function getIntervalDays():array
    {
        return [
            [0, 40000],
            [40000, 124500],
            [124501, 163500],
            [163501, 213500],
            [213500, 0],
        ];
    }

    private function getHeaderTableHtml():string
    {
        return '<table border="1" cellpadding="2" cellspacing="0" style="padding: 40px;">
        <tr style="font-weight: bold;">
            <th align="center" rowspan="3">Дата</th>
            <th align="center" rowspan="3">Час</th>
            <th align="center" colspan="8">Рівень глюкози крові (в ммоль\Л)</th>
        </tr>
        <tr style="font-weight: bold;">
            <th align="center" colspan="2">Сніданок</th>
            <th align="center" colspan="2">Обід</th>
            <th align="center" colspan="2">Вечеря</th>
            <th align="center" rowspan="2">Сон</th>
            <th align="center" rowspan="2">Інше</th>
        </tr>
        <tr style="font-weight: bold;">
            <th align="center">До їжі</th>
            <th align="center">Після</th>
            <th align="center">До їжі</th>
            <th align="center">Після</th>
            <th align="center">До їжі</th>
            <th align="center">Після</th>
        </tr>';
    }

    private function getHtmlCopyText(): string
    {
        return '<p>
        Сайт розроблено для допомоги людям, які хворіють на цукровий діабет.
        На сайті немає і ніколи не буде реклами,
        пітримати проект можна на PayPal: bogdan.karpow@ukr.net,
        monobank: 4441 1144 0148 4884
        </p><p>
        tsukor-norm.pp.ua 2023рік. © розробник Богдан Карпов bogdan.karpow@ukr.net, dexby101#gmail.com
        </p>';
    }

    /**
     * Конвертує рядок з датою в інтове значення.
     * Тобто "17:00:00" в 170000, для зручності умовних гілок
     * @param string $time
     * @return int
     */
    private function strToIntTime(string $timeString):int
    {
        return (int)str_replace(":", "", $timeString);
    }

    /**
     * Метод створює звіт pdf на основі данних які йому передано.
     * Повертає вміст згенерованого файлу pdf.
     */
    private function writerDataPdf($data, $allDate=[]) {
        $this->initPdf();
        $this->pdf->SetFont('dejavusans', '', 11);
        $html = '<h1>Ваш цукор крові</h1>
        <p>Звіт по цукрам крові згенеровано за допомогою сайту <a href="http://tsukor-norm.pp.ua">SugarNorm</a></p>';
        $html .= $this->getHeaderTableHtml();
        $in = $this->getIntervalDays();
        $countTrs = 0;
        $maxTrs = 17;
        $dateInfoCount = [];
        foreach($allDate as $ad) {
            $dateInfoCount[$ad->date] = $ad->count;
        }
        $dateUniq = "";
        foreach($data as $dt){
            $countTrs++;

            $html .= "<tr>"; // "New row start"

            // Date column
            if ($dt->date != $dateUniq ) {
                $dateUniq = $dt->date;
                $html .= "<td rowspan=\"{$dateInfoCount[$dt->date]}\">{$dt->date}</td>"; // Date
            }

            $html .= "<td>{$dt->time}</td>"; // Time
            $other = true;
            //Snidanok BeforeFood
            if ($this->strToIntTime($dt->time) >= $in[1][0] &&
                $this->strToIntTime($dt->time) <= $in[1][1] &&
                $dt->before_food ) {
                $html .= "<td>{$dt->glucose}</td>";
                $other = false;
            } else {
                $html .= "<td>-</td>";
            }

            //Snidanok AfterFood
            if ($this->strToIntTime($dt->time) >= $in[1][0] &&
                $this->strToIntTime($dt->time) <= $in[1][1] &&
                $dt->after_food ) {
                $html .= "<td>{$dt->glucose}</td>";
                $other = false;
            } else {
                $html .= "<td>-</td>";
            }

            //Obid BeforeFood
            if ($this->strToIntTime($dt->time) >= $in[2][0] &&
                $this->strToIntTime($dt->time) <= $in[2][1] &&
                $dt->before_food ) {
                $html .= "<td>{$dt->glucose}</td>";
                $other = false;
            } else {
                $html .= "<td>-</td>";
            }

            //Obid After Food
            if ($this->strToIntTime($dt->time) >= $in[2][0] &&
                $this->strToIntTime($dt->time) <= $in[2][1] &&
                $dt->after_food ) {
                $html .= "<td>{$dt->glucose}</td>";
                $other = false;
            } else {
                $html .= "<td>-</td>";
            }

            //Vecherya BeforeFood
            if ($this->strToIntTime($dt->time) >= $in[3][0] &&
                $this->strToIntTime($dt->time) <= $in[3][1] &&
                $dt->before_food ) {
                $html .= "<td>{$dt->glucose}</td>";
                $other = false;
            } else {
                $html .= "<td>-</td>";
            }

            //Vecherya After Food
            if ($this->strToIntTime($dt->time) >= $in[3][0] &&
                $this->strToIntTime($dt->time) <= $in[3][1] &&
                $dt->after_food ) {
                $html .= "<td>{$dt->glucose}</td>";
                $other = false;
            } else {
                $html .= "<td>-</td>";
            }

            // Son, nich
            if ($this->strToIntTime($dt->time) >= $in[4][0] &&
                $this->strToIntTime($dt->time) <= $in[4][1] ||
                $this->strToIntTime($dt->time) >= $in[0][0] &&
                $this->strToIntTime($dt->time) <= $in[0][1]) {
                    $html .= "<td>{$dt->glucose}</td>";
                    $other = false;
            } else {
                $html .= "<td>-</td>";
            }

            // Other
            $html .= $other ? "<td>{$dt->glucose}</td>" : "<td>-</td>" ;

            $html .= "</tr>";

            // Paginate pdf
            // if ($countTrs >= $maxTrs) {
            //     $countTrs = 0;
            //     $dateUniq = "";
            //     $html .= "</table>";
            //     $this->pdf->AddPage();
            //     $this->pdf->writeHTML($html);
            //     $html = "<h3> Ще {$maxTrs} записів з {$dt->date} </h3>";
            //     $html .= $this->getHeaderTableHtml();
            // }
        }
        $html .= "</table>";
        $html .= $this->getHtmlCopyText();
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html);
        $pdfFilePath = $this->getPdfFilePath();
        $this->pdf->Output($pdfFilePath, 'F');
        return file_get_contents($pdfFilePath);
    }

    private function getListMyPdfFiles(): array
    {
        $ls = scandir($this->getPdfDirPath());
        return array_filter($ls, function($item){
            if ($item == "." || $item == "..") return false;
            return (bool) preg_match('#\.pdf$#si', $item);
        });
    }
}
