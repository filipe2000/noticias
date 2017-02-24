<?php
require_once("model/EntityPost.php");
if (empty($_GET['pg'])) {
  
}else{
  $pg=$_GET['pg'];
  //verificar se é numero informado na URL, senão da erro inesperado
    if (!is_numeric($pg)) {
      echo '<script language="javascript">
                  location.href="home.php?acao=show-posts";
                 </script> ';
    }
}
?>

<div class="main">
  <div class="main-inner">
    <div class="container">
     <div class="row">
            <div class="span12">
            </div>
    </div><!-- row -->
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Últimas Noticias</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Nº</th>
                    <th> Imagem</th>
                    <th> Título</th>
                    <th> Data</th>
                    <th> Resumo</th>                    
                  </tr>
                </thead>
                <tbody>
              <?php
              if (isset($_GET['acao'])) 
              {                
                $acao=$_GET['acao'];
                  if ($acao=='deny') 
                  {
              echo '
               <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Acesso negado</strong> Não está logado.
               </div>';               
                  }
              }
$Post= new Posts();
if (isset($pg)) {
  $pg=$_GET['pg'];  
}
else{
   $pg=1;
}
$qtd=5;// nº de registros exibidos
$inicio=($pg*$qtd)-$qtd;

  try {   
    $result=$Post->SelPag($inicio,$qtd);
    if ($result !=null) {
      foreach ($result as $show) 
      {//repete a linha de resultado, html
  ?> 
      <tr>
        <td class="post"> <?php echo $show['id']; ?></td>
        <td class="post"> 
        <span class="image"> 
        <img src="upload/post/<?php echo $show['imagem']; ?>" /> 
        </span>
        </td>
        <td class="post"> <?php echo $show['titulo']; ?> </td>
        <td class="post"> <?php echo $show['data']; ?> </td>
        <td class="post"> 
          <?php
          if (strlen($show['descricao'])<250) 
          {
             echo $show['descricao']; 
           } 
          echo $Post->limitarTexto($show['descricao'],250); 
          ?> 
        </td>
        
      </tr>
      <?php
       }//finaliza a repetição
                
    }else
    {
      echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Eviso</strong> Não há noticias cadastradas.
            </div>';
    }
  } catch (PDOException $e) 
  {
    echo $e;
  }


?>           
                  
                
                </tbody>
              </table>
            </div>
<style>

.paginas{
  width: 100%;
  height: auto;
  margin: 10px auto;
  padding: 10px auto;
  text-align: center;
  background: #fff;
}
.paginas a{
  width: auto;
  padding: 4px 10px;
  background: #ccc;
  color: #333;
  margin: 0px 2px;
  border-radius: 5px;
  
}
.paginas a:hover{
  box-shadow: 1px 1px 10px #999;
}       /* pegar numero da página exibida*/
        <?php
        if (isset($_GET['pg'])) {
          $num_pg=$_GET['pg'];
        }else{
          $num_pg=1;
        }
        ?>/* passa o numero da pagina para gerar o ativoX */
.paginas a.ativo<?php echo $num_pg ?>{
  background: #00BA8B;
  }

</style>
<?php
 try { 
    $row=$Post->NumRows();    
  } catch (PDOException $e) { 
    echo $e;
  }
if ($row>$qtd) 
{       
    $paginas= ceil($row/$qtd);//arredondar acima
    //verificar se usuario digitar na URL o numero da pagina maior do total
    if ($pg > $paginas) {
      echo '<script language="javascript">
              location.href="home.php";
             </script> ';
    }
    $links=3;//num de exibição dos botões
    
    if (!isset($i)) 
    {
      $i='1';
    }
      
?>

<div class="paginas">
    <a href="home.php?acao=accept&pg=1"><< - </a>
  

  <?php
      if (isset($_GET['pg'])) 
        {
        $num_pg=$_GET['pg'];
        }
    for ($i=$pg-$links; $i <= $pg -1 ; $i++)
    { 
      if ($i>0) 
      {
  ?>

      <a href="home.php?acao=accept&pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>">
          <?php echo $i; ?>
      </a>
<?php        
      }//if  
    } //for 
?>

    <a href="#" class="ativo<?php echo $i; ?>"><?php  echo $pg; ?></a>
  <?php 
    for ($i=$pg+1; $i<= $pg+$links ; $i++) 
    { 
      if ($i<=$paginas) 
      {
  ?>
        <a href="home.php?acao=accept&pg=<?php echo $i;?>" class="ativo<?php echo $i; ?>"><?php echo $i;?></a>
<?php 
      }//if        
    }//for

}//if $row>$qtd
?>
<a href="home.php?acao=accept&pg=<?php echo $paginas;?>" class="ativo<?php echo $i; ?>">->></a>
</div>

            <!-- /widget-content --> 
          </div>
          <!-- /widget --> 
          
        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->