@extends('template.site_template')
@section('content')
    <div style=" font-family: 'Amaranth';font-size: 14px;" class="about-section">
        <div class="container">
            <div class="site-title text-center">
                <h3>Sobre nós</h3>
                <p>Nosso objetivo é mostrar as satisfações e insatisfações de uma forma mais transparente e sem manipulações</p>
            </div>
            <div class="about-inner-section">
                <div style="float: left" class="col-md-6 about-inner-column">
                    <h4>Uma forma de reposta</h4>
                    <p>Procuramos tentar entender por meio das enquetes se as decisões, projetos e atitudes estão de acordo com o esperado pelo povo, se os representantes escolhidos, estão fazendo o trabalho esperado por seus eleitores. Uma pesquisa sem manipulações dados, pois o objetivo da nossa equipe é apresentar à você dados com maior credibilidades em meio a onda das fakes news e levar a satisfação ou insatisfação do povo até aqueles que tomam  as decisões políticas, tentando achar o maior ponto de equilíbrio entre políticos e eleitores.</p>
                </div>
                <div style="float: right" class="col-md-6 about-right">
                    <img src="{{url('assets/aboutUs/aboutUs.jpg')}}" alt=" ">
                </div>
                <div class="clear"></div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>

@endsection
