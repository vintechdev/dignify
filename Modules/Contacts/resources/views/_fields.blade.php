{!! Honeypot::generate('my_name', 'my_time') !!}
{!! BootForm::hidden('locale')->value(isset($model->locale) ? $model->locale : config('app.locale')) !!}
{!! BootForm::hidden('id') !!}
{!! BootForm::text(__('Name') . ' <span class="asterisk">*</span>', 'name') !!}
{!! BootForm::email(__('Email') . ' <span class="asterisk">*</span>', 'email') !!}
{!! BootForm::text(__('Phone') . ' <span class="asterisk">*</span>', 'phone_number', ['required'=> true]) !!}
{!! BootForm::text(__('Company') . ' <span class="asterisk">*</span>', 'company_name') !!}
{!! BootForm::textarea(__('Message') . ' <span class="asterisk">*</span>', 'message') !!}

<div class="form-group">
    <span class="asterisk">*</span> @lang('Mandatory fields')
</div>
