<?php

class DataAccess{
    private $connection;
	
    
    function connect(){
        $bd= "empregab_rebm";
        $user = "empregab_rumo";
        $pwd = "zx5w3(%qx07.";
        $server = "localhost";

		
        $this->connection = mysql_connect($server, $user, $pwd);
        
        //verificar se a conexão está bem aberta        
        if($this->connection<0 || 
                mysql_select_db($bd, $this->connection) == false){
            //erro
            die("não conseguiu ligar-se à base de dados".mysql_error());            
        }else{
            mysql_query("set names 'utf8'");
            mysql_query("set character_set_connection=utf8");
            mysql_query("set character_set_client=utf8");
            mysql_query("set character_set_results=utf8");
        }        
    }
    
    function execute($query){
        $res = mysql_query($query);
        if(!$res){
            die("Comando inválido".mysql_error());
        }else
            return $res;
    }
    
    function disconnect(){
        mysql_close($this->connection);
    }
     
    
    function login($email, $password){
        $query = "select * from tecnicos where email = '$email' and password = '$password'";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function getMembros(){
        $query = "select * from membros";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
        }    

    function InserirMembro($nome, $link, $logo){
        $query = "insert into membros (nome, link, logotipo) values ('$nome','$link', '$logo')";
        $this->connect();
        $this->execute($query);
        $id = mysql_insert_id();
        $this->disconnect();
        return $id;
    }
    
    function PesquisarMembro($nome){
        $query = "select * from membros where idEstado = 1 and nome like '%".$nome."%'";
        $this->connect();
        $id = $this->execute($query);
        $this->disconnect();
        return $id;
        }
        
    function EditarMembro($nome,$logotipo,$link,$id){
        $query = "update membros  set nome = '".$nome."', logotipo='$logotipo', link = '".$link."' 
            where id = ".$id;
      //  echo $query;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
         }
         
  function RemoverMembro($id){
        $query = "delete from membros where id = ".$id;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
        }
        
  function verEventos(){
        $query = "select * from Eventos";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res; 
    }
    
   function inserirEventos($nome, $descricao, $data, $tipo){
        $query = "insert into Eventos(nome,descricao,data) 
            values ('".$nome."','".$descricao."', '".$data."')";
        
        $this->connect();
        $this->execute($query);
        $id = mysql_insert_id();
        $query = "update Eventos set imagem = '".$id.".".$tipo."' where id = $id";
        $this->execute($query);
        $this->disconnect();
        return $id;
    }
    
    function pesquisarEventos($nome){
        $query = "select * from Eventos where nome like '%".$nome."%'";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function atualizarEventos($nome,$data,$descricao, $id){
        $query = "update Eventos set nome = '".$nome."',  data = '".$data."', descricao = '".$descricao."'
        where id = ".$id;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
    
    function eliminarEventos($id){
        $query = "delete from Eventos where id = ".$id;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
    
    function verMensagens(){ 
        $query = "select * from mensagens";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
        } 
        
    function inserirMensagem($nome, $email, $assunto, $mensagem){
        $query = "insert into mensagens(nome, email, assunto, mensagem) values ('".$nome."','".$email."','".$assunto."','".$mensagem."')";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
        }
    
    function eliminarMensagem($id){
        $query = "delete from mensagens where id = ".$id;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
    
    function getDocumentos(){
        $query = "select * from documentos";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function getDocumentosPorPasta($idPasta){
        $query = "select * from documentos where idPasta = $idPasta";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function RemoverDocumento($id){
        $query = "delete from documentos where id = $id";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
    
    function inserirDocumento($nome, $doc, $pasta){
        $query = "insert into documentos (nome, documento, idPasta) values ('".$nome."','$doc', $pasta)";
        $this->connect();
        $this->execute($query);
        $this->disconnect(); 
    }
    
    function pesquisarDocumento($nome){
        $query = "select * from documentos where nome like '%".$nome."%'";
        $this->connect(); 
        $res = $this->execute($query);
        $this->disconnect(); 
        return $res; 
    }
    
    function atualizarDocumento($nome,$documento, $id, $pasta){ 
        $query = "update documentos set nome = '".$nome."', documento = '".$documento."', idPasta = $pasta where id = ".$id; 
        $this->connect(); 
        $this->execute($query); 
        $this->disconnect(); 
    }
    
    function eliminarDocumento($id){
        $query = "delete from documentos where id = ".$id;
        $this->connect(); 
        $this->execute($query); 
        $this->disconnect();
        }
    
    function criarBolsa($titulo,$dataBolsa,$empresa,$pais,$distrito,$descricao,$requisitos,$ofereceSe,$idTipoBolsa){
        $query = "insert into Bolsas(titulo, dataBolsa, empresa, pais, distrito, descricao, requisitos, ofereceSe, idTipoBolsa) values
        ('".$titulo."','".$dataBolsa."','".$empresa."','".$pais."','".$distrito."','".$descricao."','".$requisitos."','".$ofereceSe."','".$idTipoBolsa."')";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
     
  function verBolsasEmprego(){
        $query = "select * from Bolsas where idTipoBolsa = 2";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
  function verBolsasFormacao(){
        $query = "select * from Bolsas where idTipoBolsa = 1";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function getTipoUtilizador($id){
        $query = "select idTiposDePermissoes from tecnicos where id = $id";
        $this->connect();
        $res = $this->execute($query);
        $row = mysql_fetch_assoc($res);
        $this->disconnect();
        return $row['idTiposDePermissoes'];
    }
    
    function inserirFotografia($nome, $tipo){
        $query = "insert into multimedia (nome) values ('".$nome."')";
        $this->connect();
        $res = $this->execute($query);
        $id = mysql_insert_id();
        $query = "update multimedia set imagem = '".$id.".".$tipo."' where id = $id";
        $this->execute($query);
        $this->disconnect();
        return $id;
        }

    function getFotografias(){
        $query = "select * from multimedia";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res; 

    }
    
    function getEmail(){
        $query = "select email from tecnicos";
        $this->connect();
        $res = $this->execute($query);
        $row = mysql_fetch_assoc($res);
        $this->disconnect(); 
        return $row['email'];
    }
    
    function inserirUtilizador($nome, $email, $password, $tipoUtilizador, $instituicao){
        $query = "select id from tecnicos where email = '$email'";
        $this->connect();
        $res = $this->execute($query);
        if(mysql_num_rows($res)>0){
            $res = -1;
        }else{
            $query = "insert into tecnicos(nome, email, password, idTiposDePermissoes, idInstituicao) values 
									('".$nome."','".$email."','".$password."',$tipoUtilizador, $instituicao)";
            $this->execute($query);
            $res = 1;
        }
        $this->disconnect(); 
        return $res;
	}
	
	function getUtilizadores(){
		$query = "select * from tecnicos T inner join TiposDePermissoes TP where T.idTiposDePermissoes = TP.id";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function getTecnicos(){
		$query = "select T.*, F.nome as MNome from tecnicos T inner join frontoffice F where T.idInstituicao = F.id order by T.nome asc";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();  
		return $res;
	}
	
	function getUtilizador($id){
		$query = "select * from tecnicos where id = $id";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}

    function selectNoticias(){
        $this->connect();
        $query = "select * from noticias";
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function inserirNoticias($titulo, $texto, $textoApresentacao, $dataNoticia, $autor, $tipo, $poster =0){
        $query = "insert into noticias(titulo, texto,textoApresentacao, dataNoticia, autor,poster) values 
					('".$titulo."','".$texto."','".$textoApresentacao."','".$dataNoticia."','".$autor."', $poster)";
         
        $this->connect();
        $this->execute($query);
        $id = mysql_insert_id();
        $query = "update noticias set imagemNoticia ='".$id.".".$tipo."' where id = $id";
        $this->execute($query);
        $this->disconnect();
        return $id;
    }
    
    function getNoticia($id){
        $query = "select * from noticias where id = $id";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function pesquisarNoticias($titulo){
        $query = "select * from noticias where titulo like '%".$titulo."%' order by dataNoticia desc";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function editarNoticias($titulo, $texto, $textoApresentacao, $dataNoticia, $autor, $id, $imagem, $tipo, $poster = 0){       
        if ($imagem != ""){
             $query = "update noticias set titulo = '".$titulo."', texto = '".$texto."',  textoApresentacao = '".$textoApresentacao."',
            dataNoticia = '".$dataNoticia."', autor = '".$autor."', poster=$poster, imagemNoticia = '".$id.".".$tipo."'   
            where id = ".$id;
        }else{
             $query = "update noticias set titulo = '".$titulo."', texto = '".$texto."',  textoApresentacao = '".$textoApresentacao."',
            dataNoticia = '".$dataNoticia."', autor = '".$autor."', poster=$poster   
            where id = ".$id;
        }
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
    
    function eliminarNoticias($id){
        $query = "delete from noticias where id = ".$id;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
    
   
    function verNoticias(){
        $query = "select * from noticias order by id desc";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res; 
    }
    
    function pesquisarBolsa($titulo){
        $query = "select * from Bolsas where titulo like '%".$titulo."%'";
        $this->connect();
        $res = $this->execute($query); 
        $this->disconnect(); 
        return $res; 
        
    } 
    
    function EditarBolsa($titulo,$dataBolsa,$empresa,$pais,$distrito,$descricao,$requisitos,$ofereceSe,$id){
        $query = "update Bolsas set titulo = '".$titulo."', descricao = '".$descricao."', dataBolsa = '".$dataBolsa."', empresa = '".$empresa."', pais = '".$pais."', distrito = '".$distrito."', requisitos = '".$requisitos."', ofereceSe = '".$ofereceSe."'   
            where id = ".$id;
        $this->connect(); 
        $this->execute($query);
        $this->disconnect(); 
        
    } 
    
    function RemoverBolsa($id){ 
        $query = "delete from Bolsas where id = ".$id;
        $this->connect(); 
        $this->execute($query); 
        $this->disconnect(); 
        
    }
    
    function verBolsa(){
        $query = "select * from Bolsa";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect(); 
        return $res;
    }
    
    function GetLink(){
        $query = "select link from membros";
        $this->connect();
        $res = $this->execute($query);
        $row = mysql_fetch_assoc($res);
        $this->disconnect(); 
        return $row['link'];
    }
    
    function getEventos(){
        $query = "select * from Eventos";
        $this->connect();
        $res = $this->execute($query); 
        $this->disconnect();
        return $res;
        }
        
	function getUtentes($nif, $nome, $idFrontOfficeSinalizador, $emailTecnico, $interesseProfissional, 
				$Escolaridade, $situacaoEmprego, $estado/*, $pagina*/){
		$this->connect();
		$idTecnico = -1;
		if ($emailTecnico != "")
		{
			
			$query = "select id from tecnicos where email = '$emailTecnico'";
		
			$res = $this->execute($query); 
			if (mysql_num_rows($res)>0){
				$row = mysql_fetch_array($res);
				$idTecnico = $row[0];
			}
		}
	
		$query = "select *, U.id as a from utentes U where estado=$estado ";
		
		if ($nome != "")
			$query .= " and nome like '%$nome%' ";
		if ($idFrontOfficeSinalizador != "" && $idFrontOfficeSinalizador != "-1")
			$query .= " and idFrontOfficeSinalizador = $idFrontOfficeSinalizador ";
		if ($nif != "")
			$query .= " and NIF = $nif ";
			
		if ($interesseProfissional != -1 && $interesseProfissional != "")
			$query .= " and (interesseProfissional1 = $interesseProfissional or interesseProfissional2 = $interesseProfissional or interesseProfissional3 = $interesseProfissional) ";
		if ($Escolaridade != -1 && $Escolaridade != "")
			$query .= " and idHabilitacoes = $Escolaridade ";
			
		switch ($situacaoEmprego)
		{
			case 1:
			$query .= " and empregado = 1";
			break;
			case 2: 
			$query .= " and empregado =  0";
			break;
			case 3: 
			$query .= " and Estudante = 1";
			break;
			case 4:
			$query .= " and outraSituacao = 1";
			break;
			default:
			break;
		}
		if ($idTecnico != -1)
			$query .= " and idTecnico = $idTecnico ";
			
		//$inicio = ($pagina*10) - 10;		
		//$query .= " order by U.nome asc limit $inicio, 10";
		$query .= " order by U.nome asc";
		//echo $query;
		$res = $this->execute($query); 
		$this->disconnect();
		return $res;
	}
	
	function getUtentesPorPagina($nif, $nome, $idFrontOfficeSinalizador, $emailTecnico, $interesseProfissional, $Escolaridade, 
									$situacaoEmprego,$estado, $pagina){
		$this->connect();
		$idTecnico = -1;
		if ($emailTecnico != "")
		{
			
			$query = "select id from tecnicos where email = '$emailTecnico'";
		
			$res = $this->execute($query); 
			if (mysql_num_rows($res)>0){
				$row = mysql_fetch_array($res);
				$idTecnico = $row[0];
			}
		}
	
		$query = "select *, U.id as a from utentes U where estado=$estado ";
		
		if ($nome != "")
			$query .= " and nome like '%$nome%' ";
		if ($idFrontOfficeSinalizador != "" && $idFrontOfficeSinalizador != "-1")
			$query .= " and idFrontOfficeSinalizador = $idFrontOfficeSinalizador ";
		if ($nif != "")
			$query .= " and NIF = $nif ";
			
		if ($interesseProfissional != -1 && $interesseProfissional != "")
			$query .= " and (interesseProfissional1 = $interesseProfissional or interesseProfissional2 = $interesseProfissional or interesseProfissional3 = $interesseProfissional) ";
		if ($Escolaridade != -1 && $Escolaridade != "")
			$query .= " and idHabilitacoes = $Escolaridade ";
			
		switch ($situacaoEmprego)
		{
			case 1:
			$query .= " and empregado = 1";
			break;
			case 2: 
			$query .= " and empregado =  0";
			break;
			case 3: 
			$query .= " and Estudante = 1";
			break;
			case 4:
			$query .= " and outraSituacao = 1";
			break;
			default:
			break;
		}
		if ($idTecnico != -1)
			$query .= " and idTecnico = $idTecnico ";
		
		$query .= " order by U.nome asc ";
		$queryAux = $query;
		
		$pagina = ($pagina-1) * 15;
		$query .= " limit  $pagina, 15 ";
		
		$res = $this->execute($query); 
		/*
		if ( mysql_num_rows($res) == 0){ //se a página não devolver resultados, mostra a primeira página
			$pagina = 0;
			$queryAux .= " limit  $pagina, 15 ";
			$res = $this->execute($queryAux); 
		}*/
		
		$this->disconnect();
		return $res;
	}
	
	function getUtenteNIF($nif){
		$query = "select *, U.id as a from utentes U 
					where U.NIF = $nif";
		$this->connect();
		$res = $this->execute($query); 
		$this->disconnect();
		return $res;
	}
	
	function getUtente($id){
		$query = "select *, U.id as a from utentes U 
					where U.id = $id";
		
		$this->connect();
		$res = $this->execute($query); 
		$this->disconnect();
		return $res;
	}
	
	function getCategoriasCartaConducao(){
		$query = "select * from categoriasCartaConducao";
		$this->connect();
		$res = $this->execute($query); 
		$this->disconnect();
		return $res;
	}
	
	function getEmailUtente($idUtente){
		$query = "select Email from utentes where id = $idUtente";
		$this->connect();
		$res = $this->execute($query); 
		$row = mysql_fetch_object($res);
		$this->disconnect();
		return $row->Email;
	}
		
	function inserirUtentes($nome, $dataNascimento, $dataInscricao, $idConcelho, $idFreguesia, $idHabilitacoes, $NIF, $idEstadoCivil, 
		$trabalhadorPrecario, $PrestadorDeServicos, $TrabalhadorContaOutrem, $ultimaProfissaoExercida, $semSubsidio,
		$subsidioDesemprego, $EspecificacaoEmprego, $tempoDesempregado, $ultimaProfissaoExercidaDesempregado, $beneficiarioRSI, $outrosSubsidios, $QuaisOutrosSubsidios, 
		$Estudante, $estabelecimentoEnsino, $idGrupoEtario,
		$idSituacaoRegularizada, $idGenero, $MedidasAtivasEmprego, $QualMedidasAtivasEmprego,$Voluntariado, $FormacaoProfissional, $QualFormacaoProfissional, $Biscates, $Telemovel, 
		$Telefone, $OutroTelefone, $Email, $Naturalidade, $Nacionalidade, $InscritoCentroEmprego, $NumeroInscricaoCentroEmprego,
		$Observacoes, $idFrontOfficeSinalizador, $idTecnico, $cartaDeConducao, $cartaDeConducaoCategoriaID, $interesseProfissional1, $interesseProfissional2, 
		$interesseProfissional3, $empregado, $outraSituacao, $morada, $estado, $pedidoInicialEmprego, $pedidoInicialFormacao,
		$pedidoInicialFormacaoQual, $pedidoInicialOutra, $pedidoInicialOutraQual, $NISS, $tipoDocumentoIdentificacao, $numeroIdentificacao){
		
		$this->connect();
		if ($NIF >0){
			$query = "select NIF from utentes where NIF = $NIF";
			
			echo $query;
			$res = $this->execute($query);
			if(mysql_num_rows($res)>0){
				$this->disconnect();
				return -1;
			}
		}
		
		$query = "insert into utentes( nome, dataNascimento, dataInscricao , 
			idConcelho, idFreguesia, idHabilitacoes, NIF, idEstadoCivil, trabalhadorPrecario, PrestadorDeServicos, TrabalhadorContaOutrem, ultimaProfissaoExercida,
			semSubsidio, subsidioDesemprego, EspecificacaoEmprego, tempoDesempregado, ultimaProfissaoExercidaDesempregado, beneficiarioRSI, outrosSubsidios, QuaisOutrosSubsidios, Estudante,
			estabelecimentoEnsino, idGrupoEtario, idSituacaoRegularizada, idGenero, MedidasAtivasEmprego, QualMedidasAtivasEmprego, 
			Voluntariado, FormacaoProfissional, QualFormacaoProfissional, Biscates,
			Telemovel, Telefone, OutroTelefone, Email, Naturalidade, Nacionalidade, InscritoCentroEmprego, NumeroInscricaoCentroEmprego,
			Observacoes, idFrontOfficeSinalizador, idTecnico, cartaDeConducao, cartaDeConducaoCategoriaID, interesseProfissional1,  
			interesseProfissional2, interesseProfissional3, empregado, outraSituacao,
			morada, estado, pedidoInicialEmprego, pedidoInicialFormacao, pedidoInicialFormacaoQual, pedidoInicialOutra, pedidoInicialOutraQual,
			NISS, tipoDocumentoIdentificacao, numeroIdentificacao)
			values
			('$nome','$dataNascimento','$dataInscricao', $idConcelho, $idFreguesia, $idHabilitacoes, $NIF,  $idEstadoCivil,
			$trabalhadorPrecario, $PrestadorDeServicos, $TrabalhadorContaOutrem, '$ultimaProfissaoExercida', $semSubsidio, $subsidioDesemprego,
			'$EspecificacaoEmprego', $tempoDesempregado, $ultimaProfissaoExercidaDesempregado, $beneficiarioRSI, $outrosSubsidios, '$QuaisOutrosSubsidios', 
			$Estudante, '$estabelecimentoEnsino', $idGrupoEtario, $idSituacaoRegularizada, $idGenero, $MedidasAtivasEmprego, '$QualMedidasAtivasEmprego', $Voluntariado,
			$FormacaoProfissional, '$QualFormacaoProfissional', $Biscates, $Telemovel, $Telefone, $OutroTelefone, '$Email', '$Naturalidade', '$Nacionalidade',
			$InscritoCentroEmprego, '$NumeroInscricaoCentroEmprego', '$Observacoes', $idFrontOfficeSinalizador,  $idTecnico, 
			$cartaDeConducao, $cartaDeConducaoCategoriaID, $interesseProfissional1, $interesseProfissional2, $interesseProfissional3, 
			$empregado, $outraSituacao, '$morada', $estado, $pedidoInicialEmprego, $pedidoInicialFormacao, '$pedidoInicialFormacaoQual', $pedidoInicialOutra, '$pedidoInicialOutraQual',
			$NISS, $tipoDocumentoIdentificacao, '$numeroIdentificacao')";
		
		echo $query;
		$this->execute($query);
		$id = mysql_insert_id();
		
        $this->disconnect();
		return $id;
    }
	
	function updateCVUtente($id,$CV)
	{
		$query = "update utentes set CV = '$CV' where id = $id";
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function deleteUtente($id){
		$query = "delete from utentes where id = $id";
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
    
	function updateUtentes($id, $nome, $dataNascimento, $dataInscricao, $idConcelho, $idFreguesia, $idHabilitacoes, $NIF, $idEstadoCivil, 
		$trabalhadorPrecario, $PrestadorDeServicos, $TrabalhadorContaOutrem, $ultimaProfissaoExercida, $semSubsidio,
		$subsidioDesemprego, $EspecificacaoEmprego, $tempoDesempregado, $ultimaProfissaoExercidaDesempregado, $beneficiarioRSI, $outrosSubsidios, $QuaisOutrosSubsidios, 
		$Estudante, $estabelecimentoEnsino, $idGrupoEtario,
		$idSituacaoRegularizada, $idGenero, $MedidasAtivasEmprego, $QualMedidasAtivasEmprego, $Voluntariado, $FormacaoProfissional, $QualFormacaoProfissional, $Biscates, $Telemovel, 
		$Telefone, $OutroTelefone, $Email, $Naturalidade, $Nacionalidade, $InscritoCentroEmprego, $NumeroInscricaoCentroEmprego,
		$Observacoes, $cartaDeConducao, $cartaDeConducaoCategoriaID, $interesseProfissional1, $interesseProfissional2, 
		$interesseProfissional3, $empregado, $outraSituacao, $morada, $estado, $pedidoInicialEmprego, $pedidoInicialFormacao,
		$pedidoInicialFormacaoQual, $pedidoInicialOutra, $pedidoInicialOutraQual, $NISS, $tipoDocumentoIdentificacao, $numeroIdentificacao){
		
		$query = "select id from utentes where NIF = $NIF";
		$this->connect();
		$res = $this->execute($query);
		if (mysql_num_rows($res)>0){
			$row = mysql_fetch_array($res);
			if($row['0'] != $id){
				$this->disconnect();
				return -1;
			}
		}
		$erro = 0;
		if ($idConcelho == '') $idConcelho = -1;
		if ($idFreguesia == '') $idFreguesia = -1;
		if ($idHabilitacoes == '') $idHabilitacoes = -1;
		if ($NIF == '') $erro = 1;
		if ($idEstadoCivil == '') $idEstadoCivil = -1;
		if ($trabalhadorPrecario == '') $trabalhadorPrecario = -1;
		if ($PrestadorDeServicos == '') $PrestadorDeServicos = -1;
		if ($TrabalhadorContaOutrem == '') $TrabalhadorContaOutrem = -1;
		if ($semSubsidio == '') $semSubsidio = -1;
		if ($subsidioDesemprego == '') $subsidioDesemprego = -1;
		if ($beneficiarioRSI == '') $beneficiarioRSI = -1;
		if ($outrosSubsidios == '') $outrosSubsidios = -1;
		if ($Estudante == '') $Estudante = -1;
		if ($idGrupoEtario == '') $idGrupoEtario = -1;
		if ($idSituacaoRegularizada == '') $idSituacaoRegularizada = -1;
		if ($idGenero == '') $idGenero = -1;
		if ($MedidasAtivasEmprego == '') $MedidasAtivasEmprego = -1;
		if ($Voluntariado == '') $Voluntariado = -1;
		if ($FormacaoProfissional == '') $FormacaoProfissional = -1;
		if ($Biscates == '') $Biscates = -1;
		if ($Telemovel == '') $Telemovel = -1;
		if ($Telefone == '') $Telefone = -1;
		if ($OutroTelefone == '') $OutroTelefone = -1;
		if ($InscritoCentroEmprego == '') $InscritoCentroEmprego = -1;
		if ($cartaDeConducao == '') $cartaDeConducao = -1;
		if ($interesseProfissional1 == '') $interesseProfissional1 = -1;
		if ($interesseProfissional2 == '') $interesseProfissional2 = -1;
		if ($interesseProfissional3 == '') $interesseProfissional3 = -1;
		if ($NISS == '') $NISS = -1;
		if ($tipoDocumentoIdentificacao == '') $tipoDocumentoIdentificacao = -1;
//		if ($numeroIdentificacao == '') $numeroIdentificacao = '';
		
		//if ($empregado == '') $empregado = -1;
		
		if ($outraSituacao == '') $outraSituacao = -1;
		
		$query = "update utentes set nome = '$nome', dataNascimento = '$dataNascimento', dataInscricao = '$dataInscricao' , 
		idConcelho = $idConcelho, idFreguesia = $idFreguesia, idHabilitacoes = $idHabilitacoes, NIF = $NIF, idEstadoCivil = $idEstadoCivil,
		trabalhadorPrecario = $trabalhadorPrecario, PrestadorDeServicos = $PrestadorDeServicos, TrabalhadorContaOutrem = $TrabalhadorContaOutrem,
		ultimaProfissaoExercida = '$ultimaProfissaoExercida', semSubsidio = $semSubsidio,subsidioDesemprego = $subsidioDesemprego, EspecificacaoEmprego = '$EspecificacaoEmprego',
		tempoDesempregado = $tempoDesempregado, ultimaProfissaoExercidaDesempregado = $ultimaProfissaoExercidaDesempregado, beneficiarioRSI = $beneficiarioRSI, outrosSubsidios = $outrosSubsidios, QuaisOutrosSubsidios = '$QuaisOutrosSubsidios', 
		idGenero = $idGenero, MedidasAtivasEmprego = $MedidasAtivasEmprego, QualMedidasAtivasEmprego = '$QualMedidasAtivasEmprego', Voluntariado = $Voluntariado, 
		FormacaoProfissional = $FormacaoProfissional, QualFormacaoProfissional = '$QualFormacaoProfissional',
		Estudante = $Estudante, estabelecimentoEnsino = '$estabelecimentoEnsino', idGrupoEtario = $idGrupoEtario, idSituacaoRegularizada = $idSituacaoRegularizada, 
		Biscates = $Biscates, Telemovel = $Telemovel, Telefone = $Telefone, OutroTelefone = $OutroTelefone, Email = '$Email', 
		Naturalidade = '$Naturalidade' , Nacionalidade = '$Nacionalidade', 
		InscritoCentroEmprego = $InscritoCentroEmprego, NumeroInscricaoCentroEmprego = '$NumeroInscricaoCentroEmprego', Observacoes = '$Observacoes',
		cartaDeConducao = $cartaDeConducao, cartaDeConducaoCategoriaID = $cartaDeConducaoCategoriaID,
		interesseProfissional1 = $interesseProfissional1, interesseProfissional2 = $interesseProfissional2, interesseProfissional3 = $interesseProfissional3, 
		empregado = $empregado, outraSituacao = $outraSituacao, morada = '$morada', estado = $estado, pedidoInicialEmprego = $pedidoInicialEmprego,
		pedidoInicialFormacao = $pedidoInicialFormacao, pedidoInicialFormacaoQual = '$pedidoInicialFormacaoQual',
		pedidoInicialOutra = $pedidoInicialOutra, pedidoInicialOutraQual = '$pedidoInicialOutraQual', NISS = $NISS,
		tipoDocumentoIdentificacao = $tipoDocumentoIdentificacao, numeroIdentificacao = '$numeroIdentificacao' where id = $id";
	
		//echo $query;
		$this->execute($query);		
		$this->disconnect();
		return 1;
    }
	
	function getTiposDocumentos(){
		$query = "select id,tipo from tiposDocumentosIdentificacao";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
    function getPastas(){
        $query = "select * from pastas";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function getSubpastas($idPastaMae){
        $query = "select * from pastas  where pastaMae = $idPastaMae";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function getPastasMae(){
        $query = "select * from pastas where pastaMae is NULL";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
	
	function getMissao(){
		$query = "select * from missao";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
	}
	
	function updateMissao($txt){
		$query = "update missao set texto = '$txt'";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
	}
	
	function getEixosdeAtuacao(){
		$query = "select * from EixosdeAtuacao";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
	}
	
	function updateEixosdeAtuacao($txt){
		$query = "update EixosdeAtuacao set Texto = '$txt'";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
		}
		
		function getVantagensBeneficios(){
		$query = "select * from VantagensBeneficios";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
	}
	
	function updateVantagensBeneficios($txt){
		$query = "update VantagensBeneficios set Texto = '$txt'";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
		}
		
	function getPrincipaisAtividades(){
		$query = "select * from PrincipaisAtividades";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
	}
	
	function updatePrincipaisAtividades($txt){
		$query = "update PrincipaisAtividades set Texto = '$txt'";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
		}
		
	function getPrincipaisAtividadesRFO(){
		$query = "select * from PrincipaisAtividadesRFO";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
	}
	
	function updatePrincipaisAtividadesRFO($txt){
		$query = "update PrincipaisAtividadesRFO set Texto = '$txt'";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
		}
		
	function getPrincipaisAtividadesEDL(){
		$query = "select * from PrincipaisAtividadesEDL";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
	}
	
	function updatePrincipaisAtividadesEDL($txt){
		$query = "update PrincipaisAtividadesEDL set Texto = '$txt'";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
		}
		
	function getGabinetesAtendimento(){
		$query = "select * from GabinetesAtendimento";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
		}
		
	function updateGabinetesAtendimento($Nome,$EntidadeResponsavel,$Telefone,$Email,$Morada,$GMLink){
		$query = "update GabinetesAtendimento set Nome = '$Nome' , EntidadeResponsavel = '$EntidadeResponsavel' , Telefone ='$Telefone' , Email='$Email' , Morada='$Morada' , GMLink='$GMLink'";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
		}
		
	function eliminarFotografias($id){
        $query = "Delete From multimedia where id =".$id;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
	
	function updatePerfil($Nome, $Email, $id, $password, $tipoUtilizador){
		$query = "select id from tecnicos where email = '$email'";
        $this->connect();
        $res = $this->execute($query);
        if(mysql_num_rows($res)>0){
            $res = -1;
        }else{		
			if ($tipoUtilizador == 999) //utilizador está a editar o próprio perfil, por isso não pode alterar as suas permissões
				$query = "update tecnicos set Nome = '".$Nome."', Email = '".$Email."'
							 where id = ".$id;
			else //Administrador está a editar utilizador, por isso pode editar tudo!
				$query = "update tecnicos set Nome = '".$Nome."', Email = '".$Email."', 
							idTiposDePermissoes=$tipoUtilizador where id = ".$id;
					
			$this->execute($query);
		
			if ($password != "")
				$query = "update tecnicos set password='".md5($password)."' where id = ".$id;
			$res = 1;
		}
        $this->execute($query);
        $this->disconnect();
		return $res;
	}
		
	function eliminarUtilizador($id){ 
        $query = "delete from tecnicos where id = ".$id;
        $this->connect(); 
        $this->execute($query); 
        $this->disconnect(); 
    }
	
	function getFrontOffices(){
		$query = "select * from frontoffice order by nome asc";
        $this->connect(); 
        $res = $this->execute($query); 
        $this->disconnect(); 
		return $res;
	}
	
	function getNomeFrontOffice($id){
		$query = "select nome from frontoffice where id = $id";
        $this->connect(); 
        $res = $this->execute($query); 
		$row = mysql_fetch_object($res);
        $this->disconnect(); 
		return $row->nome;
	}
	
	function getInteressesProfissionais(){
		$query = "select * from  interessesProfissionais order by interesseProfissional asc";
        $this->connect(); 
        $res = $this->execute($query); 
        $this->disconnect(); 
		return $res;
	}
	
	function getInteresseProfissional($id){
		$query = "select interesseProfissional from  interessesProfissionais where id = $id";
        $this->connect(); 
        $res = $this->execute($query); 
		$row = mysql_fetch_object($res);		
        $this->disconnect(); 
		return $row->interesseProfissional;
	}
	
	//função utilizada para encriptar todas as password da BD
	function updatePWD(){
		$query = "select * from tecnicos";
		$this->connect(); 
        $res = $this->execute($query); 
		while($row = mysql_fetch_object($res)){
			$query2 = "update tecnicos set password = '".md5($row->password)."' where id = $row->id" ;
			//$query2 = "update tecnicos set password = 'rebm' where id = $row->id" ;
			$this->execute($query2); 
		}
		$this->disconnect(); 
	}
	
	function getNomeTecnico($id){
		$query = "select nome from tecnicos where id = $id";
		$this->connect(); 
        $res = $this->execute($query); 
		$row = mysql_fetch_object($res);		
        $this->disconnect(); 
		return $row->nome;
		
	}
	
	function getEncaminhamentos($idUtente){
		$query = "select E.*, T.Nome as TNome, F.nome as FNome from  encaminhamento E inner join tecnicos T inner join frontoffice F 		
		where E.idTecnico = T.id and F.id = T.idInstituicao and E.idUtente = $idUtente";
        $this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getEncaminhamento($id){
		$query = "select E.*, T.Nome as TNome, F.nome as FNome from  encaminhamento E inner join tecnicos T inner join frontoffice F 		
		where E.idTecnico = T.id and F.id = T.idInstituicao and E.id = $id";
        $this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function inserirEncaminhamento($data, $texto, $idTecnico, $idUtente){
		$query = "insert into  encaminhamento (data, texto, idTecnico, idUtente) values ('$data', '$texto', $idTecnico, $idUtente)";
        $this->connect(); 
        $this->execute($query); 
		$this->disconnect(); 
	}
	
	function editarEncaminhamento($id, $data, $texto, $idTecnico, $idUtente){
		$query = "update encaminhamento set data = '$data', texto = '$texto' where id = $id";
        $this->connect(); 
        $this->execute($query); 
		$this->disconnect(); 
	}
	
	function apagarEncaminhamento ($id){
		$query = "delete from encaminhamento where id = ".$id;
        $this->connect(); 
        $this->execute($query); 
        $this->disconnect(); 
	}
	
	function getConcelhos(){
		$query = "select * from concelhos";
		$this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getFreguesias(){
		$query = "select * from freguesias";
		$this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getGeneros(){
		$query = "select * from generos";
		$this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getEstadosCivis(){
		$query = "select * from estadoscivis";
		$this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getHabilitacoes(){
		$query = "select * from habilitacoes";
		$this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getHabilitacao($id){
		$query = "select habilitacao from habilitacoes where id = $id";
		$this->connect(); 
        $res = $this->execute($query); 
		$row = mysql_fetch_array($res);
		$this->disconnect(); 
		return $row[0];
	}
	
	function getGruposEtarios(){
		$query = "select * from GruposEtarios";
		$this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getSituacaoEmprego(){
		$query = "select * from situacaodeemprego";
		$this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getEstadosUtentes(){
		$query = "select * from estadosUtentes";
		$this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getDesempregadoDesde(){
		$query = "select * from desempregadoDesde";
		$this->connect(); 
        $res = $this->execute($query); 
		$this->disconnect(); 
		return $res;
	}
	
	function getFrontOfficeSinalizador($id){
		$query = "select F.nome as FNome, T.nome as TNome, F.id as FID from frontoffice F inner join tecnicos T where T.idInstituicao = F.id and T.id = $id";
		//echo $query;
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function inserirFrontOffice($nome){
		$query = "insert into frontoffice(nome) values ('$nome')";
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function deleteFrontOfficeMaxId(){
		$query = "select max(id) from frontoffice";
		$this->connect();
		$res = $this->execute($query);
		$row = mysql_fetch_array($res);
		
		$query = "DELETE from frontoffice where id = ".$row[0];
		//echo $query;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function deleteFrontOffice($nome){
		$query = "DELETE from frontoffice where nome = '$nome'";
		//echo $query;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function getVideos(){
		$query = "select * from videos";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function deleteVideo($id){
		$query = "delete from videos where id = $id";
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function insertVideo($nome, $link){
		$query = "insert into videos (nome, link) values ('$nome','$link')";
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
}
?>
