$(document).ready(function() {
    api()
    $('#cep').mask('00000-000');
    $('.content').on('focus', '#zip_code', function() {
        $(this).mask('00000-000');
        $(this).keyup(function() {
            let cep = document.getElementById('zip_code').value
            if (cep.length != 9) {
                return false
            }
            cep = cep.replace(/\D+/, '');
            $.get(`https://viacep.com.br/ws/${cep}/json/`, (response) => {
                if (response.erro == true) {
                    // notFaundCep(response)
                    return false
                }
                $("#exibirCep").val(response.cep);
                $("#street").val(response.logradouro);
                $("#complement").val(response.complemento);
                $("#district").val(response.bairro);
                $("#city").val(response.localidade);
                $("#state").val(response.uf);
            });
        })
    })

    $('.search').on('click', function(event) {
        event.preventDefault();
        api()
        removeDisabled()
    })

    $('.list').on('click', function(event) {
        event.preventDefault();
        api('api/list')
        removeDisabled()
    })

    $('#cep').keyup(function() {
        let cep = document.getElementById('cep').value

        if (cep.length != 9) {
            return false
        }

        cep = cep.replace(/\D+/, '');
        $.get(`https://viacep.com.br/ws/${cep}/json/`, (response) => {
            if (response.erro == true) {
                notFaundCep(response)
                return false
            }

            $("#exibirCep").text(response.cep);
            $("#logradouro").text(response.logradouro);
            $("#complemento").text(response.complemento);
            $("#bairro").text(response.bairro);
            $("#cidade").text(response.localidade);
            $("#uf").text(response.uf);
        });
    });

    // Registrar CEP
    $('#register').click(function() {
        let cep = document.getElementById('cep').value
        validCep(cep)
        cep = cep.replace(/\D+/, '');
        $.get(`https://viacep.com.br/ws/${cep}/json/`, (response) => {
            if (response.erro == true) {
                notFaundCep(response)
                return false
            }
            resgisterCep(response)
        });
    });

    // Deletar CEP
    $('.content').on('click', '.delete', function(event) {
        event.preventDefault();
        Swal.fire({
            title: '',
            text: "Deseja apagar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#800080',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let link = $(event.target);
                let data = link.closest('tr').data();

                $.get(`api/delete/${data.id}`, (response) => {
                    if (response.status == 'success') {
                        link.closest('tr').remove();
                        validation(response)
                        return true
                    }
                    validation(response)
                });
                return true;
            }
            return false
        })
    });

    // Tela para editar CEP
    $('.content').on('click', '.edit', function(event) {
        event.preventDefault();
        addDisabled()
        let link = $(event.target);
        let data = link.closest('tr').data();
        api(`api/edit/${data.id}`)
    });

    // Visualizar CEP
    $('.content').on('click', '.show', function(event) {
        event.preventDefault();
        addDisabled()
        let link = $(event.target);
        let data = link.closest('tr').data();
        api(`api/show/${data.id}`);
    });

    // Atualizar CEP
    $('.content').on('click', '.update', function(event) {
        event.preventDefault();
        let inputData = arrayInput();
        valid = validCep(inputData.zip_code);
        if (!valid) {
            return false
        }

        $.get(`https://viacep.com.br/ws/${inputData.zip_code}/json/`, (response) => {
            if (response.erro == true) {
                notFaundCep(response)
                return false;
            }

            let link = $(event.target);
            let data = link.closest('div').data();
            $.post(`api/update/${data.id}`, inputData, (response) => {
                validation(response)
                removeDisabled()
            })
        });
    });
});

// Registrar CEP
function resgisterCep(data) {
    $.ajax({
        url: 'api/store',
        method: 'POST',
        data: data
    }).done(function(response) {
        validation(response)
        return response
    })
}

// Carregar paginas
function api(url = 'api/zip-code', page = null) {
    $.get(url, page, (response) => {
        $('.content').html(response);
        $('#zip_code').focusin()
    })
}

function removeDisabled() {
    $('#cep').removeAttr('disabled')
    $('#register').removeAttr('disabled')
}

function addDisabled() {
    $('#cep').attr('disabled', 'disabled')
    $('#register').attr('disabled', 'disabled')
}

function validation(response) {
    if (response.status == 'warning') {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: response.message,
            confirmButtonColor: '#800080',
        })
    }
    if (response.status == 'error') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: response.message,
            confirmButtonColor: '#800080',
        })
    }
    if (response.status == 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: response.message,
            confirmButtonColor: '#800080',
        })
        api('api/list')
    }
}

function validCep(cep) {
    if (cep.length != 9) {
        Swal.fire({
            icon: 'error',
            title: 'CEP inválido',
            text: 'Verifique o CEP e tente novamente',
            confirmButtonColor: '#800080',
        })
        return false
    }
    return true
}

function notFaundCep(response) {
    Swal.fire({
        icon: 'error',
        title: 'CEP não contrado',
        text: response.message,
        confirmButtonColor: '#800080',
    })
}

function arrayInput() {
    let zip_code = $('#zip_code').val()
    let street = $('#street').val()
    let complement = $('#complement').val()
    let city = $('#city').val()
    let state = $('#state').val()
    let district = $('#district').val()

    return inputData = {
        zip_code: zip_code,
        street: street,
        complement: complement,
        city: city,
        state: state,
        district: district,
    }
}