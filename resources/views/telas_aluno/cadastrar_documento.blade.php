@extends('layouts.app')

@section('conteudo')
    <!-- @section('navbar2.blade.php')
    Home
@endsection -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="row mt-5 tituloFicha">
                <div class="col-md-12">
                    Ficha Catalográfica -
                        @if($tipo_documento == 1)Monografia
                        @elseif($tipo_documento == 2)Tese
                        @elseif($tipo_documento == 3)Trabalho de Conclusão de Curso
                        @elseif($tipo_documento == 4)Produto Educacional
                        @elseif($tipo_documento == 5)Dissertação
                        @endif
                </div>
            </div>
            <form method="POST" enctype="multipart/form-data" id="formRequisicao" action="{{ route('criarDocumentoBibli') }}">
                @csrf
                <input type="hidden" name="tipo_documento" value="{{$tipo_documento}}">

                <! –– Dados Pessoais ––>

                <div class="col-md-12 corpoFicha shadow my-4">
                    <div class="row">
                        <div class="col-md-12 cabecalho py-2">
                            <span class="tituloCabecalho">Dados Pessoais</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group py-2">
                                <label class="textoFicha" for="exampleFormControlInput1">Nome<span style="color: red">*</span>:</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                       placeholder="Nome" value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                       disabled>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id_perfil" value="{{ $id_perfil }}">
                </div>

                <! –– Dados do Trabalho ––>

                <div class="col-md-12 corpoFicha shadow my-4">

                    <div class="row">
                        <div class="col-md-12 cabecalho py-2">
                            <span class="tituloCabecalho">Dados do Trabalho</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 py-2 textoFicha">
                            <div class="form-group">
                                <label for="autor_nome">Nome: <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="autor_nome" name="autor_nome"
                                       placeholder="Digite o nome do Autor" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="autor_sobrenome">Sobrenome: <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="autor_sobrenome" name="autor_sobrenome"
                                       placeholder="Digite o sobrenome do Autor" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="titulo">Título: <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                       placeholder="Digite o Título" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="subtitulo">Subtítulo: <span style="color: red">@if($tipo_documento != 1 && $tipo_documento != 5)* @endif</span> </label>
                                <input type="text" class="form-control" id="subtitulo" name="subtitulo"
                                       placeholder="Digite o Subtítulo" value="" @if($tipo_documento != 1 && $tipo_documento != 5) required @endif>
                            </div>
                            <div class="form-group">
                                <label for="local">Local: <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="local" name="local"
                                       placeholder="Digite o Local" value="" required>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ano">Ano: <span style="color: red">*</span></label>
                                        <input class="form-control" type="number" min="1900" max="2099" step="1" name="ano"
                                               value="{{date('Y')}}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="folhas">Folhas: <span style="color: red">*</span></label>
                                        <input type="number" class="form-control" id="folhas" name="folhas"
                                               placeholder="Quantidade de Folhas" value="" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ilustracao">Ilustração: <span style="color: red">*</span></label>
                                        <select class="form-control" id="ilustracao" name="ilustracao">
                                            <option value="colorido">Colorido</option>
                                            <option value="preto_branco">Preto e Branco</option>
                                            <option value="nao_possui">Não Possui</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="anexoArquivo">Selecione o documento: <span style="color: red">*</span>
                                </label><br>
                                <input type="file" id="anexo" accept="application/pdf, .docx" name="anexo"
                                       style="margin-bottom: 0px" required>
                                <br>
                                <span id="tipoAnexo"
                                      style="font-size: small; color: gray; margin-top: 0px; margin-bottom: 10px">Tipos permitidos: PDF, DOCX e DOC. </span>
                            </div>
                        </div>
                    </div>
                </div>

                <! –– Dados Especificos ––>

                @if($tipo_documento == 1) <! -- MONOGRAFIA --!>
                    <div class="col-md-12 corpoFicha shadow my-4">
                        <div class="row">
                            <div class="col-md-12 cabecalho py-2">
                                <span class="tituloCabecalho">Monografia</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 py-2 textoFicha">
                                <div class="form-group">
                                    <label for="nome_orientador">Nome do Orientador: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="nome_orientador" name="nome_orientador"
                                           placeholder="Digite o nome do orientador" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="sobrenome_orientador">Sobrenome do Orientador: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="sobrenome_orientador" name="sobrenome_orientador"
                                           placeholder="Digite o Sobrenome do orientador" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="nome_coorientador">Nome do Coorientador: </label>
                                    <input type="text" class="form-control" id="nome_coorientador"
                                           placeholder="Digite o Nome do Coorientador" value="" name="nome_coorientador">
                                </div>

                                <div class="form-group">
                                    <label for="sobrenome_coorientador">Sobrenome do Coorientador: </label>
                                    <input type="text" class="form-control" id="sobrenome_coorientador"
                                           placeholder="Digite o Sobrenome do Coorientador" value="" name="sobrenome_coorientador">
                                </div>

                                <div class="row justify-content-between">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subtitulo">Titulação do Orientador: <span
                                                    style="color: red">*</span></label>
                                            <select class="form-control" id="titulacao_orientador"
                                                    name="titulacao_orientador">
                                                <option value="graduado">Graduado</option>
                                                <option value="especialista">Especialista</option>
                                                <option value="mestre">Mestre</option>
                                                <option value="doutor">Doutor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subtitulo">Titulação do Coorientador:</label>
                                            <select class="form-control" id="titulacao_coorientador"
                                                    name="titulacao_coorientador">
                                                <option>Sem Coorientador</option>
                                                <option value="graduado">Graduado</option>
                                                <option value="especialista">Especialista</option>
                                                <option value="mestre">Mestre</option>
                                                <option value="doutor">Doutor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        @elseif($tipo_documento == 2) <! -- TESE --!>
                            <div class="col-md-12 corpoFicha shadow my-4">
                                <div class="row">
                                    <div class="col-md-12 cabecalho py-2">
                                        <span class="tituloCabecalho">Tese</span>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-12 py-2 textoFicha">
                                    <div class="form-group">
                                        <label for="nome_orientador">Nome do Orientador: <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="nome_orientador" name="nome_orientador"
                                               placeholder="Digite o Nome do Orientador" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="sobrenome_orientador">Sobrenome do Orientador: <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="sobrenome_orientador" name="sobrenome_orientador"
                                               placeholder="Digite o Sobrenome do orientador" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nome_coorientador">Nome do coorientador:</label>
                                        <input type="text" class="form-control" id="nome_coorientador" name="nome_coorientador"
                                               placeholder="Digite o Nome do Coorientador" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="sobrenome_coorientador">Sobrenome do Coorientador: </label>
                                        <input type="text" class="form-control" id="sobrenome_coorientador"
                                               placeholder="Digite o Sobrenome do Coorientador" value="" name="sobrenome_coorientador">
                                    </div>

                                    <div class="row justify-content-between">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="subtitulo">Titulação do Orientador: <span
                                                        style="color: red">*</span></label>
                                                <select class="form-control" id="titulacao_orientador"
                                                        name="titulacao_orientador">
                                                    <option value="graduado">Graduado</option>
                                                    <option value="especialista">Especialista</option>
                                                    <option value="mestre">Mestre</option>
                                                    <option value="doutor">Doutor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="subtitulo">Titulação do Coorientador:</label>
                                                <select class="form-control" id="titulacao_coorientador"
                                                        name="titulacao_coorientador">
                                                    <option>Sem Coorientador</option>
                                                    <option value="graduado">Graduado</option>
                                                    <option value="especialista">Especialista</option>
                                                    <option value="mestre">Mestre</option>
                                                    <option value="doutor">Doutor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="programa">Programa: <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="programa" name="programa"
                                               placeholder="Digite o Nome do Programa" value="">
                                    </div>
                                </div>
                            </div>
                            </div>
                        @elseif($tipo_documento == 3)
                            <div class="col-md-12 corpoFicha shadow my-4">
                                <div class="row">
                                    <div class="col-md-12 cabecalho py-2">
                                        <span class="tituloCabecalho">Trabalho de Conclusão de Curso</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 textoFicha py-2">
                                        <div class="form-group">
                                            <label for="nome_orientador">Nome do Orientador: <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="nome_orientador" name="nome_orientador"
                                                   placeholder="Digite o Nome do Orientador" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="sobrenome_orientador">Sobrenome do Orientador: <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="sobrenome_orientador" name="sobrenome_orientador"
                                                   placeholder="Digite o Sobrenome do orientador" value="" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="nome_orientador">Nome do Coorientador: </label>
                                            <input type="text" class="form-control" id="nome_coorientador" name="nome_coorientador"
                                                   placeholder="Digite o Nome do Coorientador" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="sobrenome_coorientador">Sobrenome do Coorientador: </label>
                                            <input type="text" class="form-control" id="sobrenome_coorientador"
                                                   placeholder="Digite o Sobrenome do Coorientador" value="" name="sobrenome_coorientador">
                                        </div>

                                        <div class="row justify-content-between">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="subtitulo">Titulação do Orientador: <span
                                                            style="color: red">*</span></label>
                                                    <select class="form-control" id="titulacao_orientador"
                                                            name="titulacao_orientador">
                                                        <option value="graduado">Graduado</option>
                                                        <option value="especialista">Especialista</option>
                                                        <option value="mestre">Mestre</option>
                                                        <option value="doutor">Doutor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="subtitulo">Titulação do Coorientador:</label>
                                                    <select class="form-control" id="titulacao_coorientador"
                                                            name="titulacao_coorientador">
                                                        <option>Sem Coorientador</option>
                                                        <option value="graduado">Graduado</option>
                                                        <option value="especialista">Especialista</option>
                                                        <option value="mestre">Mestre</option>
                                                        <option value="doutor">Doutor</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="referencias">Referências: <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="referencia" name="referencia"
                                                   placeholder="Digite as referências" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @elseif($tipo_documento == 4)
                            <div class="col-md-12 corpoFicha shadow my-4">
                                <div class="row">
                                    <div class="col-md-12 cabecalho py-2">
                                        <span class="tituloCabecalho">Produto Educacional</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 textoFicha py-2">

                                        <div class="form-group">
                                            <label for="programa">Programa: <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="programa" name="programa"
                                                   placeholder="Digite o Nome do Programa" value="">
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            @elseif($tipo_documento == 5)
                                <div class="col-md-12 corpoFicha shadow my-4">
                                    <div class="row">
                                        <div class="col-md-12 cabecalho py-2">
                                            <span class="tituloCabecalho">Dissertação</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 py-2 textoFicha">
                                            <div class="form-group">
                                                <label for="nome_orientador">Nome do Orientador: <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="nome_orientador" name="nome_orientador"
                                                       placeholder="Digite o Nome do Orientador" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="sobrenome_orientador">Sobrenome do Orientador: <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="sobrenome_orientador" name="sobrenome_orientador"
                                                       placeholder="Digite o Sobrenome do Orientador" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="nome_coorientador">Nome do Coorientador: </label>
                                                <input type="text" class="form-control" id="nome_coorientador"
                                                       placeholder="Digite o Nome do Coorientador" value="" name="nome_coorientador">
                                            </div>

                                            <div class="form-group">
                                                <label for="sobrenome_coorientador">Sobrenome do Coorientador: </label>
                                                <input type="text" class="form-control" id="sobrenome_coorientador"
                                                       placeholder="Digite o Sobrenome do Coorientador" value="" name="sobrenome_coorientador">
                                            </div>

                                            <div class="row justify-content-between">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="subtitulo">Titulação do Orientador: <span
                                                                style="color: red">*</span></label>
                                                        <select class="form-control" id="titulacao_orientador"
                                                                name="titulacao_orientador">
                                                            <option value="graduado">Graduado</option>
                                                            <option value="especialista">Especialista</option>
                                                            <option value="mestre">Mestre</option>
                                                            <option value="doutor">Doutor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="subtitulo">Titulação do Coorientador:</label>
                                                        <select class="form-control" id="titulacao_coorientador"
                                                                name="titulacao_coorientador">
                                                            <option>Sem Coorientador</option>
                                                            <option value="graduado">Graduado</option>
                                                            <option value="especialista">Especialista</option>
                                                            <option value="mestre">Mestre</option>
                                                            <option value="doutor">Doutor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="programa">Programa: <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="programa" name="programa"
                                                       placeholder="Digite o Nome do Programa" value="">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif

                <! -- PALAVRAS CHAVE -- !>
                <div class="col-md-12 corpoFicha shadow my-4">
                    <div class="row">
                        <div class="col-md-12 cabecalho py-2">
                            <span class="tituloCabecalho">Palavras-chave</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 py-2 textoFicha">
                            <div class="form-group">
                                <label for="primeira">Primeira Palavra:<span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="primeira" name="primeira_chave"
                                       placeholder="1. Palavras-chave" value="">
                            </div>

                            <div class="form-group">
                                <label for="segunda">Segunda Palavra:<span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="segunda" name="segunda_chave"
                                       placeholder="2. Palavras-chave" value="">
                            </div>

                            <div class="form-group">
                                <label for="terceira">Terceira Palavra:<span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="terceira" name="terceira_chave"
                                       placeholder="3. Palavras-chave" value="">
                            </div>

                            <div class="form-group">
                                <label for="quarta">Quarta Palavra:</label>
                                <input type="text" class="form-control" id="quarta" name="quarta_chave"
                                       placeholder="4. Palavras-chave" value="">
                            </div>

                            <div class="form-group">
                                <label for="quinta">Quinta Palavra:</label>
                                <input type="text" class="form-control" id="quinta" name="quinta_chave"
                                       placeholder="5. Palavras-chave" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mt-5">
                    <div class="col-md-4">
                        <a type="button" class="btn btn-block" style="background-color: var(--padrao); border-radius: 0.5rem; color: white;"
                           href="{{ route('prepara-requisicao-bibli') }}">Voltar</a>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="submit" class="btn btn-block" style="background-color: var(--confirmar); border-radius: 0.5rem; color: white;" href="#">
                            Enviar
                        </button>
                    </div>
                </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<script>
    var myFile = "";
    $('#anexo').on('change', function () {
        myFile = $('#anexo').val();
        var extension = myFile.split('.').pop();
        if (extension == 'pdf' || extension == 'docx' || extension == 'doc') {
            $('#tipoAnexo').css('color', 'green');
        } else {
            $('#tipoAnexo').css('color', 'red');
            alert('O Anexo deve ser de um dos seguites tipos: .pdf, .docx ou .doc.')
        }
    });

    $('#formRequisicao').submit(function (e) {
        myFile = $('#anexo').val();
        var extension = myFile.split('.').pop();
        if (extension == 'pdf' || extension == 'docx' || extension == 'doc') {
            //$('#formRequisicao').submit();
        } else {
            alert('Os elementos pré-textuais devem ser de um dos tipos aceitos: .pdf, .docx ou .doc. Corrija!')
            e.preventDefault();
        }
    });
</script>

@endsection
