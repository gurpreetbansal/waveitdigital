<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RpExportInvoice implements FromCollection,WithHeadings
{

	private $response;

	public function __construct($response) 
	{
        $this->response = $response;
	}

	public function headings(): array {
		return [
			"Date","Duration","Description","Invoice Id","Amount","Status","Discount","Amount Paid"
		];
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $invoices = $this->response;
        $array = array();
        if(isset($invoices) && !empty($invoices)){
            foreach($invoices as $invoice){
                $discounted_amount = 0.00;
                $array[] = [
                    'date' => date('Y-m-d H:i A',strtotime($invoice['created_at'])),
                    'duration' => date('M d,Y',strtotime($invoice['current_period_start'])).' - '.date('M d,Y',strtotime($invoice['current_period_end'])),
                    'description' => $invoice->packageDetail->name .' -  Subscription',
                    'invoice_id'=> $invoice['invoice_number'],
                    'amount'=>'$'.number_format($invoice['amount'],2),
                    'status'=> $invoice['invoice_status'],
                    'discount'=> '$'.$discounted_amount,
                    'amount_paid'=> '$'.number_format($invoice['amount'],2)
                ];
            }
        }
        return collect($array);
    }
}