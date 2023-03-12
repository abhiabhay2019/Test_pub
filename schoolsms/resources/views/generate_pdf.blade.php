<!DOCTYPE html>
<html>
<head>
    <title>Your School Name | Fees Receipt</title>
</head>
<style>
*{
    margin: 3;
    padding: 3;
    box-sizing: border-box;
}
    
    .border{
        border: 1px solid green;
        padding: 0px;
        margin: 0px;
    }
    
    h1{
        margin-top: 15px;
        padding: 0px;
        text-align: center;
        font-size: 40px;
        line-height: 20px;
    }
    h3{
        text-align: center;
        line-height: 10px;
    }
    .title{
        border: 1px solid blue;
        background-color: lightgrey;
        box-shadow: 10px 10px lightblue;
         margin: 0px;
    }
     h2{
        text-align: center;
        line-height: 15px;
        padding: 0px;
    }
    
    .header_data{
        border: 1px solid black;
        margin: 5px 0px 0px 0px; 
    }
    /* Create three equal columns that floats next to each other */
.column1 {
  float: left;
  width: 25%;
  margin-bottom: -10px;
}
    /* Create three equal columns that floats next to each other */
.column2 {
  float: left;
  width: 25%;
  margin-bottom: -10px;
}

.column3 {
  float: left;
  width: 20%;
  margin-bottom: -10px;
}

.column4 {
  float: left;
  width: 20%;
  margin-bottom: -10px;
}

.row{
    margin: -10px;
    padding: -10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.body_data{
    border: 1px solid black;
    padding: 0px;
    margin: 0px;
}

.cols1 {
  float: left;
  width: 75%;
  margin-bottom: -10px;
}

.cols2 {
  float: left;
  width: 20%;
  margin-bottom: -10px;
}

.body_row:after{
  content: "";
  display: table;
  clear: both;  
}

.top-body{
  border-bottom: 1px solid black;
  margin: 0px;
}

.cols_final{
    float: left;
  width: 75%;
}

.table-row{
    border: 1px solid black;
}

.footer{
    text-align: right;
}

</style>
<body>
    <div class="border">
    <h1>Your School Name</h1>
    <h3>Complete School Address Goes Here!</h3>
    <h3>Mob: 9876541230, 9874563210</h3>
    <h3>Udise No.-20040112502</h3>
    
    <div class="title">
        <h2>FEES RECEIPT</h2>
    </div>
  @foreach($data as $dt)
    <div class="header_data">
        <div class="row">
               <div class="column1">Receipt No.</div> 
                <div class="column2">{{$dt->FEES_MASTER_ID}}{{$dt->PAYMENT_ID}}</div>
                <div class="column3">Date :- </div>
                <div class="column4">{{$dt->RECEIVED_DATE}}</div>
        </div>
        
        <div class="row">
               <div class="column1">Reg. No.</div> 
                <div class="column2">{{$dt->ADMISSION_NO}}</div>
        </div>
        <div class="row">
               <div class="column1">Student Name</div> 
                <div class="column2">{{$dt->STUDENT_NAME}}</div>
        </div>
        <div class="row">
               <div class="column1">Father's Name</div> 
                <div class="column2">{{$dt->S_FATHER_NAME}}</div>
        </div>
        <div class="row">
               <div class="column1">Class / Standard</div> 
                <div class="column2">{{$dt->CLASS_NAME}}</div>
                <!--<div class="column3">Section </div>
                <div class="column4">Primary</div>!-->
        </div>
    </div>
   
    <div class="body_data">
        
        <div class="body_row top-body">
            <div class="cols1 first">Student's Fees Details</div>
            <div class="cols2">Amount</div>
        </div>
        <table style="width: 100%;">
            
            @foreach($fees as $fee)
        <tr class="body_row" style="border: 1px solid black;">
            <td class="cols1 first">{{$fee->FEES_NAME}}</td>
            <td class="cols2">&nbsp;{{$fee->FEES_AMT}}</td>
        </tr>
        @endforeach
        </table>
        
        <div class="body_row" style="border: 1px solid black; margin: 0px; padding: -10px;">
            <div class="cols1" style="padding: -10px; margin: 0px;">Total Fees</div>
            <div class="cols2" style="padding: -10px; margin: 0px;">{{$dt->TOTAL_FEES}}</div>
        </div>
        <div class="body_row top-body" style="padding: -10px;">
            <div class="cols1 first"  style="padding: -10px; margin: 0px;">Paid Fees</div>
            <div class="cols2"  style="padding: -10px; margin: 0px;">{{$dt->RECEIVED_AMT}}</div>
        </div>
        <div class="body_row top-body" style="padding: -10px;">
            <div class="cols1 first" style="padding: -10px; margin: 0px;">Balance Fees</div>
            <div class="cols2" style="padding: -10px; margin: 0px;">{{$dt->BALANCE_AMT}}</div>
        </div>
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
        <div class="body_row top-body" style="padding: -10px;">
            <div class="cols_final first" style="padding: -10px;">Thanks We Have Received Of Rs.:- {{$result}} Only.</div>
            <div class="cols2" style="padding: -10px; margin: 0px;">{{$dt->RECEIVED_AMT}}</div>
        </div>
    </div>
    @endforeach
    <div class="footer">
        <strong>For ( Your School Name )</strong>
        <br>
        <br>
        <br>
        <h4>This Receipt Is System Generated Hence Signature Is Not Required</h4>
    </div>
    </div>
</body>
