<?php

namespace App\Http;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcel{

	/**
	 * @method create
     * @param $title ... title
     * @param $data =   [
                            'personal'=> [ //<----sheet
                                [
                                    'first name' => 'john',
                                    'last name' => 'cena'
                                ],
                                [
                                    'first name' => 'bob',
                                    'last name' => 'ross'
                                ],
                            ],
                            'phone'=> [ //<----sheet
                                [
                                    'cell' => 'provider 1',
                                    'phone' => '628123'
                                ],
                                [
                                    'cell' => 'provider 2',
                                    'phone' => '628456'
                                ],
                            ]
                        ]; ... data
	 */
    public static function create($title,$data) //,$header,$data
    {
        if(file_exists($title.'.xlsx')){
            unlink($title.'.xlsx');
        }
    	$spreadsheet = new Spreadsheet();

        //get sheet
        $sheet = [];
        foreach($data as $key => $val)
        {
            array_push($sheet, $key);
        }
        if(count($sheet) > 0){
            if(count($data[$sheet[0]]) > 0)
            {
                    //sheet 1
                    $spreadsheet->getActiveSheet()
                                ->setTitle($sheet[0]);
                    $spreadsheet->setActiveSheetIndex(0);
                    $string = 'A';
                    $number = 1;
                    //set header sheet 1
                    foreach($data[$sheet[0]][0] as $key => $row)
                    {
                        $cellNumber = $string.$number;
                        $spreadsheet->setActiveSheetIndex(0)
                                    ->setCellValue($cellNumber, $key);
                        ++$string;
                    }

                    $number = 2;
                    //set data in sheet 1
                    foreach ($data[$sheet[0]] as $value) {
                        $string = 'A';
                        foreach($value as $key => $row)
                        {
                            $cellNumber = $string.$number;
                            $spreadsheet->setActiveSheetIndex(0)
                                        ->setCellValue($cellNumber, $row);
                            ++$string;
                        }
                        $number++;
                    }

                    //if more than 1 sheet
                    if(count($sheet) > 1)
                    {
                        //sheet 2 ... n
                        $n = count($data);
                        for($i=1;$i<$n;$i++)
                        {
                            $spreadsheet->createSheet();
                            $string = 'A';
                            $number = 1;
                            //set header sheet n
                            foreach($data[$sheet[$i]][0] as $key => $row)
                            {
                                $cellNumber = $string.$number;
                                $spreadsheet->setActiveSheetIndex($i)
                                            ->setCellValue($cellNumber, $key);
                                ++$string;
                            }

                            $number = 2;
                            //set data in sheet n
                            foreach ($data[$sheet[$i]] as $value) {
                                $string = 'A';
                                foreach($value as $key => $row)
                                {
                                    $cellNumber = $string.$number;
                                    $spreadsheet->setActiveSheetIndex($i)
                                                ->setCellValue($cellNumber, $row);
                                    ++$string;
                                }
                                $number++;
                            }
                            $spreadsheet->getActiveSheet()
                                    ->setTitle($sheet[$i]);
                        }
                    }

                $spreadsheet->setActiveSheetIndex(0);

                //save
                $writer = new Xlsx($spreadsheet);
                $writer->save($title.'.xlsx');
            }else{
                print_r('no data found');
            }
        }else{
            print_r('no data found');
        }
    }
}