var store = {
    formHandler: function (element, msg_success, callback_function) {

        var load = $('div#loading');

        $(element).on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                type: $(element).attr('method'),
                url: $(element).attr('action'),
                data: $(element).serialize(),
                beforeSend: function () {
                    load.fadeIn('fast', function () {
                        $(this).find('p').empty().html('<i class="fa fa-spinner fa-fw fa-spin"></i> Por favor aguarde...').fadeIn('fast');
                    });
                },
                success: function (data) {
                    console.log(data)
                    var output = '';
                    if (!data.success) {
                        if (!data.array) {
                            output = data.message + ' <i class="fa fa-times remove-loading"></i>';
                        } else {
                            for (key in data.errors) {
                                output += data.errors[key] + '<br>';
                            }
                        }
                    } else {
                        output += '<i class="fa fa-check fa-fw"></i> ' + msg_success;
                        $(element)[0].reset();
                        if (typeof callback_function == 'function') {
                            callback_function();
                        }
                    }
                    load.find('p').empty().html(output);
                    if (callback_function != null) {
                        window.setTimeout(function () {
                            load.fadeOut('fast');
                        }, 3500);
                    }

                },
                error: function () {                	
                }
            })
        });
    },    
    loadingProducts: function () {

        var load = $('div#loading');
        var listProducts = $('#listProducts');
        var paginate = $('button#paginate');
        var paginateText = paginate.text();
        var numProducts = 6;
        var count = $('b#count');

        paginate.on('click', function (event) {

            event.preventDefault();

            var url = $(this).val();
            var field = $('input#field').val();
            var featured = $('input#featured').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            //console.log('field='+field+'&featured='+featured);
            $.ajax({
                url: url,
                type: 'GET',
                data: 'field=' + field + '&featured=' + featured,
                beforeSend: function () {
                    paginate.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin fa-fw"></i> Aguarde, carregando...')
                },
                success: function (response) {
                    numProducts += response.numProducts;
                    if (response.next == null) {
                        paginate.text('todos produtos listados!')
                    } else {
                        paginate.removeAttr('disabled').text(paginateText)
                    }
                    count.text(numProducts);
                    paginate.val(response.next);
                    listProducts.append(response.products);
                }
            })
        })
    },
    filterProducts: function () {

        $('select#order').on('change', function () {

            var load = $('div#loading');
            var listProducts = $('div#listProducts');
            var field = $($(this).val());
            var featured = $('input#featured').val();
            var numProducts = 6;
            var paginate = $('button#paginate');
            var paginateText = paginate.text();
            var count = $('b#count');

            $('input#field').val(field.selector);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: '/produtos',
                type: 'GET',
                data: 'field=' + field.selector + '&featured=' + featured,
                beforeSend: function () {
                    listProducts.empty();
                    paginate.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin fa-fw"></i> aguarde, ordenando...')

                },
                success: function (response) {
                    if (response.next == null) {
                        paginate.text('todos produtos listados!')
                    } else {
                        paginate.removeAttr('disabled').text(paginateText)
                    }
                    count.text(numProducts);
                    paginate.val(response.next);
                    listProducts.empty().html(response.products);

                }
            })
        })
    },
    search: function () {

        function slugify(text)
        {
            return text.toString().toLowerCase()
                    .replace(/[àáâãäå]/, "a")
                    .replace(/[óòôõö]/, "o")
                    .replace(/[éèêẽë]/, "e")
                    .replace(/[íì]/, "i")
                    .replace(/\s+/g, '-')           // Replace spaces with -
                    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                    .replace(/^-+/, '')             // Trim - from start of text
                    .replace(/-+$/, '');            // Trim - from end of text
        }

        var baseurl = $('link[title="baseurl"]').attr('href');
        var form = $('form#search');
        var form2 = $('form#search2');
        var search = $('input[name="search"]');
        var search2 = $('input[name="search2"]');        

        form.submit(function (event) {
            event.preventDefault();
            window.location.href = baseurl + '/pesquisar/' + slugify(search.val());
        })

        form2.submit(function (event) {
            event.preventDefault();
            window.location.href = baseurl + '/pesquisar/' + slugify(search2.val());
        })

    },
    optionsProduct: function () {

        $('.option').on('change', function () {

            var length = $('.option').length;
            var actual = $(this).prev('.attribute').val();
            var next    = $(this).nextAll('select.option').length; 
            if(next>0){ $(this).css('background',"url('../../css/images/attribute-loader.gif') 98% 50% no-repeat"); }

            var load = $('div#loading');
            var self = $(this);
            var productId = $('#product_id').val();
            var selectNext = self.nextAll('.option');
            selectNext.removeAttr('disabled');

            var optionsId = [];
            $('.option').each(function () {
                optionsId.push($('option:selected', this).val());
            });

            var optionId = $('option:selected', this).val();
            var attributeId = $(this).nextAll('.attribute').val()[0];
            console.log(attributeId);
            if (attributeId == 0) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/carrinho/getStock',
                    type: 'POST',
                    data: 'product_id=' + productId + '&options=' + optionsId,
                    success: function (response) {
                        console.log(response.stock_id)
                        console.log(response.quantity)
                        $('#stock_id').val(response.stock_id);
                        $('#quantity').val(response.quantity);
                        $('button#addItemCart').attr('type', 'submit');
                    }
                })
                return true;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: '/produto/' + productId,
                type: 'GET',
                data: 'product_id=' + productId + '&options=' + optionsId + '&attribute_id=' + attributeId,
                success: function (response) {
                    if (response.request === 'undefined') {
                        //console.log(response.stock_id)
                        //console.log(response.quantity)	                	
                        $('#stock_id').val(response.stock_id);
                        $('#quantity').val(response.quantity);
                        $('button#addItemCart').attr('type', 'submit');
                        return true;
                    }
                    var select = '<option value="">Selecione uma das opções</option>';
                    $.each(response.request, function (index, el) {
                        for (key in el) {
                            select += '<option value="' + el[key].optionId + '">' + el[key].optionName + '</option>';
                            //console.log('<option value="'+el[key].optionId+'">'+el[key].optionName+'</option>')
                        }
                    });
                    var change = self.nextAll('select')[0];
                    $(change).nextAll('select').prop('selected', false).html('<option value="">Selecione a opção anterior</option>')[0];
                    $(change).html(select);

                    $('.option').css('background', "url('../../css/images/arrow-select.png') 96% 50% no-repeat");

                }
            })
        })
    },
    addCart: function () {

        $('form#addCart').submit(function (event) {
            event.preventDefault();

            var form = $(this);
            var load = $('div#loading');

            $.ajax({
                type: 'POST',
                url: '/carrinho/adicionar',
                data: form.serialize(),
                beforeSend: function () {
                    load.fadeIn('fast', function () {
                        $(this).find('p').empty().html('<i class="fa fa-spinner fa-fw fa-spin"></i> Por favor aguarde.').fadeIn('fast');
                    });
                },
                success: function (data) {
                    console.log(data)
                    var output = '';
                    if (!data.success) {
                        if (!data.array) {
                            output = data.message;
                        } else {
                            for (key in data.errors) {
                                output += data.errors[key] + '<br>';
                            }
                        }

                        load.find('p').empty().html(output);
                        window.setTimeout(function () {
                            load.fadeOut('fast');
                        }, 2500);

                    } else {

                        window.setTimeout(function () {
                            load.fadeOut('fast', function () {
                                $('#addcart').modal('show');
                            });
                        }, 1500);
                    }
                }
            })
        })
    },
    loadAddress: function () {

        function Trim(strTexto)
        {
            return strTexto.replace(/^s+|s+$/g, '');
        }


        function IsCEP(strCEP)
        {
            var objER = /^[0-9]{5}-[0-9]{3}$/;

            strCEP = Trim(strCEP)
            if (strCEP.length > 0) {
                if (objER.test(strCEP)) {
                    return true;
                }
                return false;
            }
        }

        var cep = $('#cep');
        var street = $('#street');
        var number = $('#number');
        var complement = $('#complement');
        var neighborh = $('#neighborh');
        var city = $('#city');
        var uf = $('#uf');

        cep.on('keyup', function () {
            if (IsCEP(cep.val())) {

                $.ajax({
                    type: 'GET',
                    url: 'http://viacep.com.br/ws/' + cep.val() + '/json/',
                    dataType: 'jsonp',
                    success: function (address) {
                        if (address.erro) {
                            $(street).val('').focus();
                            $(neighborh).val('');
                            $(complement).val('');
                            $(city).val('');
                            $(uf).val('');
                            return false;
                        }

                        street.val(address.logradouro);
                        neighborh.val(address.bairro);
                        complement.val(address.complemento);
                        city.val(address.localidade);
                        uf.val(address.uf);

                        number.focus();
                    }
                })

            }

        })

    },
    existsDocuments: function (user_id) {

        $('.ending').on('click', function () {

            //verifica se tem frete
            if ($('.freight').val() != undefined) {
                if ($('.choose-shipping').find('option:selected').val() == 'Selecione uma opção de frete') {
                    $('p.error_cep_type').fadeIn('fast');
                    $('#field-cep').css('border', 'solid 1px red');
                    $('html, body').animate({scrollTop: $("#selectFrete").offset().top - 300}, 500);
                    return
                }
            }
            $('p.error_cep_type').fadeOut('fast');
            var load = $('div#loading');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: '/existe-documentos',
                type: 'POST',
                data: 'user_id=' + user_id,
                beforeSend: function () {
                    load.fadeIn('fast', function () {
                        $(this).find('p').empty().html('<i class="fa fa-spinner fa-fw fa-spin"></i> aguarde...').fadeIn('fast');
                    });
                },
                success: function (data) {
                    //console.log(data)  
                    var output = '';
                    if (!data.success) {
                        if (!data.array) {
                            if (data.message == '1') {
                                //logar
                                load.fadeOut('fast', function () {
                                    document.cookie = "historyGO=cart";
                                    window.location.href = '/identifique-se';
                                });
                            } else if (data.message == '2') {
                                // solicitar cpf e rg
                                $('#data-user').css('display', 'block');
                                load.fadeOut('fast');
                                $('#documents').modal({
                                    backdrop: 'static',
                                    keyboard: false
                                }).modal('show');
                            } else {
                                output = data.message;
                            }
                        } else {
                            for (key in data.errors) {
                                output += data.errors[key] + '<br>';
                            }
                        }
                        load.find('p').empty().html(output);
                        window.setTimeout(function () {
                            load.fadeOut('fast');
                        }, 3500);
                    } else {
                        load.fadeOut('fast');
                        $('#documents').modal({
                            backdrop: 'static',
                            keyboard: false
                        }).modal('show');
                    }
                }
                // error: function () {

                //     load.fadeIn('fast', function (){
                //         $(this).find('p').empty().html('<i class="fa fa-exclamation-triangle fa-fw"></i> Erro 500, tente novamente.').fadeIn('fast');
                //     }); 

                // }
            })

        });

    },
    storeDocuments: function () {

        function eventCheckout(address_id, cep) {

            console.log(address_id);

            if (address_id === undefined) {
                var input_address = $('input[name="address"]:checked');
                address_id = input_address.val();
                cep = input_address.data('cep');
            }

            var val = $('p#val');
            if (address_id == undefined) {
                val.show('fast');
                return false;
            } else {
                val.hide('fast');
            }

            //desabilita ação de botões            
            $('div#actions_finish').fadeOut('fast', function () {
                $('div.block').show('fast');
                $('div#process').fadeIn('slow');
            });

            //verifica se no tem frete
            if ($('.freight').val() === undefined) {
                window.location.href = '/checkout/' + address_id;
                return;
            }

            // CALCULA O FRETE
            var finalWeight = 0;
            $('.weight').each(function (index) {
                var weight = $(this).closest('.item').find('.weight');
                finalWeight += parseFloat(weight.val());
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            console.log(finalWeight + " > " + cep);
            $.ajax({
                url: "/carrinho/getFreight",
                method: "POST",
                data: {freight: finalWeight, cep: cep}
            }).done(function (data) {
                //console.log(data);
                if (data.error) {
                    $('.btn-ship').css('text-indent', '0px').css("background", "#0080FF");
                    $('p.error_cep').fadeIn('fast');
                    //abilita ação de botões
                    $('div#process').fadeOut('fast', function () {
                        $('div.block').hide('fast');
                        $('div#actions_finish').fadeIn('slow');
                    });
                    return
                }
                $('p.error_cep').fadeOut('fast');
                var freight = 0;
                var type = $('.choose-shipping').find('option:selected').val();
                if (type == "pac") {
                    freight = data.valPac;
                } else {
                    freight = data.valSedex;
                }
                $.ajax({
                    url: "/carrinho/setFreight",
                    method: "POST",
                    data: {freight: freight}
                }).done(function (data) {
                    //console.log(data);
                    deleteCookie('htmlPac');
                    deleteCookie('htmlSedex');
                    deleteCookie('valPac');
                    deleteCookie('valSedex');
                    deleteCookie('tipoFrete');
                    deleteCookie('historyGO');
                    window.location.href = '/checkout/' + address_id;
                });
            });
        }

        $('#documents').on('shown.bs.modal', function (e) {

            $('#save-info-user').on('click', function (event) {

                // REINITIALIZE RULES
                $('#info-user').removeData('validator');
                $("#info-user input[type='text']").css('solid 1px #DDD');

                //event.preventDefault();
                $('#title-address').css('color', '#333').html('Endereço para entrega');

                //var formInfo = $("#info-user");
                var rules = undefined;
                var boxCPF = $('#data-user').css('display');
                var boxForm = $('#boxAddress').css('display');
                var address = $("input[name='address']:checked").val();
                var url = undefined;
                var type = "POST";
                var repeat = false;

                //console.log("boxCPF: "+boxCPF);
                //console.log("boxForm: "+boxForm);
                //console.log("address: "+address);

                if (boxCPF == "block" && boxForm == "block") {
                    console.log('regra: 1 [cpf + endereço]');
                    url = "/salvar-endereco-documentos";
                    rules = {
                        cpf: 'required',
                        name: 'required',
                        cep: 'required',
                        street: 'required',
                        number: 'required',
                        neighborh: 'required',
                        city: 'required',
                        uf: 'required'
                    }
                } else if (address === undefined && boxForm == "none") {
                    console.log('regra: 2 [apenas endereço]');
                    rules = {address: 'required'}
                } else if (address === undefined && boxForm == "block") {
                    console.log('regra: 3 [dados novo endereço]');
                    url = "/meus-enderecos";
                    type = "GET";
                    rules = {
                        name: 'required',
                        cep: 'required',
                        street: 'required',
                        number: 'required',
                        neighborh: 'required',
                        city: 'required',
                        uf: 'required'
                    }
                } else if (address !== undefined) {
                    console.log('regra: 4 [apenas endereço]');
                    rules = {address: 'required'}
                }

                console.log("url: " + url);
                console.log("type: " + type);

                $("#info-user").validate({
                    rules: rules,
                    onsubmit: true,
                    errorPlacement: function (error, element) {
                        //console.log(element);
                        //console.log('error form');
                        $(element).css('border', 'solid 1px red');
                        var boxForm = $('#boxAddress').css('display');
                        if (element.attr('id') == "address1" && boxForm != "block") {
                            $('#title-address').css('color', 'red').html('Selecione um endereço de entrega!');
                        }
                        rules = undefined;
                    },
                    submitHandler: function (form) {
                        //console.log('into form');
                        //console.log(form);
                        var btn = $('#save-info-user');
                        btn.css('text-indent', '-9999px')
                                .css('background', "#00B200 url('css/images/loader-btn-green.gif') 50% 3px no-repeat")
                                .prop('disabled', true);
                        var data = $(form).serialize();
                        console.log(data);

                        if (url !== undefined && repeat == false) {
                            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}});
                            $.ajax({
                                url: url,
                                type: type,
                                data: data,
                                success: function (data) {
                                    console.log(data)
                                    var output = '';
                                    if (!data.success) {
                                        if (!data.array) {
                                            output = data.message;
                                        } else {
                                            for (key in data.errors) {
                                                output += data.errors[key] + '<br>';
                                            }
                                        }
                                    } else {
                                        var cep = $("input[name='cep']").val();
                                        console.log('redirect to checkout >>> address: ' + data.address_id + ' >>>> CEP: ' + cep);
                                        eventCheckout(data.address_id, cep);
                                    }
                                }
                            });
                            repeat = true;
                        } else {
                            eventCheckout();
                        }

                        console.log(repeat);
                    }
                });
            });
        });
    },
    calcFreight: function () {

        // CALCULA FRETE JUNTO AOS CORREIOS
        $('.btn-ship').on('click', function () {
            var finalWeight = 0;
            var cep = $(this).prev('input').val();

            //calcula peso dos itens
            $('.weight').each(function (index) {
                var weight = $(this).closest('.item').find('.weight');
                finalWeight += parseFloat(weight.val());
            });

            //set token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "/carrinho/getFreight",
                method: "POST",
                data: {freight: finalWeight, cep: cep}
            }).done(function (data) {
                console.log(data);
                if (data.error) {
                    $('.btn-ship').css('text-indent', '0px').css("background", "#0080FF");
                    $('p.error_cep').fadeIn('fast');
                    return
                }
                $('p.error_cep').fadeOut('fast');
                $('.shipping').hide();
                $('#selectFrete').show('fast');
                var fieldPac = $('#pac');
                var fieldSedex = $('#sedex');
                fieldPac.html(data.pac);
                fieldPac.data('value', data.valPac);
                fieldSedex.html(data.sedex);
                fieldSedex.data('value', data.valSedex);
                document.cookie = "htmlPac=" + data.pac;
                document.cookie = "htmlSedex=" + data.sedex;
                document.cookie = "valPac=" + data.valPac;
                document.cookie = "valSedex=" + data.valSedex;
            });
        });

    },
    cookiesHandler: function(){
        // MANIPULAÇÃO DOS COOKIES
        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ')
                    c = c.substring(1);
                if (c.indexOf(name) == 0)
                    return c.substring(name.length, c.length);
            }
            return "";
        }
        // DELETA COOKIES
        function deleteCookie(name) {
            var value = "";
            var days = -1
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
            document.cookie = name + "=" + value + expires + "; path=/";
        }
    },
    structural: function(){
        // ENVIA PARA A CATEGORIA SELECIONADA NO MOBILE
        $('#category-mobile').on('change', function () {
            var url = $('option:selected', this).val();
            window.location.href = url;
        });

        // ATIVA TOOLTIPS DO SITE
        $("[data-toggle='tooltip']").tooltip();

        // FECHA MODAL ALERT AO CLICAR NO BOTÃO CLOSE
        $('.close').on('click', function () {
            $('#alert').modal('hide');
        });

        // FECHA MODALS CART E GUIA AO CLICAR NO BOTÃO CLOSE
        $('.modal-close').on('click', function () {
            $('#addcart, #modal-guia').modal('hide');
        });

        // ABRE MENU DO USUÁRIO
        $('#show-user-menu').on('click', function () {
            var objUl = $('#user-menu');
            objUl.toggle('fast');
            var display = objUl.css('display');
            $('.seta').toggleClass('glyphicon-menu-right').toggleClass('glyphicon-menu-down');
        });

        // ABRE MENU MOBILE
        $('.glyphicon-menu-hamburger').on('click', function () {
            $('.dropdown').toggle('fast');
        });

        // FUNÇÃO DE TROCA DOS CARROSSEIS AO ARRASTAR NO MOBILE
        $("#banner, #high-products").swiperight(function () { $(this).carousel('prev'); });
        $("#banner, #high-products").swipeleft(function () { $(this).carousel('next'); });


        // FILTRO POR ATRIBUTO
        $('.attribute').on('click', function () {
            $('.attribute').each(function () {
                $(this).find('ul').hide('fast');
                $(this).find('.glyphicon').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            });
            var display = $(this).find('ul').css('display');
            if (display != 'block') {
                $(this).find('ul').css('opacity', '1').toggle('fast');
                $(this).find('.glyphicon').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }
        });

        // FILTRO DROPDOWN
        $('#dropdown-filters').on('click', function () {
            $(this).find('.glyphicon').toggleClass('glyphicon-plus').toggleClass('glyphicon-minus');
            $(this).each(function () {
                $('.select-attributes').toggle('fast');
            });
        });
    },
    zoomProduct: function() {
        // AJUSTE DO PLUGIN DE ZOOM CONFORME A LARGURA DA TELA
        var width = $(window).width();
        if (width >= 1200) {
            var thumbWidth = 510;
            var thumbHeight = 610;
            var zoomAreaWidth = 480;
            var zoomAreaHeight = 612;
            var thumbPosition = "left";
        }
        if (width < 1200 && width > 992) {
            var thumbWidth = 410;
            var thumbHeight = 491;
            var zoomAreaWidth = 405;
            var zoomAreaHeight = 498;
            var thumbPosition = "left";
        }
        if (width < 992 && width > 768) {
            var thumbWidth = 550;
            var thumbHeight = 658;
            var zoomAreaWidth = 0;
            var zoomAreaHeight = 0;
            var thumbPosition = "left";
        }
        if (width < 768) {
            var thumbWidth = width - 38;
            var thumbHeight = (((width / 100) + 60) * 0.2) + width;
            var zoomAreaWidth = 0;
            var zoomAreaHeight = 0;
            var thumbPosition = "bottom";
        }
        // INICIALIZAÇÃO DO PLUGIN
        $('#etalage').etalage({
            thumb_image_width: thumbWidth,
            thumb_image_height: thumbHeight,
            source_image_width: 1100,
            source_image_height: 1318,
            zoom_area_width: zoomAreaWidth,
            zoom_area_height: zoomAreaHeight,
            small_thumbs: 4,
            autoplay: false,
            smallthumbs_position: thumbPosition,
            speed: 400,
            smallthumb_hide_single: false
        });
    },
    cartStructure: function(){
        // LOADER NO BOTÃO DE CÁLCULO FRETE
        $('.btn-ship').on('click', function (event) {
            event.preventDefault();
            $(this).css('text-indent', '-9999px').css("background", "#0080FF url('css/images/loader-shipping.gif') 50% 50% no-repeat");
        });
        // VALIDA SE AS OPÇÕES DO PRODUTO FORAM ESCOLHIDAS
        $('button#addItemCart').on('click', function () {
            var selects = $(this).closest('.col-md-12').find('select');
            selects.css('border', 'solid 1px #DDD');
            selects.each(function () {
                var valOption = $('option:selected', this).val();
                console.log(valOption);
                if (valOption == "" || valOption === undefined) {
                    $(this).css('border', 'solid 1px red');
                }
            });
        });

        // ATUALIZA O CARRINHO AO CARREGAR A PÁGINA
        $(window).load(function () {
            // CALC FRETE
            var inFreight = false;
            var freight = '';
            $('.freight').each(function (index) {
                freight = $(this).val();
                if (freight == 1) {
                    inFreight = true;
                }
            });
            if (inFreight) {
                var selFreight = getCookie('tipoFrete');
                if (selFreight == "") {
                    $('#calcFrete').toggle('fast');
                } else {
                    var value = undefined;
                    var fieldPac = $('#selectTipoFrete #pac');
                    var fieldSedex = $('#selectTipoFrete #sedex');
                    var htmlPac = getCookie('htmlPac');
                    var htmlSedex = getCookie('htmlSedex');
                    var valPac = getCookie('valPac');
                    var valSedex = getCookie('valSedex');
                    var tipoFrete = getCookie('tipoFrete');
                    fieldPac.html(htmlPac);
                    fieldPac.data('value', valPac);
                    fieldSedex.html(htmlSedex);
                    fieldSedex.data('value', valSedex);
                    $('#selectFrete').show('fast');
                    if (tipoFrete == "pac") {
                        $("#selectTipoFrete #pac").prop('selected', true);
                        $('.pac').show('fast');
                        value = valPac;
                    } else {
                        $("#selectTipoFrete #sedex").prop('selected', true);
                        $('.sedex').show('fast');
                        value = valSedex;
                    }
                    var divValue = $('#selectFrete').closest('.item').find('.value-box .value');
                    $('#selectFrete').closest('.item').find('.value').data('unit', value);
                    value = value.split('.');
                    value = 'R$ <span>' + value[0] + '</span>,' + value[1];
                    divValue.html(value);
                    refreshTotal();
                }
            } else {
                $('#freeFrete').toggle('fast');
            }
        });

        // RETORNA INPUT DE CALCULO DE FRETE
        $('#alter-cep').on('click', function () {
            $('.btn-ship').css('text-indent', '0px').css("background", "#0080FF");
            resetFrete();
            refreshTotal();
        });

        // EXCLUI ITEM DO CARRINHO 
        $('.remove').on('click', function () {
            $(this).closest('.item').remove();
            refreshTotal();
        });

        // AJUSTA QUANTIDADE DO PRODUTO
        $('.box-amount i').on('click', function () {

            var input = $(this).closest('.box-amount').find('input');
            var stock = $(this).closest('.box-amount').find('.stock_id');
            var amount = parseInt(input.val());
            var rowid = $(this).data('rowid');
            var operation = $(this).data('op');
            var load = $('div#loading');
            // ADICIONA OU DIMINUI
            if (operation === 'plus') {
                amount = amount + 1;
            } else {
                if (amount > 0) {
                    amount = amount - 1;
                }
            }
            if (amount > 0 && amount <= 99) {
                // SOLICITA O RECÁLCULO DE FRETE TODA VEZ QUE ALGUMA QUANTIDADE É MODIFICADA
                var freeFrete = $('#freeFrete').css('display');
                if (freeFrete != 'block') {
                    resetFrete();
                    refreshTotal();
                }

                // ADICIONA LOADER PARA EXECUÇÃO DO AJAX
                input.val('').css("background", "#FFF url('css/images/loader-gray.gif') 50% 50% no-repeat");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/carrinho/atualizar",
                    method: "POST",
                    data: {qty: amount, rowid: rowid, stock: stock.data('stock')}
                }).done(function (data) {
                    //console.log(data)
                    if (!data.success) {
                        load.fadeIn('fast', function () {
                            $(this).find('p').empty().html('<i class="fa fa-exclamation-triangle fa-fw"></i> ' + data.message).fadeIn('fast');
                        });
                        window.setTimeout(function () {
                            window.location.href = '/carrinho';
                        }, 3500);
                    }
                });
                input.css("background", "#FFF").val(amount);
                // ALTERA O VALOR RISCADO
                var divPromo = $(this).closest('.item').find('.value-box .promo strike');
                var promo = (parseFloat(divPromo.data('unit')) * amount).toFixed(2);
                if (promo != undefined) {
                    promo = promo.replace('.', ',');
                    promo = 'R$ ' + promo;
                    divPromo.html(promo);
                }
                // ALTERA O VALOR NORMAL
                var divValue = $(this).closest('.item').find('.value-box .value');
                var value = ((parseFloat(divValue.data('unit'))) * amount).toFixed(2);
                value = value.split('.');
                value = 'R$ <span>' + value[0] + '</span>,' + value[1];
                divValue.html(value);
                // ALTERA O PESO DO PRODUTO
                var weight = $(this).closest('.item').find('.weight');
                var unitWeight = weight.data('weight');
                $(weight).val(amount * unitWeight);

                refreshTotal();
            }
        });

        // ADICIONA VALOR DO FRETE NO TOTAL
        $('.choose-shipping select').on('change', function () {
            var selected = $('option:selected', this).val();
            var value = $('option:selected', this).data('value');
            // ALTERA A IMAGEM DE PAC E SEDEX 
            $('.choose-shipping img').hide('fast');
            if (selected == 'pac') {
                $('.pac').show('fast');
            }
            if (selected == 'sedex') {
                $('.sedex').show('fast');
            }
            document.cookie = "tipoFrete=" + selected;
            // -----
            var divValue = $(this).closest('.item').find('.value-box .value');
            $(this).closest('.item').find('.value').data('unit', value);
            value = value.split('.');
            value = 'R$ <span>' + value[0] + '</span>,' + value[1];
            divValue.html(value);
            refreshTotal();
        });

        // AJUSTA VALOR TOTAL DO CARRINHO
        var refreshTotal = function () {
            var amount = 0;
            var valueItem = 0.0;
            var total = 0.0;
            // ENCONTRA TODOS VALORES DE ITENS VÁLIDOS E SOMA
            var itens = $('.item');
            $.each(itens, function (index) {
                amount = $(this).find('.box-amount input').val();
                amount = parseInt(amount);
                valueItem = $(this).find('.value').data('unit');
                valueItem = parseFloat(valueItem);
                //console.log("item: "+valueItem);
                if (!isNaN(valueItem)) {
                    if (amount >= 0) {
                        total = total + (valueItem * amount);
                    } else {
                        total = total + valueItem;
                    }
                }
            });
            total = parseFloat(total);
            var parcel = total.toFixed(2);
            var num = 1;
            // APLICA AS TAXAS DE JUROS DO PAGSEGURO E CALCULA A QUANTIDADE DE PARCELAS MÍNIMAS
            if ((total * 0.52255) > 5) {
                parcel = parseFloat(total * 0.52255).toFixed(2);
                num = 2;
            }
            if ((total * 0.35347) > 5) {
                parcel = parseFloat(total * 0.35347).toFixed(2);
                num = 3;
            }
            if ((total * 0.26898) > 5) {
                parcel = parseFloat(total * 0.26898).toFixed(2);
                num = 4;
            }
            if ((total * 0.21830) > 5) {
                parcel = parseFloat(total * 0.21830).toFixed(2);
                num = 5;
            }
            if ((total * 0.18453) > 5) {
                parcel = parseFloat(total * 0.18453).toFixed(2);
                num = 6;
            }
            if ((total * 0.16044) > 5) {
                parcel = parseFloat(total * 0.16044).toFixed(2);
                num = 7;
            }
            if ((total * 0.14240) > 5) {
                parcel = parseFloat(total * 0.14240).toFixed(2);
                num = 8;
            }
            if ((total * 0.12838) > 5) {
                parcel = parseFloat(total * 0.12838).toFixed(2);
                num = 9;
            }
            if ((total * 0.11717) > 5) {
                parcel = parseFloat(total * 0.11717).toFixed(2);
                num = 10;
            }
            if ((total * 0.10802) > 5) {
                parcel = parseFloat(total * 0.10802).toFixed(2);
                num = 11;
            }
            if ((total * 0.10040) > 5) {
                parcel = parseFloat(total * 0.10040).toFixed(2);
                num = 12;
            }
            total = total.toFixed(2);
            total = total.split('.');
            // ATUALIZA O TOTAL
            total = 'R$ <span>' + total[0] + '</span>,' + total[1];
            $('.total .value').html(total);
            // ATUALIZA AS PARCELAS
            parcel = 'em até ' + num + 'x de R$' + parcel;
            $('.total .parcel').html(parcel);
        }

        // RESETA VALOR DO FRETE PARA ZERO
        var resetFrete = function () {
            var select = $('#selectFrete');
            select.hide('fast');
            $('.btn-ship').css('text-indent', '0px').css('background', '#0080FF');
            $('#calcFrete').show('fast');
            select.find('#selectTipoFrete option#null').prop('selected', true);
            select.find('#selectTipoFrete option#pac').html('').data('value', '0');
            select.find('#selectTipoFrete option#sedex').html('').data('value', '0');
            select.find('.value-box .value').data('unit', '0.00').html('R$ <span>0</span>,00');

        }

        // MODAL FINALIZAR //
        $('.back-to-cart').on('click', function () {
            $('#ending').modal('hide');
            $('#documents').modal('hide');
        });

        // MOSTRA O FORMULÁRIO CASO NÃO EXISTA NENHUM ENDEREÇO CADASTRADO
        var addressLength = $('.address').length;
        if (addressLength > 1) {
            $('.form-box').hide();
        } else {
            $('.add-address').hide();
        }
        // MOSTRA O FORMULÁRIO PARA ADICIONAR NOVO ENDEREÇO
        $('.new-address-cart').on('click', function () {
            $(this).fadeOut('fast');
            $('.form-box').fadeIn('fast');
        });
    },
    ordersStructure: function(){
        // MOSTRA INFORMAÇÕES DOS PEDIDOS
        $('.orders .open').on('click', function () {
            var itens = $(this).closest('li').find('.item');
            itens.toggle('fast');
            $(this).closest('li').find('div a .fa').toggleClass('fa-search-plus').toggleClass('fa-search-minus');
        });
    },
    registerStructure: function(){
        // ENVIA O USUÁRIO PARA O BOX DE NOVO CADASTRO AO CLICAR EM "NOVO CADASTRO"
        $('.go-to-new').on('click', function () {
            if (width < 768) {
                $('html, body').animate({scrollTop: $("#register").offset().top - 100}, 500);
            }
        });
    },
    callcenterStructure: function(){
        // MOSTRAR TEXTOS NA CENTRAL DE ATENDIMENTO
        $('.internal-itens .item .title').on('click', function () {
            $(this).find('.fa').toggleClass('fa-minus').toggleClass('fa-plus');
            $(this).closest('.item').find('.content').toggle('fast');
        });
    }
}
