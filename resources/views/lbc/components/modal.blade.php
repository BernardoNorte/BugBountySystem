@php
    // Define a $attrs se ela não existir
    $attrs = $attrs ?? collect([]);

    $dialog = $dialog ?? ['class' => 'modal-dialog']; // Definir um valor padrão para $dialog

@endphp

<div {!! $attributes->merge($attrs->toArray()) !!} tabindex="-1" role="dialog">
  <div class="{!! $dialog['class'] !!}" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $body }}
      </div>
      <div class="modal-footer">
        {{ $footer }}
      </div>
    </div>
  </div>
</div>
