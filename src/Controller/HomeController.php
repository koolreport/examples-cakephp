<?php

namespace App\Controller;

use Cake\Core\Configure;

class HomeController extends AppController
{
    public function index()
    {
        $public_path = WWW_ROOT;
        // echo "public_path=$public_path<br>";
        // exit;
        // include $public_path . "index_reports.php";
        $this->render('index_reports');
    }

    public function customReport()
    {
        // echo url("/"); echo "<br>";
        // echo url()->current(); echo "<br>";
        // echo base_path(); echo "<br>";
        // echo app_path(); echo "<br>";
        // exit;
        $report = new \App\reports\MyReport();
        $report_content = $report->run()->render(true);
        // echo $report_content;
        // return;
        // return $report_content;
        $this->set('report_content', $report_content);
        return $this->render('custom_report');
    }

    public function report()
    {
        $baseUrl = $this->request->getAttribute('base');
        $currentUrl = $this->request->getRequestTarget();
        $appPath = APP;
        
        $relativePath = ltrim(str_replace($baseUrl, '', $currentUrl), '/');
        $reportPath = $appPath . str_replace('/', DIRECTORY_SEPARATOR, $relativePath) . DIRECTORY_SEPARATOR;
        ob_start();
        include $reportPath . 'run.php';
        $reportContent = ob_get_clean();

        $this->set('report_content', $reportContent);
    }

    public function export()
    {
        $baseUrl = $this->request->getAttribute('base');
        $currentUrl = $this->request->getRequestTarget();
        $appPath = APP;

        $relativePath = ltrim(str_replace($baseUrl, '', $currentUrl), '/');
        $reportPath = $appPath . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
        $reportPath = rtrim($reportPath, DIRECTORY_SEPARATOR);
        $reportPath = substr($reportPath, 0, strrpos($reportPath, DIRECTORY_SEPARATOR)) . DIRECTORY_SEPARATOR;

        if (file_exists($reportPath . "export.php")) {
            include $reportPath . "export.php";
        } elseif (file_exists($reportPath . "exportPDF.php")) {
            include $reportPath . "exportPDF.php";
        } elseif (file_exists($reportPath . "exportExcel.php")) {
            include $reportPath . "exportExcel.php";
        }
    }

    public function exportPDF()
    {
        $baseUrl = $this->request->getAttribute('base');
        $currentUrl = $this->request->getRequestTarget();
        $appPath = APP;

        $relativePath = ltrim(str_replace($baseUrl, '', $currentUrl), '/');
        $reportPath = $appPath . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
        $reportPath = rtrim($reportPath, DIRECTORY_SEPARATOR);
        $reportPath = substr($reportPath, 0, strrpos($reportPath, DIRECTORY_SEPARATOR)) . DIRECTORY_SEPARATOR;

        if (file_exists($reportPath . "exportPDF.php")) {
            include $reportPath . "exportPDF.php";
        }
    }

    public function exportExcel()
    {
        $baseUrl = $this->request->getAttribute('base');
        $currentUrl = $this->request->getRequestTarget();
        $appPath = APP;

        $relativePath = ltrim(str_replace($baseUrl, '', $currentUrl), '/');
        $reportPath = $appPath . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
        $reportPath = rtrim($reportPath, DIRECTORY_SEPARATOR);
        $reportPath = substr($reportPath, 0, strrpos($reportPath, DIRECTORY_SEPARATOR)) . DIRECTORY_SEPARATOR;

        if (file_exists($reportPath . "exportExcel.php")) {
            include $reportPath . "exportExcel.php";
        }
    }
}
