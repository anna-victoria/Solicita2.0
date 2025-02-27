@extends('layouts.app')

@section('navbar2.blade.php')

@section('conteudo')
<div class="container">

    <div class="row justify-content-between mt-3">
        {{-- info texto --}}

        <div class="col-md-8 py-3">
            <div class="row justify-content-center">
                <img src="/images/logo.png" width="400px">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-11 pt-4">
                    <div class="tituloHome">
                        O que é o “Solicita”?
                    </div>
                    <div class="py-2 textoHome">
                        É uma ferramenta desenvolvida para o atendimento das solicitações de documentos no Setor de Escolaridade da Universidade Federal do Agreste de Pernambuco - UFAPE / Unidade Acadêmica de Garanhuns.
                    </div>
                    <div class="tituloHome">
                        Quais os benefícios em utilizar o “Solicita”?
                    </div>
                    <div class="py-2">
                        <img src="images/tag.svg" width="30px">
                        <span class="px-1 textoHome">Solicitar documentos de qualquer lugar e horário</span>
                        <div>
                            <img src="images/tag.svg" width="30px">
                            <span class="px-1 textoHome">Acompanhar a situação de seu pedido</span>
                        </div>
                        <div>
                            <img src="images/tag.svg" width="30px">
                            <span class="px-1 textoHome">Evitar deslocamento ao setor, antes da emissão do documento</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- end info texto --}}

        <div class="col-md-3 mt-5">
            <div class="col-md-12 px-4 py-3 shadow mt-5 caixa">
                <div>
                    @include('componentes.mensagens')
                </div>

                <div class="row">
                    <div class="col-md-12" style="color: var(--textcolor); font-weight: 700; font-size: 33px;">Entrar</div>
                </div>

                <form method="POST" action="{{ route('login') }}">
                @csrf

                    <!-- Form E-mail -->

                    <div class="form-group row justify-content-center">
                        <div class="col-md-12" style="">
                            <div class="componenteTabela">E-mail:</span>
                                <div>
                                    <input style="background-color: var(--background); border-radius: 0.5rem; height: 33px;padding-left: 10px" id="email" type="email" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
                                           name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Form Senha -->

                    <div class="form-group row justify-content-center">
                        <div class="col-md-12">
                            <div class="componenteTabela">Senha:</span>
                                <div class="campoDeTexto">
                                    <input style="background-color: var(--background); border-radius: 0.5rem; height: 33px;padding-left: 10px" id="email" id="password" type="password" class="form-control @error('password') is-invalid @enderror field__input a-field__input"
                                           name="password" required autocomplete="current-password" placeholder="Senha">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="form-group row" >
                        <div class="col-md-12 " style="">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Lembre-se de mim') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="row " style="">
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #1B2E4F;">
                                        {{ __('Esqueceu sua senha?   ') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="text-center botao">
                            <button type="submit" class="btn col-md-12" style="background-color: var(--textcolor); color: white; font-weight: 600; font-size: 16px; border-radius: 0.5rem;">{{ __('Entrar') }}</button>
                        </div>
                        <div class="text-center mt-3">
                            <a type="button" class="btn col-md-12" href="{{  route('cadastro')  }}" style="background-color: var(--padrao); color: white; font-weight: 600; font-size: 16px; border-radius: 0.5rem;">Cadastrar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
