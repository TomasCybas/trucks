@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            //Handles select search for cities
            $(".city-select2").select2({
                ajax: {
                    url: '{{route('select.city')}}'
                },
                placeholder: "Pasirinkti miestą",
                language: {
                    "noResults": function () {
                        var modalButton =
                            '<button type="button" ' +
                            'class="btn btn-sm btn-success ml-5" ' +
                            'data-toggle="modal" data-target="#create_city_form_modal">' +
                            'Pridėti naują' +
                            '</button>';
                        return 'Nėra atitikmenų.' + modalButton;
                    }
                },
                escapeMarkup: function (markup) {
                    return markup
                }
            });
            //Handles creation of city if no match exists.
            $('#create_city_form_modal').on('show.bs.modal', function () {
                $('.city-select2').select2('close')
            });

            $('#create_city_form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{route('city.store')}}",
                    data: $('#create_city_form').serialize(),
                });
                $('#create_city_form_modal').modal('hide').on('hidden.bs.modal', function () {
                    $(this).find('form').trigger('reset')
                });

            });


            //Handles select search for clients
            $("#client_id").select2({
                ajax: {
                    url: '{{route('select.client')}}'
                },
                placeholder: "Pasirinkti klientą",
                language: {
                    "noResults": function () {
                        var modalButton =
                            '<button type="button" ' +
                            'class="btn btn-sm btn-success ml-5" ' +
                            'data-toggle="modal" data-target="#create_client_form_modal">' +
                            'Pridėti naują' +
                            '</button>';
                        return 'Nėra atitikmenų.' + modalButton;
                    }
                },
                escapeMarkup: function (markup) {
                    return markup
                }
            });

            //Handles creation of client if no match exists.
            $('#create_client_form_modal').on('show.bs.modal', function () {
                $('#client_id').select2('close')
            });

            $('#create_client_form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{route('client.store')}}",
                    data: $('#create_client_form').serialize(),
                });
                $('#create_client_form_modal').modal('hide').on('hidden.bs.modal', function () {
                    $(this).find('form').trigger('reset')
                });

            });


            //Handles select search for drivers
            $("#driver_id").select2({
                language: {
                    "noResults": function () {
                        return 'Nėra atitikmenų.  <a href="{{route('driver.create')}}" class="btn btn-success btn-sm ml-5">Pridėti naują</a>';
                    }
                },
                escapeMarkup: function (markup) {
                    return markup
                }
            });

            //Handles select search for trucks
            $("#truck_id").select2({
                language: {
                    "noResults": function () {
                        return 'Nėra atitikmenų.  <a href="{{route('truck.create')}}" class="btn btn-success btn-sm ml-5">Pridėti naują</a>';
                    }
                },
                escapeMarkup: function (markup) {
                    return markup
                }
            });
        });
    </script>
@endsection
