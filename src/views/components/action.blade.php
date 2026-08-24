@foreach($addaction as $a)
    <?php
    foreach ($row as $key => $val) {
        $a['url'] = str_replace("[".$key."]", $val, $a['url']);
    }

    $confirm_attrs = '';
    if (isset($a['confirmation']) && ! empty($a['confirmation']) && $a['confirmation']) {

        $a['confirmation_title'] = ! empty($a['confirmation_title']) ? $a['confirmation_title'] : cbLang('confirmation_title');
        $a['confirmation_text'] = ! empty($a['confirmation_text']) ? $a['confirmation_text'] : cbLang('confirmation_text');
        $a['confirmation_type'] = ! empty($a['confirmation_type']) ? $a['confirmation_type'] : 'warning';
        $a['confirmation_showCancelButton'] = empty($a['confirmation_showCancelButton']) ? 'true' : 'false';
        $a['confirmation_confirmButtonColor'] = ! empty($a['confirmation_confirmButtonColor']) ? $a['confirmation_confirmButtonColor'] : '#DD6B55';
        $a['confirmation_confirmButtonText'] = ! empty($a['confirmation_confirmButtonText']) ? $a['confirmation_confirmButtonText'] : cbLang('confirmation_yes');
        $a['confirmation_cancelButtonText'] = ! empty($a['confirmation_cancelButtonText']) ? $a['confirmation_cancelButtonText'] : cbLang('confirmation_no');
        $a['confirmation_closeOnConfirm'] = empty($a['confirmation_closeOnConfirm']) ? 'true' : 'false';

        $confirm_attrs = sprintf(
            " data-confirm-url='%s' data-confirm-title='%s' data-confirm-text='%s' data-confirm-type='%s' data-confirm-show-cancel='%s' data-confirm-button-color='%s' data-confirm-button-text='%s' data-confirm-cancel-text='%s' data-confirm-close-on-confirm='%s'",
            htmlspecialchars($a['url'], ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($a['confirmation_title'], ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($a['confirmation_text'], ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($a['confirmation_type'], ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($a['confirmation_showCancelButton'], ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($a['confirmation_confirmButtonColor'], ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($a['confirmation_confirmButtonText'], ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($a['confirmation_cancelButtonText'], ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($a['confirmation_closeOnConfirm'], ENT_QUOTES, 'UTF-8')
        );
    }

    $label = $a['label'];
    $title = ($a['title'] ?? false) ?: $a['label'];
    $icon = $a['icon'];
    $color = ($a['color'] ?? false) ?: 'primary';
    $confirmation = $a['confirmation'] ?? false;
    $target = ($a['target'] ?? false) ?: '_self';

    $url = $a['url'];
    if (isset($confirmation) && ! empty($confirmation)) {
        $url = '#';
    }

    if (isset($a['showIf'])) {

        $query = $a['showIf'];

        foreach ($row as $key => $val) {
            $query = str_replace("[".$key."]", '"'.$val.'"', $query);
        }

        @eval("if($query) {
          echo \"<a class='btn btn-xs btn-\$color' title='\$title'\$confirm_attrs href='\$url' target='\$target'><i class='\$icon'></i> $label</a>\";
      }");
    } else {
        echo "<a class='btn btn-xs btn-$color' title='$title'$confirm_attrs href='$url' target='$target'><i class='$icon'></i> $label</a>";
    }
    ?>
@endforeach

@if($button_action_style == 'button_text')

    @if(CRUDBooster::isRead() && $button_detail)
        <a class='btn btn-xs btn-primary btn-detail' title='{{cbLang("action_detail_data")}}'
           href='{{CRUDBooster::mainpath("detail/".$row->$pk)."?return_url=".urlencode(Request::fullUrl())}}'>{{cbLang("action_detail_data")}}</a>
    @endif

    @if(CRUDBooster::isUpdate() && $button_edit)
        <a class='btn btn-xs btn-success btn-edit' title='{{cbLang("action_edit_data")}}'
           href='{{CRUDBooster::mainpath("edit/".$row->$pk)."?return_url=".urlencode(Request::fullUrl())."&parent_id=".g("parent_id")."&parent_field=".$parent_field }}'>{{cbLang("action_edit_data")}}</a>
    @endif

    @if(CRUDBooster::isDelete() && $button_delete)
        <?php $url = CRUDBooster::mainpath("delete/".$row->$pk);?>
        <a class='btn btn-xs btn-warning btn-delete' title='{{cbLang("action_delete_data")}}' href='#'
           data-confirm-url='{{ $url }}'
           data-confirm-title='{{ cbLang('delete_title_confirm') }}'
           data-confirm-text='{{ cbLang('delete_description_confirm') }}'
           data-confirm-type='warning'
           data-confirm-show-cancel='true'
           data-confirm-button-color='#ff0000'
           data-confirm-button-text='{{ cbLang('confirmation_yes') }}'
           data-confirm-cancel-text='{{ cbLang('confirmation_no') }}'
           data-confirm-close-on-confirm='false'>{{cbLang("action_delete_data")}}</a>
    @endif
@elseif($button_action_style == 'button_icon_text')


    @if(CRUDBooster::isRead() && $button_detail)
        <a class='btn btn-xs btn-primary btn-detail' title='{{cbLang("action_detail_data")}}'
           href='{{CRUDBooster::mainpath("detail/".$row->$pk)."?return_url=".urlencode(Request::fullUrl())}}'><i
                    class='fa fa-eye'></i> {{cbLang("action_detail_data")}}</a>
    @endif

    @if(CRUDBooster::isUpdate() && $button_edit)
        <a class='btn btn-xs btn-success btn-edit' title='{{cbLang("action_edit_data")}}'
           href='{{CRUDBooster::mainpath("edit/".$row->$pk)."?return_url=".urlencode(Request::fullUrl())."&parent_id=".g("parent_id")."&parent_field=".$parent_field }}'><i
                    class='fa fa-pen'></i> {{cbLang("action_edit_data")}}</a>
    @endif

    @if(CRUDBooster::isDelete() && $button_delete)
        <?php $url = CRUDBooster::mainpath("delete/".$row->$pk);?>
        <a class='btn btn-xs btn-warning btn-delete' title='{{cbLang("action_delete_data")}}' href='#'
           data-confirm-url='{{ $url }}'
           data-confirm-title='{{ cbLang('delete_title_confirm') }}'
           data-confirm-text='{{ cbLang('delete_description_confirm') }}'
           data-confirm-type='warning'
           data-confirm-show-cancel='true'
           data-confirm-button-color='#ff0000'
           data-confirm-button-text='{{ cbLang('confirmation_yes') }}'
           data-confirm-cancel-text='{{ cbLang('confirmation_no') }}'
           data-confirm-close-on-confirm='false'><i class='fa fa-trash'></i> {{cbLang("action_delete_data")}}</a>
    @endif

@elseif($button_action_style == 'dropdown')

    <div class='btn-group btn-group-action'>
        <button type='button' class='btn btn-xs btn-primary btn-action'>{{cbLang("action_label")}}</button>
        <button type='button' class='btn btn-xs btn-primary dropdown-toggle' data-bs-toggle="dropdown">
            <span class='caret'></span>
            <span class='sr-only'>Toggle Dropdown</span>
        </button>
        <ul class='dropdown-menu dropdown-menu-action' role='menu'>
            @foreach($addaction as $a)
                <?php
                foreach ($row as $key => $val) {
                    $a['url'] = str_replace("[".$key."]", $val, $a['url']);
                }

                $label = $a['label'];
                $url = $a['url']."?return_url=".urlencode(Request::fullUrl());
                $icon = $a['icon'];
                $color = $a['color'] ?: 'primary';

                if (isset($a['showIf'])) {

                    $query = $a['showIf'];

                    foreach ($row as $key => $val) {
                        $query = str_replace("[".$key."]", '"'.$val.'"', $query);
                    }

                    @eval("if($query) {
                        echo \"<li><a title='\$label' href='\$url'><i class='\$icon'></i> \$label</a></li>\";
                    }");
                } else {
                    echo "<li><a title='$label' href='$url'><i class='$icon'></i> $label</a></li>";
                }
                ?>
            @endforeach

            @if(CRUDBooster::isRead() && $button_detail)
                <li><a class='btn-detail' title='{{cbLang("action_detail_data")}}'
                       href='{{CRUDBooster::mainpath("detail/".$row->$pk)."?return_url=".urlencode(Request::fullUrl())}}'><i
                                class='fa fa-eye'></i> {{cbLang("action_detail_data")}}</a></li>
            @endif

            @if(CRUDBooster::isUpdate() && $button_edit)
                <li><a class='btn-edit' title='{{cbLang("action_edit_data")}}'
                       href='{{CRUDBooster::mainpath("edit/".$row->$pk)."?return_url=".urlencode(Request::fullUrl())."&parent_id=".g("parent_id")."&parent_field=".$parent_field}}'><i
                                class='fa fa-pen'></i> {{cbLang("action_edit_data")}}</a></li>
            @endif

            @if(CRUDBooster::isDelete() && $button_delete)
                <?php $url = CRUDBooster::mainpath("delete/".$row->$pk);?>
                <li><a class='btn-delete' title='{{cbLang("action_delete_data")}}' href='#'
                       data-confirm-url='{{ $url }}'
                       data-confirm-title='{{ cbLang('delete_title_confirm') }}'
                       data-confirm-text='{{ cbLang('delete_description_confirm') }}'
                       data-confirm-type='warning'
                       data-confirm-show-cancel='true'
                       data-confirm-button-color='#ff0000'
                       data-confirm-button-text='{{ cbLang('confirmation_yes') }}'
                       data-confirm-cancel-text='{{ cbLang('confirmation_no') }}'
                       data-confirm-close-on-confirm='false'><i class='fa fa-trash'></i> {{cbLang("action_delete_data")}}</a></li>
            @endif
        </ul>
    </div>

@else

    @if(CRUDBooster::isRead() && $button_detail)
        <a class='btn btn-xs btn-primary btn-detail' title='{{cbLang("action_detail_data")}}'
           href='{{CRUDBooster::mainpath("detail/".$row->$pk)."?return_url=".urlencode(Request::fullUrl())}}'><i class='fa fa-eye'></i></a>
    @endif

    @if(CRUDBooster::isUpdate() && $button_edit)
        <a class='btn btn-xs btn-success btn-edit' title='{{cbLang("action_edit_data")}}'
           href='{{CRUDBooster::mainpath("edit/".$row->$pk)."?return_url=".urlencode(Request::fullUrl())."&parent_id=".g("parent_id")."&parent_field=".$parent_field}}'><i
                    class='fa fa-pen'></i></a>
    @endif

    @if(CRUDBooster::isDelete() && $button_delete)
        <?php $url = CRUDBooster::mainpath("delete/".$row->$pk);?>
        <a class='btn btn-xs btn-warning btn-delete' title='{{cbLang("action_delete_data")}}' href='#'
           data-confirm-url='{{ $url }}'
           data-confirm-title='{{ cbLang('delete_title_confirm') }}'
           data-confirm-text='{{ cbLang('delete_description_confirm') }}'
           data-confirm-type='warning'
           data-confirm-show-cancel='true'
           data-confirm-button-color='#ff0000'
           data-confirm-button-text='{{ cbLang('confirmation_yes') }}'
           data-confirm-cancel-text='{{ cbLang('confirmation_no') }}'
           data-confirm-close-on-confirm='false'><i class='fa fa-trash'></i></a>
    @endif

@endif

<script nonce="{{ config('view.script_nonce', '') }}" type="text/javascript">
    document.querySelector('#button_action_{{ $row->$pk }} a[data-confirm-url]')?.addEventListener('click', function (e) {
        e.preventDefault();
        var $el = $(this);
        var toBool = function (v, fallback) {
            if (v === undefined || v === null || v === '') return fallback;
            if (typeof v === 'boolean') return v;
            return String(v) !== 'false';
        };
        swal({
            title: $el.data('confirm-title') || '',
            text: $el.data('confirm-text') || '',
            type: $el.data('confirm-type') || 'warning',
            showCancelButton: toBool($el.data('confirm-show-cancel'), true),
            confirmButtonColor: $el.data('confirm-button-color') || '#DD6B55',
            confirmButtonText: $el.data('confirm-button-text') || 'Yes',
            cancelButtonText: $el.data('confirm-cancel-text') || 'No',
            closeOnConfirm: toBool($el.data('confirm-close-on-confirm'), true)
        }, function () {
                location.href = $el.data('confirm-url');
            });
        });
</script>