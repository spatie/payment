{{--do not use Form::open because we don't want the hidden token field --}}
<form method="POST" action="{{ Config::get('payment.europabank.mpiUrl') }}" accept-charset="UTF-8">

{{ Form::hidden('Uid', Config::get('payment.europabank.uid'))}}
{{ Form::hidden('Orderid', $order->getPaymentOrderId()) }}
{{ Form::hidden('Amount', $order->getPaymentAmount()) }}
{{ Form::hidden('Description', $order->getPaymentDescription()) }}
{{ Form::hidden('Hash', $hash) }}
{{ Form::hidden('Beneficiary', Config::get('app.name')) }}
{{ Form::hidden('Redirecttype', 'DIRECT') }}
{{ Form::hidden('Redirecturl', URL::route(Config::get('payment.europabank.paymentLandingPageRoute'))) }}
{{ Form::hidden('Chemail', $order->getCustomerEmail()) }}
{{ Form::hidden('Chlanguage', $order->getCustomerLanguage()) }}

@if (Config::get('payment.europabank.formCss'))
    {{ Form::hidden('Css', Config::get('payment.europabank.formCss')) }}
@endif

@if (Config::get('payment.europabank.formTitle'))
    {{ Form::hidden('Title', Config::get('payment.europabank.formTitle')) }}
@endif

@if (Config::get('payment.europabank.merchantEmail'))
    {{ Form::hidden('MerchantEmail', Config::get('payment.europabank.merchantEmail')) }}
@endif

@if (Config::get('payment.europabank.secondChangeEmailSender'))
    {{ Form::hidden('Emailfrom', Config::get('payment.europabank.secondChangeEmailSender')) }}
@endif

{{ Form::submit('Betalen') }}


</form>