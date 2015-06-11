{{--do not use Form::open because we don't want the hidden token field --}}
<form 
    method="POST"
    action="{{ Config::get('payment::europabank.mpiUrl') }}"
    accept-charset="UTF-8"
    @foreach($attributes as $attribute => $value)
    {{ $attribute }}="{{ $value }}"
    @endforeach
>

{{ Form::hidden('Uid', Config::get('payment::europabank.uid'))}}
{{ Form::hidden('Orderid', $order->getPaymentOrderId()) }}
{{ Form::hidden('Amount', $order->getPaymentAmount()) }}
{{ Form::hidden('Description', $order->getPaymentDescription()) }}
{{ Form::hidden('Hash', $hash) }}
{{ Form::hidden('Beneficiary', Config::get('app.name')) }}
{{ Form::hidden('Redirecttype', 'DIRECT') }}
{{ Form::hidden('Redirecturl', URL::route(Config::get('payment::europabank.paymentLandingPageRoute'))) }}
{{ Form::hidden('Chemail', $order->getCustomerEmail()) }}
{{ Form::hidden('Chlanguage', $order->getCustomerLanguage()) }}

@if (Config::get('payment::europabank.formCss'))
    {{ Form::hidden('Css', Config::get('payment::europabank.formCss')) }}
@endif

@if (Config::get('payment::europabank.template'))
    {{ Form::hidden('Template', Config::get('payment::europabank.template')) }}
@endif


@if (Config::get('payment::europabank.formTitle'))
    {{ Form::hidden('Title', Config::get('payment::europabank.formTitle')) }}
@endif

@if (Config::get('payment::europabank.merchantEmail'))
    {{ Form::hidden('MerchantEmail', Config::get('payment::europabank.merchantEmail')) }}
@endif

@if (Config::get('payment::europabank.secondChanceEmailSender'))
    {{ Form::hidden('Emailfrom', Config::get('payment::europabank.secondChanceEmailSender')) }}
@endif

{{ Form::button(Lang::get('payment::form.submitButtonText'), ["type"=>"submit", "class"=> Config::get('payment::form.submitButtonClass')]) }}


</form>
