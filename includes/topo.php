<?php
require_once("model/EntityUser.php");
if (isset($_SESSION['user']) && (isset($_SESSION['paswd']))) 
{
  $userLog=$_SESSION['user'];
  $passLog=$_SESSION['paswd'];
 
  $Usuario= new Usuarios();//instanciar classe
  $Usuario->setUsuario($userLog);
  $Usuario->setSenha($passLog)  ;
  $result=$Usuario->Logar();//recebe objeto      
    foreach ($result as $show) {
      $nLog=$show['nome'];
      $nivel=$show['nivel'];
    }
}else
{
  $nLog="Visitante 1";
}
  require_once("conect/conect.php");
  require_once("includes/logout.php");
  require_once("model/EntityUser.php");
  
  
?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar">
        </span><span class="icon-bar"></span> </a>
        <span class="brand" >Sistema de Noticas</span>
      <div class="nav-collapse">  
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i></i><class="icon-user"></i> <?php echo substr($nLog,0,strpos($nLog, " ")) ?> <b class="caret"></b></a>
            <?php
            if ($nLog!="Visitante 1") {
        echo '<ul class="dropdown-menu">
              <li><a href="home.php?acao=edit-user">Perfil</a></li>
              <li><a href="?sair" onClick="return confirm(Deseja sair do sistema?)">
              Sair</a></li>
              </ul>';
            }else
            {
              echo '<ul class="dropdown-menu">
              <li><a href="index.php">Logar</a></li>              
              </ul>';
            }
            ?>
            
          </li>
        </ul>        
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<?php
if ($nLog!="Visitante 1") {
echo '
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active"><a href="home.php"><i class="icon-dashboard"></i><span>Noticias</span> </a> </li>';
        
        if($nivel==1){
        echo '<li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Postagens</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="home.php?acao=show-posts">Visualizar</a></li>
            <li><a href="home.php?acao=cad-postagem">Cadastrar</a></li>
          </ul>
        </li>';}
        if($nivel==0)
        {
        echo '<li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><span>Usuários</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">            
            <li><a href="home.php?acao=adduser">Cadastrar</a></li>
            <li><a href="home.php?acao=edit-user">Editar Perfil</a></li>
          </ul>
        </li>';}
        echo '        
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>';
}
?>
<!-- /subnavbar -->