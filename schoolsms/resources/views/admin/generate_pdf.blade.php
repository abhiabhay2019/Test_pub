<!DOCTYPE html>
<html>
<head>
    <title>Your School Name | Fees Receipt</title>
  
<!------ Include the above in your HEAD tag ---------->
</head>

<div class="container">
    <div class="receipt-header">
    <h3>Your School Name</h3>
    <h5>Complete School Address Goes Here!</h5>
    <h5>Mob: 9876541230, 9874563210</h5>
    <h5>Udise No.-20040112502</h5>
    </div>
    
    <hr/>
    
    @foreach($data as $dt)
    <div class="student-info">
        <div class="row1">
               <li class="column1">Receipt No.:- </li> 
                <li class="column2">{{$dt->FEES_RECEIPT_NO}}</li>
                <li class="column3">Date :- </li>
                <li class="column4">{{$dt->RECEIVED_DATE}}</li>
        </div>
        
        <div class="row2 m10">
               <li class="column1">Reg. No.:- </li> 
                <li class="column2">{{$dt->ADMISSION_NO}}</li>
        
               <li class="sname">Student Name :-</li> 
                <li class="sname1">{{$dt->STUDENT_NAME}}</li>
                
                <li class="fname">Father's Name :- </li> 
                <li class="fname1">{{$dt->S_FATHER_NAME}}</li>
        </div>
        
        <div class="row2 m10">
               <li class="column1">Class / Standard</li> 
                <li class="column2">{{$dt->CLASS_NAME}}</li>
                <!--<div class="column3">Section </div>
                <div class="column4">Primary</div>!-->
        </div>
    </div>
   
    <div class="body_data">
        <hr/>
        <div class="body-header">
            <h3>Fee Receipt</h3>
            
        </div>
        
        <table class="table">
            <thead>
                <tr class="thead">
                    <th class="d1">Student's Fees Details</th>
                    <th>Amount</th>
                </tr>
            </thead>
           <tbody>
            @foreach($fees as $fee)
        <tr class="tbody-row" rowspan="5">
            <td class="td1">{{$fee->FEES_NAME}}</td>
            <td>&nbsp;{{$fee->FEES_AMT}}</td>
        </tr>
        
        @endforeach
        <tr class="dummy-row" style="height: 20px;">
            <td style="height: 20px; border-right: 1px solid black;"></td>
            <td style="height: 20px;"></td>
        </tr>
        </tbody>
        <tfoot>
            <tr class="tf-tr" style="border-bottom: 1px solid black;">
                <td class="tf-td">Total Fees</td>
            <td class="cols2" style="padding: -10px; margin: 0px;">{{$dt->TOTAL_FEES}}</td>
            </tr>
            
        <tr class="tf-tr">
            <td class="tf-td">Paid Fees</td>
            <td>{{$dt->RECEIVED_AMT}}</td>
        </tr>
            <tr class="tf-tr">
            <td class="tf-td">Balance Fees</td>
            <td>{{$dt->BALANCE_AMT}}</td>
        </tr>
        </tfoot>
        </table>
        <br/>
        <table class="payment-tbl" border="1">
            <thead>
                <tr>
                    <th>Payment Mode</th>
                    <th>Ref/UTR No</th>
                    <th>Payment Date</th>
                    <th>Payment Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pmt as $payment)
                <tr class="pmt-body">
                    <td>{{$payment->PAYMENT_MODE}}</td>
                    <td>{{$payment->REFERENCE_NO}}</td>
                    @php
                    $pmt_date = date("d-m-Y", strtotime($payment->PAYMENT_DATE));
                    @endphp
                    <td>{{$pmt_date}}</td>
                    <td>{{$payment->PAYMENT_AMT}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @php
        
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number = $dt->RECEIVED_AMT;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eghteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  //echo $result . "Rupees  " . $points . " Paise";
 
        @endphp
        <div style="padding: -10px; margin-top: 10px;">
            <div class="cols_final first" style="padding: -10px; display: inline;">Thanks We Have Received Of Rs.:- {{$result}} Only.</div>
            <div class="cols2" style="padding: -10px; margin: 0px; display: inline;">{{$dt->RECEIVED_AMT}}/-</div>
        </div>
    </div>
    @endforeach
    <div class="footer" style="margin-top: 20px">
        <strong>For ( Your School Name )</strong>
        <br>
        <br>
        <br>
        <h4>This Receipt Is System Generated Hence Signature Is Not Required</h4>
    </div>
    </div>
</div>

<style>
    .container{
        margin: 0;
        padding: 0;
        width: 100%;
        margin-top: -10px;
    }
    
    .receipt-header{
        padding: 10px;
    }
    .receipt-header h3{
        font-weight: bold;  
        font-size:30px; 
        line-height:0px;
        color: black;
        text-align: left;
    }
    
    .receipt-header h5{
        font-weight: bold;  
        font-size:15px; 
        line-height:0px;
        color: black;
        text-align: left;
    }
    
    .container hr{
        margin-top: -20px;
        width: 100%;
        border: 2px solid maroon;
    }
    .body_data hr{
         margin-top: 5px;
        width: 100%;
        border: 2px solid maroon;
    }
    
    .student-info .row1 li{
        display: inline;
    }
    
    .student-info .m10{
        margin-top: 20px;
    }
    .student-info .row2 li{
        display: inline;
    }
    
    .column1{
        width: 10%;
        padding: 10px;
        box-sizing: border-box;
    }
    
    .column2{
        width: 30%;
        padding: 10px;
        box-sizing: border-box;
    }
    
    
    .column3{
        width: 10%;
        padding: 10px;
        margin-left: 250px;
    }
    
    .column4{
        width: 32%;
        padding: 10px;
        
    }
    
    .sname{
        margin-left: 50px;
    }
    
    .fname{
        margin-left: 50px;
    }
    .body-header{
        background-color: #000;
    }
    
    .body-header h3{
        color: #fff;
        font-size: 20px;
        font-weight: bold;
        text-transform: uppercase;
        padding: 5px;
        margin-top: -2px;
        width: 100%;
        text-align: center;
    }
    
    .table{
        border: 1px solid black;
        width: 100%;
    }
    
    .table thead{
        border: 1px solid black;
    }
    
    .table thead .d1{
        border-right: 1px solid black;
    }
    .tbody-row td{
        padding: 5px;
    }
    
    .tbody-row .td1{
        border-right: 1px solid black;
    }
    .table tfoot{
        border: 1px solid black;
    }
    .table tfoot tr td{
        border-bottom: 1px solid black;
    }
    .tf-td{
        border-right: 1px solid black;
    }
    /*============== payment table ====================*/
    .payment-tbl{
        width: 100%;
    }
    .pmt-body{
        text-align: center;
    }
</style>