@include('admin/header')
<style>
    .navbar{
        display: none;
    }
</style>
<div class="container form-group" style="overflow: auto;">
    <h2 class="text-center">Fees Structure</h2>
    <table class="table table-bordered table-hover table-striped table-responsive">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Fees Type</th>
                <th>Fees Month</th>
                <th>Fees Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key=>$feesType)
            <tr>
                <th>{{++$key}}</th>
                <th>{{ $feesType->FEES_NAME }}</th>
                <th>{{ $feesType->FEES_MONTHS }}</th>
                <th>{{ $feesType->FEES_AMT }}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container form-group" style="overflow: auto;">
    <h2 class="text-center">Payment Structure</h2>
    <table class="table table-bordered table-hover table-striped table-responsive">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Payment Mode</th>
                <th>Reference Number</th>
                <th>Payment Amount</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data1 as $key=>$payment)
            <tr>
                <th>{{++$key}}</th>
                <th>{{ $payment->PAYMENT_MODE }}</th>
                <th>{{ $payment->REFERENCE_NO }}</th>
                <th>{{ $payment->PAYMENT_AMT }}</th>
                @php $pmtDate = date('d-m-Y', strtotime($payment->PAYMENT_DATE)); @endphp
                <th>@php echo $pmtDate; @endphp</th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
@include('admin/footer')