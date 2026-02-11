<div id='header{{ $index }}' data-collapsed="{{ $form['collapsed'] === false ? 'false' : 'true' }}"
    class='header-title form-divider'>
    <h4>
        <strong><i class='{{ $form['icon'] ?: 'fa fa-check' }}'></i> {{ $form['label'] }}</strong>
        <span class='float-end icon'><i class='fa fa-minus-square-o'></i></span>
    </h4>
</div>
