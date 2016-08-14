var app = {
    init: function () {

        $(window).load(function () {

            $('#load').fadeOut('fast');

        })

    },
    table: function (parms) {

        var baseurl = $('link[title="baseurl"]').attr('href');
        var buttons = baseurl + '/plugin/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf';

        //console.log(buttons);

        $('#table').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "searching": parms.search,
            "bLengthChange": parms.bLength,
            "iDisplayLength": parms.iDisplayLength,
            "aaSorting": [[parms.aaSorting, parms.orderBy]],
            "sDom": 'T<"clear">lfrtip',
            tableTools: {
                //"sSwfPath": "http://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",                
                "sSwfPath": buttons,
                "aButtons": [
                    {
                        "sExtends": "csv",
                        "sButtonText": "CSV",
                        "mColumns": parms.mColumnsExport
                    },
                    {
                        "sExtends": "xls",
                        "sButtonText": "XLS",
                        "mColumns": parms.mColumnsExport
                    },
                    {
                        "sExtends": "pdf",
                        "sButtonText": "PDF",
                        "mColumns": parms.mColumnsExport
                    }
                ]
            }
        });

    }, //end table

    tooltip: function () {

        $('[data-toggle="tooltip"]').tooltip();

    },
    filestyle: function () {

        $(window).load(function () {
            $(':file').filestyle({
                buttonText: "selecione...",
                iconName: "fa fa-picture-o",
                placeholder: "sem imagem"
            });
        })

    },
    calcDiscount: function () {

        $('#calc').on('click', function (event) {
            event.preventDefault();

            var price = $('#price').val();
            var discount = $('#discount').val();

            if (price != '' && discount != '' && discount > 0) {

                var value = price.replace(',', '.');

                var percentage = ((discount / 100) * value);
                var total = (value - percentage).toFixed(2);

                $('#res').text('R$ ' + total.replace('.', ',')).removeClass('hide');

            }

        })

    },
    shadowbox: function () {

        Shadowbox.init();

    },
    mask: function (element, format) {

        $(element).mask(format);

    },
    datepicker: function (element) {

        $(element).datepicker({
            format: 'mm/dd/yyyy',
            language: 'pt-BR',
            autoclose: true
        });

    },
    validate: function (form) {

        $(form).validate();

    },
    loadFreight: function () {

        $('#freight').on('change',function () {
            if ($(this).val() == 1) {
                $('#data_freight').slideDown('fast');
                $('#weight, #height, #length, #width').attr('required', true);
            } else {
                $('#data_freight').slideUp('fast');
                $('#weight, #height, #length, #width').removeAttr('required');
            }
        });

    }


};

app.init();