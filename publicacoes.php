<?php
    session_start();
    date_default_timezone_set('Brazil/East');
    
    require('../../../Config/Conf.inc.php');
    
    $banco = new Conexao();
    $insere = new Inserir();
    $ler = new Ler();
    $editar = new Editar();
    $excluir = new Excluir();
    
    $ler->executarLeitura('publicacao', "WHERE id >= :id", "id=1");
    
    $cadastradoSucesso = filter_input(INPUT_GET,'cadastradoSucesso',FILTER_VALIDATE_BOOLEAN);
    if(isset($cadastradoSucesso)):
        errosDoUsuarioCustomizados("Publicação id {$ler->pegarConexao()->lastInsertId()}", CORPF_VERDE);
    endif;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../css/painel.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Publicações </title>
</head>
<body>
    <header>
        <h2></h2>
    </header>
    <main class="formulario">
        <button id="voltar">voltar</button>
        <article>
            <header></header>
                
            <h1 style="font-family: 'Ubuntu',sans-serif; " class="titulo">Publicações.</h1>
            <a href="cadastrar_publicacao.php" class="btn_enviar" style="text-decoration: none;">cadastrar nova publicação</a>
                
            <section class="div_resultados">
                <header>
                    
                </header>
                <article>
                    <?php
                        if($ler->resultado() >= 1):
                            foreach ($ler->resultado() as $publicacao) :
                                extract($publicacao);
                    ?>
                    
                    <header class="cabecalho_resultados">
                        <div class="div_resultados">
                                <p>Título</p>
                                <p>descrição</p>
                                <p>conteúdo</p>
                                <p>autor</p>
                                <p>visualizações</p>
                                <p>Data Publicação</p>

                                <span class="resultados">
                                    <?= $descricao_categoria; ?>
                                </span>
                                <span class="resultados">
                                    <?= $descricao; ?>                                    
                                </span>
                                <span class="resultados">
                                    <?= $conteudo; ?>
                                </span>
                                <span class="resultados">
                                    <?= $autor; ?>                                    
                                </span>
                                    <?= $visualizacoes; ?>
                                    <?= $data_da_publicacao; ?>
                        </div>
                    </header>
                <?php 
                            endforeach;        
                        else:
                            errosDoUsuarioCustomizados("Não há resultados.", CORPF_AMARELO);
                        endif;
                ?>
                </article>
            </section>
        </article>
    </main>
    <script>
        document.getElementById("voltar").addEventListener('click',()=>{
            history.back();
        });
    </script>
</body>
</html>
