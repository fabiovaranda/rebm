<?php

class DataAccess{
    private $connection;
    
    function connect(){
        $bd= "clinic11_remb";
        $user = "root";
        $pwd = "";
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
        
    function EditarMembro($nome,$link,$id){
        $query = "update membros  set nome = '".$nome."', link = '".$link."' 
            where id = ".$id;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
         }
         
  function RemoverMembro($id){
        $query = "delete from Membros where id = ".$id;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
        }
        
  function verEventos(){
        $query = "select * from eventos";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res; 
    }
    
   function inserirEventos($nome, $descricao, $data, $tipo){
        $query = "insert into eventos(nome,descricao,data) 
            values ('".$nome."','".$descricao."', '".$data."')";
        
        $this->connect();
        $this->execute($query);
        $id = mysql_insert_id();
        $query = "update eventos set imagem = '".$id.".".$tipo."' where id = $id";
        $this->execute($query);
        $this->disconnect();
        return $id;
    }
    
    function pesquisarEventos($nome){
        $query = "select * from eventos where nome like '%".$nome."%'";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function atualizarEventos($nome,$data,$descricao, $id){
        $query = "update eventos set nome = '".$nome."',  data = '".$data."', descricao = '".$descricao."'
        where id = ".$id;
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
    
    function eliminarEventos($id){
        $query = "delete from eventos where id = ".$id;
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
    
    function inserirDocumento($nome, $doc){
        $query = "insert into documentos (nome, documento) values ('".$nome."','$doc')";
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
    
    function atualizarDocumento($nome,$documento, $id){ 
        $query = "update documentos set nome = '".$nome."', documento = '".$documento."' where id = ".$id; 
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
        $query = "insert into bolsas(titulo, dataBolsa, empresa, pais, distrito, descricao, requisitos, ofereceSe, idTipoBolsa) values
        ('".$titulo."','".$dataBolsa."','".$empresa."','".$pais."','".$distrito."','".$descricao."','".$requisitos."','".$ofereceSe."','".$idTipoBolsa."')";
        $this->connect();
        $this->execute($query);
        $this->disconnect();
    }
    
  function verBolsasEmprego(){
        $query = "select * from bolsas where idTipoBolsa = 2";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
  function verBolsasFormacao(){
        $query = "select * from bolsas where idTipoBolsa = 1";
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
    
    function inserirUtilizador($nome, $email, $password, $tipoUtilizador){
        $query = "select id from tecnicos where email = '$email'";
        $this->connect();
        $res = $this->execute($query);
        if(mysql_num_rows($res)>0){
            $res = -1;
        }else{
            $query = "insert into tecnicos(nome, email, password, idTiposDePermissoes) values ('".$nome."','".$email."','".$password."',$tipoUtilizador)";
            $this->execute($query);
            $res = 1;
        }
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
    
    function inserirNoticias($titulo, $texto, $dataNoticia, $autor, $tipo){
        $query = "insert into noticias(titulo, texto, dataNoticia, autor) values ('".$titulo."','".$texto."','".$dataNoticia."','".$autor."')";
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
        $query = "select * from noticias where titulo like '%".$titulo."%'";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
    
    function editarNoticias($titulo, $texto, $dataNoticia, $autor, $id){
        $query = "update noticias set titulo = '".$titulo."', texto = '".$texto."', dataNoticia = '".$dataNoticia."', autor = '".$autor."'  
            where id = ".$id;
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
        $query = "select * from bolsas where titulo like '%".$titulo."%'";
        $this->connect();
        $res = $this->execute($query); 
        $this->disconnect(); 
        return $res; 
        
    } 
    
    function EditarBolsa($titulo,$dataBolsa,$empresa,$pais,$distrito,$descricao,$requisitos,$ofereceSe,$id){
        $query = "update bolsas set titulo = '".$titulo."', descricao = '".$descricao."', dataBolsa = '".$dataBolsa."', empresa = '".$empresa."', pais = '".$pais."', distrito = '".$distrito."', requisitos = '".$requisitos."', ofereceSe = '".$ofereceSe."'   
            where id = ".$id;
        $this->connect(); 
        $this->execute($query);
        $this->disconnect(); 
        
    } 
    
    function RemoverBolsa($id){ 
        $query = "delete from bolsas where id = ".$id;
        $this->connect(); 
        $this->execute($query); 
        $this->disconnect(); 
        
    }
    
    function verBolsa(){
        $query = "select * from bolsa";
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
        $query = "select * from eventos";
        $this->connect();
        $res = $this->execute($query); 
        $this->disconnect();
        return $res;
        }
}
?>
