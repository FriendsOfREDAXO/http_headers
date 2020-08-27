<?php

// https://codepen.io/James97/pen/LRmPmb

$content = '';

// dump(rex_system_report::factory()->get(3));

$addon = rex_addon::get('http_header');

$func = rex_request('func', 'string');

if ($func == 'update') {

    $this->setConfig(rex_post('config', [
        ['x-frame-options_fb', 'int'],
        ['x-frame-options', 'string'],
        ['xframeurl', 'string'],
        ['referrerpolicy', 'int'],
        ['strict-transport-security_lifetime', 'int'],
        ['strict-transport-security_subdomain', 'string'],
        ['strict-transport-security_preload', 'int'],
        ['x-powered-by_fb', 'int'],
        ['x-powered-by-always-unset', 'int'],
        ['x-content-type-options-nosniff_fb', 'int'],
        ['x-content-type-options-nosniff', 'int'],

    ]));

    echo rex_view::success('Die Einstellungen wurden gespeichert');
}

// --------
// -------- X-Frame-Options
// --------
$content .= '<div class="fieldsetwrapper green">';
$content .= '<fieldset>';
$content .= '<legend>X-Frame-Options';
$content .= '<a class="help-block rex-note" data-toggle="modal" href="#xframe">Mehr Informationen</a>';
$content .= '</legend>';

$content .= '<div class="fb_check"> ';
$formElements = [];
$n = [];
$n['label'] = '<label>Frontend <b>UND</b> Backend</label>';
$n['field'] = '<input type="checkbox" class="toggle" id="x-frame-options_fb" name="config[x-frame-options_fb]"' . (!empty($this->getConfig('x-frame-options_fb')) && $this->getConfig('x-frame-options_fb') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');
$content .= '</div>';

$formElements = [];
$n = [];
$n['label'] = '<label for="xframeselect">Auswahl</label>';
$select = new rex_select();
$select->setId('xframeselect');
$select->setAttribute('class', 'form-control');
$select->setName('config[x-frame-options]');
$select->addOption('-', '');
$select->addOption('deny', 'deny');
$select->addOption('sameorigin', 'sameorigin');
$select->addOption('allow-from uri', 'allow-from');
$select->setSelected($this->getConfig('x-frame-options'));
$n['field'] = $select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

$content .= '<fieldset id="xframesurl">';
$formElements = [];
$n = [];
$n['label'] = '<label for="xframeurl">URL</label>';
$n['field'] = '<input class="form-control" type="text" id="xframeurl" name="config[xframeurl]" placeholder="Immer die vollständige URL mit https:// angeben" value="' . $this->getConfig('xframeurl') . '"/>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');
$content .= '</fieldset>';

if ($addon->getConfig('x-frame-options') == 'allow-from' AND $addon->getConfig('xframeurl') == '') {
    $content .= '<p class="alert alert-danger">Sofern bei der Auswahl <b>allow-from uri</b> ausgewählt wurde muß zwingend eine <b>URL angegeben</b> werden.</p>';
}

$content .= '</fieldset>';
$content .= ' 
<div class="modal fade" id="xframe" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">X-Frame-Options
        <span class="close" data-dismiss="modal" aria-label="Close">&times;</span>
        </h2>
      </div>
     <div class="modal-body">
            <p><b>deny</b><br/>
            Die Seite kann nicht in einem iFrame eingebettet werden, egal welches die aufrufende Webseite ist.</p>
            <p><b>sameorigin</b><br/>
            Die Seite kann nur als iFrame eingebettet werden, wenn beide von der gleichen Quellseite stammen.
            <p><b>allow-from uri</b><br/>
            Die Seite lässt sich ausschließlich dann einbetten, wenn die einbettende Seite aus der Quelle uri stammt.</p>
       </div>      
    </div>
  </div>
</div>
';

$content .= '</div>';


// --------
// -------- X-Powered-By
// --------

$content .= '<div class="fieldsetwrapper green">';
$content .= '<fieldset>';
$content .= '<legend>X-Powered-By';
$content .= '<a class="help-block rex-note" data-toggle="modal" href="#x-powered-by">Mehr Informationen.</a>';
$content .= '</legend>';


