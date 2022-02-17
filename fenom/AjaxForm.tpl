   {$_modx->runSnippet('!AjaxForm', [
    'snippet'=>'FormIt',
    'hooks'=>'spam,email,FormItSaveForm',
    'form'=>'@FILE:chunks/ajax-form/form-footer.tpl',
    'formName' => 'Заявка с сайта',
    'emailSubject' => 'Форма заказа звонка с сайта:[[++site_url]]',
    'emailTo' => $email,
    'submitVar' => 'myform1',
    'emailTpl' => 'callback.emailTpl',
    'emailFrom' => 'no-reply@mysite.com',
    'validate' => 'name:minLength=^2^, your-name:blank, name:required, phone:required,
message:minLength=^10^',
    'validationErrorMessage' => 'В форме содержатся ошибки!',
    'successMessage' => 'Сообщение успешно отправлено!'
    ])}
    
    
    <h3>С сайта: {$_modx->config.http_host} оставлено сообщение.</h3>
    {if $formName}
    <h4>Форма: {$formName}</h4>
    {/if}

    {if $formTitle}
    <h5>Заявка со страницы: {$formTitle}</h4>
    {/if}

    <b>Имя:</b> {$name}<br />
    {if $phone}
    <b>Телефон:</b> {$phone}<br />
    {/if}
    {if $email}
    <b>Email:</b> {$email}<br />
    {/if}
