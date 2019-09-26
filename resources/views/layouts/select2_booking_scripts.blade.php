@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".city-select2").select2({
                ajax:{
                    url: '{{route('select.city')}}'
                },
                placeholder: "Pasirinkti miestą",
                language: {
                    "noResults": function () {
                        var modalButton = ' ' +
                            '<button id="modal_toggle" type="button" ' +
                            'class="btn btn-sm btn-success ml-5" ' +
                            'data-toggle="modal" data-target="#create_city_form_modal">\n' +
                            '        Pridėti naują\n' +
                            '</button>';
                        return 'Nėra atitikmenų.' + modalButton;
                    }
                },
                escapeMarkup: function(markup){
                    return markup
                }
            });
            $('#create_city_form_modal').on('show.bs.modal', function(){
                $('.city-select2').select2('close')
            });

            $('.form-modal').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url:"{{route('city.store')}}",
                    data: $('.form-modal').serialize(),
                });
                $('#create_city_form_modal').modal('hide').on('hidden.bs.modal', function(){
                    $(this).find('form').trigger('reset')
                });

            });

            $("#client_id").select2({
                ajax:{
                    url: '{{route('select.client')}}'
                },
                placeholder: "Pasirinkti klientą",
                language: {
                    "noResults": function () {
                        return 'Nėra atitikmenų.  <a href="{{route('client.create')}}" class="btn btn-success btn-sm ml-5">Pridėti naują</a>';
                    }
                },
                escapeMarkup: function(markup){
                    return markup
                }

            });
            $("#driver_id").select2({
                language: {
                    "noResults": function () {
                        return 'Nėra atitikmenų.  <a href="{{route('driver.create')}}" class="btn btn-success btn-sm ml-5">Pridėti naują</a>';
                    }
                },
                escapeMarkup: function(markup){
                    return markup
                }
            });
            $("#truck_id").select2({
                language: {
                    "noResults": function () {
                        return 'Nėra atitikmenų.  <a href="{{route('truck.create')}}" class="btn btn-success btn-sm ml-5">Pridėti naują</a>';
                    }
                },
                escapeMarkup: function(markup){
                    return markup
                }
            });
        });
    </script>
@endsection