$content .= '<div class="fb_check"> ';
$formElements = [];
$n = [];
$n['label'] = '<label>Frontend <b>UND</b> Backend</label>';
$n['field'] = '<input type="checkbox" class="toggle" id="x-powered-by_fb" name="config[x-powered-by_fb]"' . (!empty($this->getConfig('x-powered-by_fb')) && $this->getConfig('x-powered-by_fb') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');
$content .= '</div>';


$formElements = [];
$n = [];
$n['label'] = '<label>always unset</label>';
$n['field'] = '<input type="checkbox" class="toggle" id="x-powered-by-always-unset" name="config[x-powered-by-always-unset]"' . (!empty($this->getConfig('x-powered-by-always-unset')) && $this->getConfig('x-powered-by-always-unset') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');
$content .= '</fieldset>';

$content .= ' 
<div class="modal fade" id="x-powered-by" tabindex="-1" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">X-Powered-By
        <span class="close" data-dismiss="modal" aria-label="Close">&times;</span>
        </h2>
      </div>
     <div class="modal-body"> 
            <p>X-Powered-By kann die verwendete PHP Version zurückgeben und je weniger Infos ein Angreifer hat desto besser! Also: ABSCHALTEN! </p>
       </div>      
    </div>
  </div>
</div>
';

$content .= '</div>';







// --------
// -------- Referrer-Policy
// --------

$content .= '<div class="fieldsetwrapper green">';
$content .= '<fieldset>';
$content .= '<legend>Referrer-Policy';
$content .= '<a class="help-block rex-note" data-toggle="modal" href="#referrerpolicy_modal">Mehr Informationen.</a>';
$content .= '</legend>';

$content .= '<div class="fb_check"> ';
$formElements = [];
$n = [];
$n['label'] = '<label>Frontend <b>UND</b> Backend</label>';
$n['field'] = '<input type="checkbox" class="toggle" id="referrerpolicy_fb" name="config[referrerpolicy_fb]"' . (!empty($this->getConfig('referrerpolicy_fb')) && $this->getConfig('referrerpolicy_fb') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');
$content .= '</div>';

$formElements = [];
$n = [];
$n['label'] = '<label for="xframeselect">Auswahl</label>';
$select = new rex_select();
$select->setId('referrerpolicy');
$select->setAttribute('class', 'form-control');
$select->setName('config[referrerpolicy]');
$select->addOption('-', '');
$select->addOption('no-referrer', 'no-referrer');
$select->addOption('no-referrer-when-downgrade', 'no-referrer-when-downgrade');
$select->addOption('same-origin', 'same-origin');
$select->addOption('origin', 'origin');
$select->addOption('strict-origin', 'strict-origin');
$select->addOption('origin-when-cross-origin', 'origin-when-cross-origin');
$select->addOption('strict-origin-when-cross-origin', 'strict-origin-when-cross-origin');
$select->addOption('unsafe-url', 'unsafe-url');
$select->setSelected($this->getConfig('referrerpolicy'));
$n['field'] = $select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

$content .= '</fieldset>';

$content .= ' 
<div class="modal fade" id="referrerpolicy_modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Referrer-Policy
        <span class="close" data-dismiss="modal" aria-label="Close">&times;</span>
        </h2>
      </div>
     <div class="modal-body">
            <p><b>no-referrer</b><br/>
            Der Referer-Header wird vollständig weggelassen. Es werden keine Referrer-Informationen zusammen mit Anfragen gesendet.</p>
            
            <p><b>no-referrer-when-downgrade</b><br/>
            Dies ist das Standardverhalten, wenn keine Richtlinie angegeben ist oder wenn der angegebene Wert ungültig ist.</p>

            <p><b>same-origin</b><br/>
            Der Wert `same-origin` weist den Browser an, nur Referer Header zu senden, die von Ihrer Webseite gestellt werden. Wenn das Ziel eine andere Domain ist, werden keine Referrer-Informationen gesendet.</p>       

            <p><b>origin</b><br/>
            Damit wird immer die Origin der auslösenden Seite in den Referer Informationen des Requests mitgegeben. Es werden allerdings keine Informationen zum genauen Pfad weitergegeben</p>

            <p><b>strict-origin</b><br/>
            Der Wert `strict-origin` weist den Browser an, als Referer Header immer die Ursprungs-Domain anzugeben.
            </p>            

            <p><b>origin-when-cross-origin</b><br/>
            Der Wert `origin-when-cross-origin` weist den Browser an, nur dann die vollständige Referrer-URL zu senden, wenn Sie auf der selben Domain bleiben. Sobald die Domain über HTTPS verlassen wird oder eine anderer Domain angesprochen wird, wird nur die Quell-Domain gesendet.</p>

            <p><b>strict-origin-when-cross-origin</b><br/>
            Wie bei strict-origin handelt es sich bei strict-origin-when-cross-origin ebenfalls um eine Verschärfung einer bestehenden Regel. Es gelten die Regeln von origin-when-cross-origin. Zusätzlich werden allerdings die Referer Informationen entfernt, wenn der Request von einer HTTPS Seite zu einer HTTP Seite ausgelöst wird.</p>
            
            <p><b>unsafe-url</b><br/>
            Mit dieser Einstellung wird der Browser dazu angewiesen, bei jedem Request die volle URL im Referer Header mitzusenden.</p>
                                    


                 
            
       </div>      
    </div>
  </div>
</div>
';

$content .= '</div>';



// --------
// -------- X-Content-Type-Options
// --------

$content .= '<div class="fieldsetwrapper orange">';
$content .= '<fieldset>';
$content .= '<legend>X-Content-Type-Options';
$content .= '<a class="help-block rex-note" data-toggle="modal" href="#xcontentttypeoptions">Mehr Informationen.</a>';
$content .= '</legend>';


$content .= '<div class="fb_check"> ';
$formElements = [];
$n = [];
$n['label'] = '<label>Frontend <b>UND</b> Backend</label>';
$n['field'] = '<input type="checkbox" class="toggle" id="x-content-type-options-nosniff_fb" name="config[x-content-type-options-nosniff_fb]"' . (!empty($this->getConfig('x-content-type-options-nosniff_fb')) && $this->getConfig('x-content-type-options-nosniff_fb') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');
$content .= '</div>';


$formElements = [];
$n = [];
$n['label'] = '<label>nosniff</label>';
$n['field'] = '<input type="checkbox" class="toggle" id="x-content-type-options-nosniff" name="config[x-content-type-options-nosniff]"' . (!empty($this->getConfig('x-content-type-options-nosniff')) && $this->getConfig('x-content-type-options-nosniff') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');
$content .= '</fieldset>';

$content .= ' 
<div class="modal fade" id="xcontentttypeoptions" tabindex="-1" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">X-Content-Type-Options
        <span class="close" data-dismiss="modal" aria-label="Close">&times;</span>
        </h2>
      </div>
     <div class="modal-body"> 
            <p><i>nosniff</i> wird auch dann erzwungen, wenn der Content-Type nicht angegeben ist.</p>
       </div>      
    </div>
  </div>
</div>
';

$content .= '</div>';

/*
// --------
// -------- Strict-Transport-Security
// --------

$content .= '<div class="fieldsetwrapper red">';
$content .= '<fieldset>';
$content .= '<legend>Strict-Transport-Security  (** noch ohne Funktion **)';
$content .= '<a class="help-block warning rex-note" data-toggle="modal" href="#stricttransportsecurity">Wichtige Informationen. Unbedingt lesen!</a>';
$content .= '</legend>';

$formElements = [];
$n = [];
$n['label'] = '<label for="strict-transport-security_lifetime">Lebensdauer</label>';
$n['field'] = '<input class="form-control" type="text" id="strict-transport-security_lifetime" name="config[strict-transport-security_lifetime]" placeholder="Lebensdauer in Sekunden (31536000)" value="' . $this->getConfig('strict-transport-security_lifetime') . '"/>';
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');


$formElements = [];
$n = [];
$n['label'] = '<label>includeSubDomains</label>';
$n['field'] = '<input type="checkbox" class="toggle" id="strict-transport-security_subdomain" name="config[strict-transport-security_subdomain]"' . (!empty($this->getConfig('strict-transport-security_subdomain')) && $this->getConfig('strict-transport-security_subdomain') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');


$formElements = [];
$n = [];
$n['label'] = '<label>preload</label>';
$n['field'] = '<input type="checkbox" class="toggle" id="strict-transport-security_subdomain" name="config[strict-transport-security_preload]"' . (!empty($this->getConfig('strict-transport-security_preload')) && $this->getConfig('strict-transport-security_preload') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');

if (($addon->getConfig('strict-transport-security_subdomain') == '1' OR $addon->getConfig('strict-transport-security_preload') == '1') AND $addon->getConfig('strict-transport-security_lifetime') == '') {
    $content .= '<p class="alert alert-danger">Es muß eine Lebensdauer angegeben werden!</p>';
}

$content .= '</fieldset>';

$content .= ' 
<div class="modal fade" id="stricttransportsecurity" tabindex="-1" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" >
      <div class="modal-header">
        <h2 class="modal-title">Strict-Transport-Security
        <span class="close" data-dismiss="modal" aria-label="Close">&times;</span>
        </h2>
      </div>
      <div class="modal-body">
            <p>Hier muß zwingend eine Info hin...</p>
       </div>      
    </div>
  </div>
</div>
';

$content .= '</div>';



*/




// -------- Buttons

$formElements = [];
$n = [];
$n['field'] = '<a class="btn btn-abort" href="' . rex_url::currentBackendPage() . '">Abbrechen</a>';
$formElements[] = $n;

$n = [];
$n['field'] = '<button class="btn btn-apply rex-form-aligned" type="submit" name="send" value="1"' . rex::getAccesskey(rex_i18n::msg('update'), 'apply') . '>Einstellungen speichern</button>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');


// -------- generate Page

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title','Einstellungen');
$fragment->setVar('body', $content, false);
$fragment->setVar('buttons', $buttons, false);
$content = $fragment->parse('core/page/section.php');

$content = '
    <form action="' . rex_url::currentBackendPage() . '" method="post">
        <input type="hidden" name="func" value="update">
        ' . $content . '
    </form>';

echo $content;

?>

<script>

    $(document).on('rex:ready', function () {
        <?php
            if ($this->getConfig('x-frame-options') != 'allow-from') {
               echo "$('#xframesurl').css('display','none');";
            }
        ?>
    });

    $('#xframeselect').change(function(){
        if ($(this).val() == 'allow-from') {
            $('#xframesurl').slideDown();
        } else {
            $('#xframesurl').slideUp();
        }
    });
</script>

<style>

    .fieldsetwrapper {
        border: 2px solid grey;
        background: #f1f1f1;
        padding: 20px;
        margin: 0 0 10px 0;
    }

    .help-block {
        font-size: 12px;
    }

    .help-block.warning {
        color: #f00;
    }

    .fb_check {
        text-align: right;
        zoom: 0.75;
        margin: -90px 0 60px 0;
    }

    .fb_check label input[type=checkbox].toggle {
        margin-right: 8px;
        margin-top: -1px;
    }



    label input[type=checkbox].toggle {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 3em;
        height: 1.5em;
        background: #ddd;
        vertical-align: middle;
        border-radius: 1.6em;
        position: relative;
        outline: 0;
        margin-right: 16px;
        cursor: pointer;
        -webkit-transition: background 0.1s ease-in-out;
        transition: background 0.1s ease-in-out;

    }
    label input[type=checkbox].toggle::after {
        content: '';
        width: 1.5em;
        height: 1.5em;
        background: white;
        position: absolute;
        border-radius: 1.2em;
        -webkit-transform: scale(0.7);
        transform: scale(0.7);
        left: 0;
        box-shadow: 0 1px rgba(0, 0, 0, 0.5);
        -webkit-transition: left 0.1s ease-in-out;
        transition: left 0.1s ease-in-out;
    }
    label input[type=checkbox].toggle:checked {
        background: #5791CE;

    }
    label input[type=checkbox].toggle:checked::after {
        left: 1.5em;
    }

    .modal {
        background: rgb(42, 57, 70, 80%);

    }

    .modal-content {
        width:100%;
        background: #efefef;
        border: 5px solid #555;
    }

    .modal-title {
        padding: 0 16px 0 16px;
    }

    .modal-body {
        padding: 32px;
        background: #fafafa;
    }

    .green {
        border: 1px solid green;
    }
    .orange {
        border: 2px solid orange;
    }
    .red {
        border: 3px solid red;
    }

    .close {
        padding-top: 8px;
    }

    .modal-dialog-centered {
        display:-webkit-box;
        display:-ms-flexbox;
        display:flex;
        -webkit-box-align:center;
        -ms-flex-align:center;
        align-items:center;
        min-height:calc(100% - (.5rem * 2));
    }

    @media (min-width: 576px) {
        .modal-dialog-centered {
            min-height:calc(100% - (1.75rem * 2));
        }
    }
</style>
