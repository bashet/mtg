<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
@include('sweet::alert')
<script>
    $('#flash-overlay-modal').modal();
</script>